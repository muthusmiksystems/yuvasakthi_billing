<?php

include "../config/config.php";

$tid = $_GET['tid'];

global $con;

$query1 = "select initial_amt,no_dues,fee from tbl_trainee where trainee_id='" . $tid . "'";

$result1 = mysqli_query($con, $query1);

$rows1 = mysqli_fetch_assoc($result1);

$query = "select * from fee_payment where trainee_id='" . $tid . "' order by date desc";

$result = mysqli_query($con, $query);

if ($result) {

    // Fetch the data

    // $product_list = [];

    // $new_list = new stdClass();

    // $new_list->date = "Initial amount";

    // $new_list->amount = $rows1['initial_amt'];

    // $new_list->status = 1;

    // $product_list[] = $new_list;

    //$product_list[] = $new_list2;

    //$banana->color = "yellow"; //[{"initial_amt":$rows1['initial_amt'],"no_dues": $rows1['no_dues']}];



    while ($row = mysqli_fetch_assoc($result)) {

        // Store each row in the $product_list array





        $product_list[] = $row;

    }

    //$product_list['initial_amt'] = $rows1['initial_amt'];

    //$product_list['no_dues'] = $rows1['no_dues'];  

    // Output the result (for testing purposes)

    echo json_encode($product_list); // Output as JSON for easy debugging

} else {

    // Query failed, handle the error

    echo "Error: " . mysqli_error($conn1);

}



// Close the connection

mysqli_close($con);

?>