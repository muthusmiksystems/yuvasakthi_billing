<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if file was uploaded without errors
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $allowed = ['xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'xls' => 'application/vnd.ms-excel'];
        $filename = $_FILES['file']['name'];
        $filetype = $_FILES['file']['type'];
        $filesize = $_FILES['file']['size'];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) {
            die("Error: Please select a valid file format.");
        }

        // Verify file type
        if (in_array($filetype, $allowed)) {
            // Move the uploaded file to a designated directory
            $target_directory = "../uploads/";
            if (!is_dir($target_directory)) {
                mkdir($target_directory, 0755, true);
            }
            $target_file = $target_directory . basename($filename);
            move_uploaded_file($_FILES['file']['tmp_name'], $target_file);

            try {
                // Load the uploaded file
                $spreadsheet = IOFactory::load($target_file);

                // Get the active sheet
                $sheet = $spreadsheet->getActiveSheet();

                // Get the highest row and column numbers referenced in the worksheet
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

                // Loop through each row of the worksheet in turn
                for ($row = 1; $row <= $highestRow; ++$row) {
                    // Read a row of data into an array
                    $rowData = [];
                    for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                        $cellValue = $sheet->getCellByColumnAndRow($col, $row)->getValue();
                        $rowData[] = $cellValue;
                    }
                    // Process row data (e.g., print it)
                    echo implode(", ", $rowData) . "<br>";
                }
            } catch (Exception $e) {
                echo 'Error loading file: ', $e->getMessage();
            }
        } else {
            echo "Error: There was a problem uploading your file. Please try again.";
        }
    } else {
        echo "Error: " . $_FILES['file']['error'];
    }
}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Excel File</title>
</head>
<body>
    <form action="import.php" method="post" enctype="multipart/form-data">
        <center>
            <h1> Import xls file</h1>
        <table border="1">
            <tr>
        <td> <label for="file">Choose Excel file to upload:</label></td>
        <td><input type="file" name="file" id="file" accept=".xlsx,.xls"></td></tr>
        <tr>
        <td style="text-align:right"><input type="submit" value="Upload File" name="submit"></td>
        <td style="text-align:center"><a href="home.php"><input type="button" value="Cancel" name="Cancel"></a></td>
        </tr>
        </table></center>
    </form>
</body>
</html>

