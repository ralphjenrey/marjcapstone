<?php
session_start();
include_once('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $registrarNumber = $_POST['registrarNumber'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $status = $_POST['status'];

    // Store in session for form persistence
    $_SESSION['add-registrar'] = [
        'registrarNumber' => $registrarNumber,
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'status' => $status
    ];

    // Validation checks
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format'); window.location.href = '../manage-registrar.php';</script>";
        exit();
    }

    if (!preg_match("/^[a-zA-Z\s'-]+$/", $firstName) || !preg_match("/^[a-zA-Z\s'-]+$/", $lastName)) {
        echo "<script>alert('First Name and Last Name should contain only alphabetic characters, spaces, hyphens, and apostrophes'); window.location.href = '../manage-registrar.php';</script>";
        exit();
    }

    if (!ctype_alnum($registrarNumber)) {
        echo "<script>alert('Registrar Number should contain only alphanumeric characters'); window.location.href = '../manage-registrar.php';</script>";
        exit();
    }

    if (strlen($password) < 8) {
        echo "<script>alert('Password must be at least 8 characters long'); window.location.href = '../manage-registrar.php';</script>";
        exit();
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and bind
    $stmt = $con->prepare("INSERT INTO tblregistrar (registrarNumber, firstName, lastName, email, password, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $registrarNumber, $firstName, $lastName, $email, $hashedPassword, $status);

    // Execute the statement
    if ($stmt->execute()) {
        unset($_SESSION['add-registrar']); // Clear session on success
        echo "<script>alert('Registrar added successfully'); window.location.href = '../manage-registrar.php';</script>";
    } else {
        if ($con->errno == 1062) { // Duplicate entry error
            echo "<script>alert('Registrar Number or Email already exists'); window.location.href = '../manage-registrar.php';</script>";
        } else {
            echo "<script>alert('Failed to add registrar'); window.location.href = '../manage-registrar.php';</script>";
        }
    }

    // Close the statement and conection
    $stmt->close();
    $con->close();
} else {
    header('Location: ../manage-registrar.php');
    exit();
}
