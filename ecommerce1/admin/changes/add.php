<?php

include '../layout/connect.php';
include '../includes/functions/functions.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username   = $_POST['username'];
    $fullName   = $_POST['fullName'];
    $email      = $_POST['Email'];
    $password   = $_POST['password'];
    $phone      = $_POST['phone'];
    $age        = $_POST['age'];
    $country    = $_POST['country'];
    $groupID    = $_POST['groupID'];
    $Gender     = $_POST['Gender'];
    $passhash   = sha1($password);


    $formError = array();



    if(empty($password)) { $formError[] = 'Password must not be empty' ;}
    if(empty($username)) { $formError[] = 'Username must not be empty' ;}
    if(empty($email)) { $formError[] = 'Email must not be empty' ;}
    if(empty($phone)) { $formError[] = 'Phone must not be empty' ;}
    if(empty($fullName)) { $formError[] = 'Full Name must not be empty' ;}
    if(empty($Gender)) { $formError[] = 'Gender must not be empty' ;}
    if(empty($age)) { $formError[] = 'Age must not be empty' ;}
    if(empty($country)) { $formError[] = 'Country must not be empty' ;}


    if(!empty($formError)){
        foreach($formError as $error){
    
            echo   $error . '<br/>';
        }
    }else{
        $check = $conn->prepare("SELECT username , Email FROM `users`");
        $check->execute();
        $check = $check->fetchAll();
        $checked = '';
        foreach($check as $user){
            if($user['username'] == $username  ){

                $checked =  'This Username  is already exists';
            }elseif($user['Email'] == $email){
                $checked = 'This Email is already exists';
            }
        }
        
    if( empty($checked)){
    $Gender == 'Male'? $Gender = 1 : $Gender = 0;
    $country == 'Egypt'? $country = 1 : $country = 0;
    $groupID == 'Admin' ? $groupID = 1 : ($groupID == 'Manager' ? $groupID = 2 : $groupID == 'User' ) ;
    $date =  date('Y-m-d H:i:s');
    
    $insert = $conn->prepare("INSERT INTO users (username, password, Email, phone, fullName, Gender, age, groupID, country,date) VALUES (:username, :password, :email, :phone, :fullName, :Gender, :age, :groupID, :country , :date)");
    $insert->execute([
        ':username' => $username,
        ':password' => $passhash,
        ':email' => $email,
        ':phone' => $phone,
        ':fullName' => $fullName,
        ':Gender' => $Gender,
        ':age' => $age,
        ':groupID' => $groupID,
        ':country' => $country,
        ':date' => $date
    ]);
    header('Location: ../layout/dashboard.php');
    exit();
        }else{
            redirectHome($checked,  'back',2);
        }
    }
}
?>