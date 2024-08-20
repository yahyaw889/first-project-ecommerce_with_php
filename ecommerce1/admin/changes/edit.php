<?php
include '../layout/init.php';
include '../includes/functions/functions.php';
$pageTitle = 'Edit Error Page';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id       = $_POST['userID'];
    $username = $_POST['username'];
    $email    = $_POST['Email'];
    $phone    = $_POST['phone'];
    $fullName = $_POST['fullName'];
    $gender   = $_POST['Gender'];
    $age      = $_POST['age'];
    $country  = $_POST['country'];
    $password = $_POST['newpass'];
    $groupID  = $_POST['groupID'];
    $formError = array();

    if(empty($username)) { $formError[] = 'Username must not be empty' ;}
    if(empty($email)) { $formError[] = 'Email must not be empty' ;}
    if(empty($phone)) { $formError[] = 'Phone must not be empty' ;}
    if(empty($fullName)) { $formError[] = 'Full Name must not be empty' ;}
    if(empty($gender)) { $formError[] = 'Gender must not be empty' ;}
    if(empty($age)) { $formError[] = 'Age must not be empty' ;}
    if(empty($country)) { $formError[] = 'Country must not be empty' ;}
    
    
    
    empty($password)  ?$password = $_POST['oldpass']: $password = sha1($password);
    if(!empty($formError)){
    foreach($formError as $error){
        redirectHome($error,  '../layout/dashboard.php');
    }
    }else{
    $gender == 'Male'   ? $gender = 1  : $gender = 2;
    
    $country == 'Egypt' ? $country = 1 : $country = 2;
    
    $date =  date('Y-m-d H:i:s');

    $stmt = $conn->prepare("UPDATE users SET username = ?, Email = ?, phone = ?, fullName = ?, Gender = ?, age = ?, country = ?,groupID = ?,date = ? ,password = ? WHERE userID = ?");
$stmt->execute(array($username, $email, $phone, $fullName, $gender, $age, $country, $groupID, $date,$password , $id));

    header('Location: ../layout/dashboard.php');
    }

} else {
    redirectHome('Error: You can not browse this page directly.', 'back');

}