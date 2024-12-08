<?php
// upload.php
session_start();
include_once '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $student_id = $_SESSION['student_id'];
        $program = $_POST['program'];
        $fileType = $_POST['fileType'];
        $status = isset($_POST['status']) ? mysqli_real_escape_string($con, $_POST['status']) : 'pending';

        if (!isset($_FILES['file'])) {
            throw new Exception('No file uploaded');
        }

        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        
        // Get file extension
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
        
        if ($fileError !== 0) {
            throw new Exception('Error uploading file');
        }
        
        if (!in_array($fileExt, $allowed)) {
            throw new Exception('Invalid file type');
        }
        
        if ($fileSize >= 5000000) {
            throw new Exception('File is too large (max 5MB)');
        }

        // Create unique filename
        $fileNameNew = uniqid('', true) . "." . $fileExt;
        $fileDestination = $projectRoot . '/uploads/' . $fileNameNew;
        
        if (!move_uploaded_file($fileTmpName, $fileDestination)) {
            throw new Exception('Failed to move uploaded file');
        }

        $query = mysqli_query($con, 
            "INSERT INTO tblfile (fileName, filePath, fileType, status, studentId) 
             VALUES ('$fileName', '$fileDestination', '$fileType', '$status', $student_id)"
        );
        
        if (!$query) {
            throw new Exception("Database error: " . mysqli_error($con));
        }

        $_SESSION['success'] = "File uploaded successfully";

    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    } finally {
        header('Location: ../program-students.php?program=' . urlencode($program));
        exit();
    }
}
?>