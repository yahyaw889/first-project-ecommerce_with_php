<?php

include '../layout/connect.php';
include '../includes/functions/functions.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name           = $_POST['name'];
    $colors         = $_POST['colors'];
    $price          = $_POST['price'];
    $Description    = $_POST['Description'];
    $count          = $_POST['count'];
    $userID         = $_POST['userID'];
    $catagories     = $_POST['catagories'];

   

    $avatarAllowedExtension = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF', 'avif');  

    
    
    

    if(empty($name))        { $formError[] = 'name must not be empty' ;}
    if(empty($colors))      { $formError[] = 'colors must not be empty' ;}
    if(empty($price))       { $formError[] = 'price must not be empty' ;}
    if(empty($Description)) { $formError[] = 'Description must not be empty' ;}
    if(empty($count))       { $formError[] = 'count must not be empty' ;}
    if(empty($userID))      { $formError[] = 'userID must not be empty' ;}
    if(empty($catagories))  { $formError[] = 'catagories must not be empty' ;}
    


    if(!empty($formError)){
        foreach($formError as $error){
    
            echo   $error . '<br/>';
        }
    }else{
        

        
        $check = $conn->prepare("SELECT name  FROM `item`");
        $check->execute();
        $check = $check->fetchAll();
        $checked = '';
        foreach($check as $user){
            if($user['name'] == $name  ){

                $checked =  'This Name  is already exists';
            }
        }
        
    if( empty($checked)){
    $date =  date('Y-m-d H:i:s');
    
    
    $insert = $conn->prepare("INSERT INTO item ( name, color, price, description,  count, userID, categoryID, date) VALUES ( :name, :color, :price, :description,  :count, :userID, :categoryID, :date)");
    $insert->execute([
        ':name'         => $name,
        ':color'        => $colors,
        ':price'        => $price,
        ':description'  => $Description,
        ':count'        => $count,
        ':userID'       => $userID,
        ':categoryID'   => $catagories,
        ':date'         => $date
    ]);

    
    $select = $conn->prepare("SELECT id FROM item ORDER BY id DESC LIMIT 1");
    $select->execute();
    $row = $select->fetch();
    $id = $row['id'];


        
    
        for ($i = 0; $i < count($_FILES['img']['name']); $i++) {
            $avaName = $_FILES['img']['name'][$i];
            $avaSize = $_FILES['img']['size'][$i];
            $avaType = $_FILES['img']['type'][$i];
            $avaTemp = $_FILES['img']['tmp_name'][$i];
        $avatarAllowedExtension  = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF','avif');  
        $formError = array();
    
        $avaNameParts = explode('.', $avaName);
        $avatarExtension = strtolower(end($avaNameParts));
        
        if(!in_array($avatarExtension, $avatarAllowedExtension)){
            $formError[] = 'This Extension Is Not Allowed';
        }
    $avatars = rand(0, 10000000) . '_' . $avaName;
    move_uploaded_file($avaTemp, "../../layout/image/" . $avatars);

        
    $imgs   = $conn->prepare("INSERT INTO imgs (name , itemID) VALUES (:avatars , :id)");
    $imgs->execute([
        ':avatars' => $avatars,
        ':id'      => $id
    ]);
}
}
    header('Location: ../layout/showItems.php');
    exit();
        
    }
}else{
    redirectHome($checked,  'back',2);
    exit();
}