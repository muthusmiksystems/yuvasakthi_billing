<?php
 include "../config/config.php";
 $tid = $_GET['tid'];
 global $con;
 $query = "select * from tbl_trainee where trainee_id='".$tid."'";
 $result = mysqli_query($con, $query);
  if ($result) {
    // Fetch the data
    $product_list = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // Store each row in the $product_list array
        $product_list[] = $row;
    }
    // Output the result (for testing purposes)
    echo json_encode($product_list); // Output as JSON for easy debugging
} else {
    // Query failed, handle the error
    echo "Error: " . mysqli_error($conn1);
}

// Close the connection
mysqli_close($con);
 ?>

