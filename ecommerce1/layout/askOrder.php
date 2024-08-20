<?php 
session_start();

if (!isset($_SESSION['login'])) {
    header("Location:login.php");
    exit();
}

include 'init.php';


$orders = new Order();
if (isset($_SESSION['cart'])) {

    foreach ($_SESSION['cart'] as $cart) {

        $order = $orders->askOrder($cart['id'], $cart['quantity'], $_SESSION['id'], $_SESSION['userName']);

        if(!$order){
            $err =  'failed to connect';
            redirectBack();
            exit();
        }
    }

    $_SESSION['msg'] = "<h1 class='my-3'>The order will arrive near :)</h1>";
    $_SESSION['cart'] = [];
    $_SESSION['total'] = 0;

    redirectBack();
    exit();
}