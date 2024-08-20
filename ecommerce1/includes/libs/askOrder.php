<?php 
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../../layout/login.php");
    exit();
}

include '../../layout/init.php';
include '../../layout/connect.php';

$orders = new Order();
if (isset($_SESSION['cart'])) {

    foreach ($_SESSION['cart'] as $cart) {

        $order = $orders->askOrder($cart['id'], $cart['quantity'], $_SESSION['id'], $_SESSION['username']);

        if(!$order){
            $err =  'failed to connect';
            redirectBack();
            exit();
        }
    }


    $_SESSION['cart'] = [];
    $_SESSION['total'] = 0;

    redirectBack();
    exit();
}