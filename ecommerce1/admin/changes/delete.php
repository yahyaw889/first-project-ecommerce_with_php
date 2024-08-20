<?php

include '../layout/connect.php';
include '../includes/functions/functions.php';
$userId = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0; 

if ($userId != 0) {
    if($userId == $_SESSION['id']){
        redirectHome('Error: You cannot delete yourself.', '../layout/dashboard.php' , 2);
    }else{
        $stmt = $conn->prepare("DELETE FROM `users` WHERE userID = :userId LIMIT 1");
    $stmt->execute(['userId' => $userId]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        header("Location: ../layout/dashboard.php");
    } else {
        redirectHome('Error: Cannot delete this user.', '../layout/dashboard.php' , 2);
    }
    }
    
}