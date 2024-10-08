<?php
include "../config/config.php";  // Include your database configuration

// Collecting data from POST request
$name = $_POST['sname'];
$father_name = $_POST['fname'];
$email = $_POST['email'];
$address = $_POST['address'];
$contact = $_POST['phone'];
$course = $_POST['course'];
$gender = $_POST['gender'];
$doj = $_POST['doj'];
$fee = $_POST['fee'];
// $initialAmt = $_POST['initialAmt'];
$nodues = $_POST['nodues'];
$dues = isset($_POST['dues']) ? $_POST['dues'] : []; // This is an array of due data
$init_amt = $_POST['init_amt'];

$len = strlen($contact);
$tr1 = substr($name, 0, 3);
$tr2 = substr($contact, $len - 4, $len);
$m = $tr1 . $tr2;  // Generating trainee ID

global $con;
$get_bill_no = "SELECT MAX(bill_no) AS last_bill_no FROM tbl_trainee";
$bill_no = mysqli_query($con, $get_bill_no);
$row = mysqli_fetch_assoc($bill_no);
$last_bill_no = $row['last_bill_no'];
$new_bill_no = $last_bill_no == 0 ? 3000 : $last_bill_no + 1;  // Generating new bill number

// Inserting trainee data
$query = "INSERT INTO tbl_trainee SET trainee_id='$m', name='$name', father_name='$father_name', email='$email', address='$address', contact='$contact', course='$course', gender='$gender', doj='$doj', fee='$fee', no_dues='$nodues', bill_no='$new_bill_no'";
$result = mysqli_query($con, $query);

if ($result) {
    // Inserting dues data
    if (!empty($dues)) {

        foreach ($dues as $due) {
            $due_no = $due['dueNo'];
            $due_amt = $due['dueAmt'];
            $due_date = $due['dueDate'];

            $query1 = "INSERT INTO fee_payment SET trainee_id='$m', amount='$due_amt', date='$due_date', status=0, bill_no='$new_bill_no', due_id='$due_no'";
            $result1 = mysqli_query($con, $query1);
            if (!$result1) {
                // Sending JSON error response for dues insertion failure
                echo json_encode(["status" => "error", "message" => "Error inserting due: " . mysqli_error($con)]);
                exit;
            }
        }
    }
    // else {
    //     $query1 = "INSERT INTO fee_payment SET trainee_id='$m', amount='$fee', date=Now(), status=0, bill_no='$new_bill_no', due_id='0',payment_type='initial'";
    //     $result1 = mysqli_query($con, $query1);
    //     if (!$result1) {
    //         // Sending JSON error response for dues insertion failure
    //         echo json_encode(["status" => "error", "message" => "Error inserting due: " . mysqli_error($con)]);
    //         exit;
    //     }
    // }
    // Sending JSON success response
    $query1 = "INSERT INTO fee_payment SET trainee_id='$m', amount='$init_amt', status=0, bill_no='$new_bill_no',payment_type='initial'";
    $result1 = mysqli_query($con, $query1);
    if (!$result1) {
        // Sending JSON error response for dues insertion failure
        echo json_encode(["status" => "error", "message" => "Error inserting due: " . mysqli_error($con)]);
        exit;
    }
    echo json_encode(["status" => "success", "message" => "Data Saved Successfully"]);
} else {
    // Sending JSON error response for trainee insertion failure
    echo json_encode(["status" => "error", "message" => "Error inserting trainee: " . mysqli_error($con)]);
}

mysqli_close($con);  // Closing the database connection
?>