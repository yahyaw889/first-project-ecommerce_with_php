<?php
session_start();
include "init.php";


isset($_GET['id']) ? $id = $_GET['id'] : $id = 0;  
if($id == 0){
    header("location:index.php");
    exit();
}

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}


if (isset($_SESSION['cart'][$id])) {

    $_SESSION['cart'][$id]['quantity'] += 1;
} else {

    $_SESSION['cart'][$id] = ['id' => $id, 'quantity' => 1];
}

if(isset($_SESSION['cart'][$id])){
    redirectBack();
    exit();
}
?>


// header("location:index.php");
// exit();
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// $productId = $_POST['product_id'];

// $product = $products->getItem($productId);

// $pro = mysqli_fetch_assoc($product);

// if(!isset($_SESSION['cart'])){
// $_SESSION['cart'] = [];
// }

// if (isset($_SESSION['cart'][$productId])) {
// $_SESSION['cart'][$productId]['quantity'] += 1;
// }else{
// $_SESSION['cart'][$productId] = $pro[$productId];
// $_SESSION['cart'][$productId]['quantity'] = 1;
// }
// $cartItems = [];
// foreach ($_SESSION['cart'] as $id => $pro) {
// $cartItems[] = [
// 'name' => $pro['name'],
// 'quantity' => $pro['quantity']
// ];
// }

// echo json_encode(['items' => $cartItems]);

// }