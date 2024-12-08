<?php
session_start();
include_once('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentNumber = $_POST['studentNumber'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $program = $_POST['program'];
    $status = $_POST['status'];

    $_SESSION['add-student']['studentNumber'] = $studentNumber;
    $_SESSION['add-student']['firstName'] = $firstName;
    $_SESSION['add-student']['lastName'] = $lastName;
    $_SESSION['add-student']['email'] = $email;
    $_SESSION['add-student']['program'] = $program;
    $_SESSION['add-student']['status'] = $status;

    // Validation checks
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format'); window.location.href = '../manage-student.php';</script>";
        exit();
    }

    if (!ctype_alpha($firstName) || !ctype_alpha($lastName)) {
        echo "<script>alert('First Name and Last Name should contain only alphabetic characters'); window.location.href = '../manage-student.php';</script>";
        exit();
    }

    if (!ctype_alnum($studentNumber)) {
        echo "<script>alert('Student Number should contain only alphanumeric characters'); window.location.href = '../manage-student.php';</script>";
        exit();
    }

    if (strlen($password) < 8) {
        echo "<script>alert('Password must be at least 8 characters long'); window.location.href = '../manage-student.php';</script>";
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and bind
    $stmt = $con->prepare("INSERT INTO tblstudents (studentNumber, firstName, lastName, email, password, program, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $studentNumber, $firstName, $lastName, $email, $hashedPassword, $program, $status);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the manage-student.php page with a success message
        header('Location: ../manage-student.php?message=Student added successfully');
    } else {
        // Redirect to the manage-student.php page with an error message
        header('Location: ../manage-student.php?error=Failed to add student');
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
} else {
    // Redirect to the manage-student.php page if the request method is not POST
    header('Location: ../manage-student.php');
}
