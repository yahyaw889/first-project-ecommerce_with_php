<?php
// include '../layout/init.php';
include '../layout/connect.php';

include '../includes/functions/functions.php';
$pageTitle = 'Edit Error Page';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id             = $_POST['id'];
    $name           = $_POST['name'];
    $colors         = $_POST['colors'];
    $price          = $_POST['price'];
    $description    = $_POST['Description'];
    $count          = $_POST['count'];
    $catagories     = $_POST['catagories'];
    $trustSeller    = $_POST['trustSeller'];
    $size    = $_POST['size'];
    
    $formError = array();

    if(empty($name))        { $formError[] = 'name must not be empty' ;}
    if(empty($colors))      { $formError[] = 'colors must not be empty' ;}
    if(empty($price))       { $formError[] = 'price must not be empty' ;}
    if(empty($size))       { $formError[] = 'size must not be empty' ;}
    if(empty($description)) { $formError[] = 'Description must not be empty' ;}
    if(empty($count))       { $formError[] = 'count must not be empty' ;}
    if(empty($catagories))  { $formError[] = 'catagories must not be empty' ;}

    

if (isset($_FILES['img']['name'][0]) && $_FILES['img']['error'][0] == 0) {

    $avatarAllowedExtension = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF', 'avif');  
    $formError = array();

    for ($i = 0; $i < count($_FILES['img']['name']); $i++) {
        $avaName = $_FILES['img']['name'][$i];
        $avaSize = $_FILES['img']['size'][$i];
        $avaType = $_FILES['img']['type'][$i];
        $avaTemp = $_FILES['img']['tmp_name'][$i];

        $avaNameParts = explode('.', $avaName);
        $avatarExtension = strtolower(end($avaNameParts));

        if (!in_array($avatarExtension, $avatarAllowedExtension)) {
            $formError[] = "File extension not allowed: $avaName";
        }

        if (empty($formError)) {
            $avatars = rand(0, 10000000) . '_' . $avaName;
            move_uploaded_file($avaTemp, "../../layout/image/" . $avatars);

            $imgs = $conn->prepare("INSERT INTO imgs (name, itemID) VALUES (:avatars, :id)");
            $imgs->execute([
                ':avatars' => $avatars,
                ':id' => $id
            ]);
        }
    }

    if (!empty($formError)) {
        foreach ($formError as $error) {
            redirectHome($error, 'back');
        }
    } else {
        $stmt = $conn->prepare("UPDATE item SET name = ?, color = ?, price = ?, size = ?, description = ?, trustSeller = ?, count = ?, categoryID = ? WHERE id = ?");
        $stmt->execute(array($name, $colors, $price, $size, $description, $trustSeller, $count, $catagories, $id));
    }
    header('Location: ../layout/showItems.php');
    exit();
}



} else {
    redirectHome('Error: You can not browse this page directly.', 'back');

}