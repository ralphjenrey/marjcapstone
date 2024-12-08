<?php
include 'includes/config.php';

if (isset($_GET['deleteid'])) {
    $id = intval($_GET['deleteid']);

    $stmt = $con->prepare("DELETE FROM `tblenrollment` WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect back to the same page after deletion
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        die("Error deleting record: " . $stmt->error);
    }

    $stmt->close();
} else {
    die("Invalid request. Enrollment ID is missing.");
}

$con->close();
?>
