<?php
include '../config/config.php';
global $con;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'DESC'; // Default to DESC if not provided
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1; // Get current page
    $limit = 10; // Number of records per page
    $offset = ($page - 1) * $limit; // Calculate offset

    // Corrected query for total count
    $count_query = "
        SELECT COUNT(*) as total 
        FROM fee_payment AS fee
        INNER JOIN tbl_trainee AS trainee 
        ON trainee.trainee_id = fee.trainee_id
        WHERE (fee.status = 0 OR fee.status = 1)
        AND trainee.name LIKE '%$search%';
    ";

    $count_result = mysqli_query($con, $count_query);
    $total_records = mysqli_fetch_assoc($count_result)['total'];
    $total_pages = ceil($total_records / $limit); // Calculate total pages

    // Modified pending_query
    $pending_query = "
        SELECT 
            trainee.trainee_id AS trainee_id, 
            trainee.name AS name, 
            trainee.father_name AS father_name, 
            trainee.contact AS contact, 
            trainee.course AS course, 
            COUNT(CASE WHEN fee.status = 0 THEN fee.due_id ELSE NULL END) AS pending_dues, 
            trainee.fee - IFNULL(SUM(CASE WHEN fee.status = 1 THEN fee.amount ELSE 0 END), 0) AS pending_amount
        FROM 
            fee_payment AS fee
        INNER JOIN 
            tbl_trainee AS trainee 
            ON trainee.trainee_id = fee.trainee_id
        WHERE 
            (fee.status = 0 OR fee.status = 1)
            AND trainee.name LIKE '%$search%'
        GROUP BY 
            trainee.trainee_id, 
            trainee.name, 
            trainee.father_name, 
            trainee.contact, 
            trainee.course, 
            trainee.fee
        ORDER BY trainee.id $filter
        LIMIT $limit OFFSET $offset; 
    ";

    $result = mysqli_query($con, $pending_query);

    if (!$result) {
        echo "Error in query: " . mysqli_error($con);
    }

    // Prepare the response data
    $response = [
        'total_pages' => $total_pages,
        'current_page' => $page,
        'data' => []
    ];

    // Check if there are rows returned
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response['data'][] = $row;  // Collect each row of trainee data
        }
    }

    // Return the JSON response
    echo json_encode($response);
} else {
    // Invalid request method, return an error response
    echo json_encode(['error' => 'Invalid request method']);
}

mysqli_close($con);
?>
