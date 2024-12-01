<?php
include_once('../includes/config.php');
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];
    
    if (mysqli_query($con, "DELETE FROM tblfile WHERE id = " . intval($id))) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => mysqli_error($con)
        ]);
    }
    exit();
}