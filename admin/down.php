<?php
// download.php

// Start output buffering to prevent output before headers
ob_start();

// Check if file parameter is set
if(isset($_GET['file'])) {
    $file = $_GET['file'];

    // Set headers to force download
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Content-Length: ' . filesize($file));

    // Read the file and output it to the browser
    readfile($file);
    exit;
}

// End output buffering and send output to the browser
ob_end_flush();
?>
