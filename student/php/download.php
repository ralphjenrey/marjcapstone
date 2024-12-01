<?php
// download.php
session_start();
include_once('../includes/config.php');

if (!isset($_GET['file']) || !isset($_SESSION['sauth'])) {
    header('HTTP/1.0 403 Forbidden');
    exit('Access denied');
}

$file_id = intval($_GET['file']);

// Get file info from database
$stmt = mysqli_prepare($con, "SELECT fileName, filePath FROM tblfile WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $file_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$file = mysqli_fetch_assoc($result);

if (!$file || !file_exists($file['filePath'])) {
    header('HTTP/1.0 404 Not Found');
    exit('File not found');
}

// Set headers
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file['fileName']) . '"');
header('Content-Length: ' . filesize($file['filePath']));
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: public');

// Output file
readfile($file['filePath']);
exit();