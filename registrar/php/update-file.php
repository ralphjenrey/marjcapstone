<?php
session_start();
include_once('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $fileId = intval($_POST['fileId']);
        $fileType = mysqli_real_escape_string($con, $_POST['fileType']);

        // Start transaction
        mysqli_begin_transaction($con);

        if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
            // Handle new file upload
            $file = $_FILES['file'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];

            // Generate unique filename
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $fileNameNew = uniqid('', true) . "." . $fileExt;
            $fileDestination = $projectRoot . '/uploads/' . $fileNameNew;

            if (!move_uploaded_file($fileTmpName, $fileDestination)) {
                throw new Exception('Failed to move uploaded file');
            }

            // Update database with new file
            $query = "UPDATE tblfile SET 
                     fileName = ?, 
                     filePath = ?, 
                     fileType = ? 
                     WHERE id = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "sssi", $fileName, $fileDestination, $fileType, $fileId);
        } else {
            // Update only file type
            $query = "UPDATE tblfile SET fileType = ? WHERE id = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "si", $fileType, $fileId);
        }

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Database error: " . mysqli_error($con));
        }

        mysqli_commit($con);
        $_SESSION['success'] = "File updated successfully";
    } catch (Exception $e) {
        mysqli_rollback($con);
        $_SESSION['error'] = $e->getMessage();
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
