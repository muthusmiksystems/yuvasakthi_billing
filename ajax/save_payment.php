<?php
include '../config/config.php';
global $con;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data and sanitize inputs
    $tid = mysqli_real_escape_string($con, $_POST['t_id']);
    $amt = mysqli_real_escape_string($con, $_POST['amt']);
    $gst = mysqli_real_escape_string($con, $_POST['gst']);
    $payableamt = mysqli_real_escape_string($con, $_POST['payableamt']);
    $pendingdate = mysqli_real_escape_string($con, $_POST['pendingdate']);
    $dueno = mysqli_real_escape_string($con, $_POST['dueno']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $payment_type = mysqli_real_escape_string($con, $_POST['payment_type']);
    // Get the last bill number from the `tbl_trainee`
    $get_bill_no = "SELECT bill_no AS last_bill_no FROM tbl_trainee WHERE trainee_id = '$tid'";
    $bill_no = mysqli_query($con, $get_bill_no);
    if ($bill_no && mysqli_num_rows($bill_no) > 0) {
        $row = mysqli_fetch_assoc($bill_no);
        $last_bill_no = $row['last_bill_no'];
    } else {
        echo "Error fetching bill number: " . mysqli_error($con);
        exit;
    }
    if ($payment_type == "initial") {
        // Check for any existing "initial" payments with the same bill_no and trainee_id
        $checkQuery = "SELECT * FROM fee_payment WHERE trainee_id='$tid' AND bill_no='$last_bill_no' AND payment_type='initial' AND status=0";
        $result = mysqli_query($con, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            // There's an initial payment with status 0 (unpaid), update it
            $row = mysqli_fetch_assoc($result);
            $existingAmount = $row['amount'];

            // Subtract the new payment amount from the existing amount
            $newAmount = $existingAmount - $amt;

            if ($newAmount <= 0) {
                // If the new amount is less than or equal to zero, mark the payment as complete
                $deleteQuery = "DELETE FROM fee_payment WHERE id=" . $row['id'];
                if (!mysqli_query($con, $deleteQuery)) {
                    echo "Error deleting payment record: " . mysqli_error($con);
                    exit;
                }
            } else {
                // Otherwise, just update the remaining amount
                $updateQuery = "UPDATE fee_payment SET amount='$newAmount' WHERE id=" . $row['id'];
                if (!mysqli_query($con, $updateQuery)) {
                    echo "Error updating payment record: " . mysqli_error($con);
                    exit;
                }
            }



            // Insert the new payment record as completed
            $insertQuery = "INSERT INTO fee_payment (date, status, amount, due_id, trainee_id, bill_no, gst, payment_type) 
                            VALUES ('$date', 1, '$amt', 0, '$tid', '$last_bill_no', '$gst', '$payment_type')";
            if (!mysqli_query($con, $insertQuery)) {
                echo "Error inserting payment record: " . mysqli_error($con);
                exit;
            }

            echo "Amount Saved Successfully and previous record updated.";
        } else {
            // If no unpaid initial payment exists, just insert the new payment
            $insertQuery = "INSERT INTO fee_payment (date, status, amount, due_id, trainee_id, bill_no, gst, payment_type) 
                            VALUES ('$date', 1, '$amt', 0, '$tid', '$last_bill_no', '$gst', '$payment_type')";
            if (!mysqli_query($con, $insertQuery)) {
                echo "Error inserting payment record: " . mysqli_error($con);
                exit;
            }

            echo "Amount Saved Successfully";
        }

        exit;
    }

    // Retrieve all unpaid dues in ascending order
    $query = "SELECT * FROM fee_payment WHERE trainee_id = '$tid' AND status = 0 AND payment_type='due' ORDER BY due_id ASC ";
    $result = mysqli_query($con, $query);
    if (!$result) {
        echo "Error retrieving dues: " . mysqli_error($con);
        exit;
    }

    // Apply payment to dues
    $remainingAmt = $amt;
    while ($row = mysqli_fetch_assoc($result)) {
        $due_id = $row['due_id'];
        $due_amount = $row['amount'];

        if ($remainingAmt > 0) {
            if ($remainingAmt >= $due_amount) {
                // Full payment or overpayment
                $remainingAmt -= $due_amount;
                $updateQuery = "DELETE FROM fee_payment WHERE trainee_id = '$tid' AND due_id = '$due_id' AND payment_type='due'";
            } else {
                // Partial payment
                $new_amount = $due_amount - $remainingAmt;
                $remainingAmt = 0;
                $updateQuery = "UPDATE fee_payment SET amount = '$new_amount',date='$pendingdate' WHERE trainee_id = '$tid' AND due_id = '$due_id' ";
            }
            if (!mysqli_query($con, $updateQuery)) {
                echo "Error updating payment: " . mysqli_error($con);
                exit;
            }
        }
    }

    // Insert record for the payment
    $insertQuery = "INSERT INTO fee_payment (date, status, amount, due_id, trainee_id, bill_no,gst,payment_type) 
                    VALUES ('$date', 1, '$amt', 0, '$tid', '$last_bill_no','$gst','$payment_type')";
    if (!mysqli_query($con, $insertQuery)) {
        echo "Error inserting payment record: " . mysqli_error($con);
        exit;
    }

    // Update fee status if total paid amount equals the total fee
    $q1 = "SELECT SUM(f.amount) AS amount, t.fee AS fees
           FROM fee_payment f
           JOIN tbl_trainee t ON f.trainee_id = t.trainee_id
           WHERE f.trainee_id = '$tid'";
    $result = mysqli_query($con, $q1);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row['fees'] == $row['amount']) {
            $q2 = "UPDATE tbl_trainee SET feestatus = 1 WHERE trainee_id = '$tid'";
            $result2 = mysqli_query($con, $q2);
            if (!$result2) {
                echo "Error updating fee status: " . mysqli_error($con);
                exit;
            }
        }
    } else {
        echo "Error calculating total amount: " . mysqli_error($con);
        exit;
    }

    // Return success message
    echo "Amount Saved Successfully";
} else {
    echo "Invalid Request Method";
}

mysqli_close($con);
?>