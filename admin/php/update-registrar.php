<?php
session_start();
include_once('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $status = $_POST['status'];

    // Validation checks
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format'); window.location.href = '../manage-registrar.php';</script>";
        exit();
    }

    if (!ctype_alpha($firstName) || !ctype_alpha($lastName)) {
        echo "<script>alert('First Name and Last Name should contain only alphabetic characters'); window.location.href = '../manage-registrar.php';</script>";
        exit();
    }

    // Check if password was submitted
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = $_POST['password'];
        
        if (strlen($password) < 8) {
            echo "<script>alert('Password must be at least 8 characters long'); window.location.href = '../manage-registrar.php';</script>";
            exit();
        }
        
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $con->prepare("UPDATE tblregistrar SET firstName=?, lastName=?, email=?, status=?, password=? WHERE id=?");
        $stmt->bind_param("sssssi", $firstName, $lastName, $email, $status, $hashedPassword, $id);
    } else {
        $stmt = $con->prepare("UPDATE tblregistrar SET firstName=?, lastName=?, email=?, status=? WHERE id=?");
        $stmt->bind_param("ssssi", $firstName, $lastName, $email, $status, $id);
    }

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Registrar updated successfully'); window.location.href = '../manage-registrar.php';</script>";
    } else {
        if ($con->errno == 1062) { // Duplicate entry error
            echo "<script>alert('Email already exists'); window.location.href = '../manage-registrar.php';</script>";
        } else {
            echo "<script>alert('Failed to update registrar'); window.location.href = '../manage-registrar.php';</script>";
        }
    }

    // Close the statement and conection
    $stmt->close();
    $con->close();
} else {
    header('Location: ../manage-registrar.php');
    exit();
}
?>