<?php

include '../layout/connect.php';
include '../includes/functions/functions.php';

$userId = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0; 

if ($userId != 0) {
    $stmt = $conn->prepare("UPDATE users SET statusReg = :statusReg WHERE userID = :userId LIMIT 1");
    $stmt->execute(['statusReg' => 1, 'userId' => $userId]);
    
    $count = $stmt->rowCount();
    
    if ($count > 0) {
        header("Location: ../layout/activeUser.php");
        exit(); 
    } else {
        redirectHome('Error: Cannot Activate this user.', '../layout/activeUser.php' , 2);
    }
}