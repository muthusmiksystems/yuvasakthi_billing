<?php
require_once '../../vendor/autoload.php'; // Adjust path to your autoload.php
use Dompdf\Dompdf;
use Dompdf\Options;

// Initialize Dompdf with options
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

session_start();
if ($_SESSION["X"] == "") {
    header('location:index.php');
    exit();
}
// Retrieve the HTML content sent via POST
if (isset($_POST['html_content'])) {
    $html = $_POST['html_content'];

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait'); // Adjust according to your needs
    $dompdf->render();
    $dompdf->stream("Fees_Collection.pdf", array("Attachment" => true)); // Set to false to open in browser
    exit();
}
?>