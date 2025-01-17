<?php
session_start();
include_once('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Use $_GET to retrieve the id parameter from the query string
    $studentId = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($studentId <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid student ID']);
        exit();
    }

    // Prepare and bind
    $stmt = $con->prepare("DELETE FROM tblstudents WHERE id = ?");
    $stmt->bind_param("i", $studentId);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Student deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete student']);
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>