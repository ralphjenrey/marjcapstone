<?php
session_start();
include_once('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Use $_GET to retrieve the id parameter from the query string
    $studentId = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($studentId <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid Registrar ID']);
        exit();
    }

    // Prepare and bind
    $stmt = $con->prepare("DELETE FROM tblregistrar WHERE id = ?");
    $stmt->bind_param("i", $studentId);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Registrar deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete Registrar']);
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>