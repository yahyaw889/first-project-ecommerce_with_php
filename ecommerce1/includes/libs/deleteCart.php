<?php
session_start();
isset($_GET['id']) ? $id = $_GET['id'] : $id = 0;

if($id !== 0){
    $_SESSION['cart'][$id] = '';
    unset($_SESSION['cart'][$id]);

}
if(!isset($_SESSION['cart'])){
    $_SESSION['total'] = 0;
}

header("location:../../layout/checkout.php");
exit();