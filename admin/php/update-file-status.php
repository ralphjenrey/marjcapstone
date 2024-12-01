<?php
session_start();
require_once('../includes/config.php');

if (!isset($_SESSION['aid'])) {
    exit(json_encode(['success' => false, 'message' => 'Unauthorized']));
}

$file_id = isset($_POST['file_id']) ? (int)$_POST['file_id'] : 0;
$status = isset($_POST['status']) ? $_POST['status'] : '';
if (!in_array($status, ['approved', 'rejected'])) {
    exit(json_encode(['success' => false, 'message' => 'Invalid status']));
}

$stmt = mysqli_prepare($con, "UPDATE tblfile SET status = ?, updated_at = NOW() WHERE id = ?");
mysqli_stmt_bind_param($stmt, "si", $status, $file_id);

$success = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

echo json_encode(['success' => $success]);
