<?php

$getCart = new Carts();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Shopee</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="style/all.min.css">
    <link rel="stylesheet" href="style/min.css">
    <link rel="stylesheet" href="style/owl.min.css">
    <link rel="stylesheet" href="style/default.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <!-- Owl-carousel CDN -->
    <!-- font awesome icons -->
    <!-- Custom CSS file -->
    <link rel="stylesheet" href="style/style.css">
    <style>
    * {
        scroll-behavior: smooth;
    }

    .navbar-dark {
        background-color: black !important;
    }

    h6 {
        font-weight: bold !important;
    }

    header {
        height: 70px;
        background-color: #000;
    }

    #banner-area {
        height: 50vh;
    }

    #banner-area .ads img {
        height: 290px !important;
    }

    #banner-area .big img {
        height: 540px !important;
    }

    #topSallery {
        height: 255px !important;
    }

    #head {
        padding-top: 14px;
    }

    .market-partition {
        display: flex;
        justify-content: center;
    }

    .market-partition img {
        width: 100px;
        cursor: pointer;
        margin: 15px;
    }

    .normalBox {
        /* box-shadow: 9px 5px 10px 12px #e2e2e2 !important; */
        border: none !important;

    }

    .grid {
        margin-left: -150px;
        margin-right: -150px;
        padding-left: 0;
        padding-right: 0;

    }

    #bigImg {
        height: 540px !important;
    }

    .grid-item {
        width: 250px;
    }

    #special-price {
        margin: 0;
        padding: 10px;
    }

    #btn-head:hover {
        background-color: blue;
    }
    </style>
</head>

<body>
    <!-- start #header -->
    <header id="header">


        <!-- Primary Navigation -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <!-- Brand -->
            <a class="navbar-brand" href="#">New Shop</a>

            <!-- Links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mt-2">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link" href="cart.php">Shop</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link" href="login.php">My Account</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown my-2 mx-3">
                    <button type="button" class="btn btn-dark" id="btn-head" data-toggle="dropdown"
                        aria-expanded="false">
                        <i class=" fa fa-shopping-cart" aria-hidden="true"></i> Cart <span
                            class="badge badge-pill badge-danger"><?php
                            isset( $_SESSION['cart']) ? $cart = count($_SESSION['cart']) :$cart = 0;
                            echo $cart;
                            ?></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width: 335px !important;">
                        <div class="total-header-section p-3">
                            <div class="d-flex justify-content-between">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span
                                    class="badge badge-pill badge-danger"><?php
                            
                            echo $cart;
                            ?></span>
                            </div>
                            <div class="text-right mt-2">
                                <p>Total: <span
                                        class="text-info">$<?= isset($_SESSION['total']) ? $_SESSION['total'] : 0 ?>.24</span>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="cart-detail p-3">
                            <?php 
                            if($cart != 0){
                            foreach($_SESSION['cart'] as $one_cart ){

                            $id = $one_cart['id'];
                            $oneCart =$getCart->getItem($id);
                            $oneImg =$getCart->itemImg($id);
                            while($newCart = mysqli_fetch_assoc($oneCart)){
                            ?>
                            <div class="d-flex mb-3">
                                <?php while($one_img = mysqli_fetch_array($oneImg)){ ?>
                                <img src="image/<?= $one_img['name'] ?>" class="img-fluid mr-3" style="width: 50px;">
                                <?php }?>
                                <div>
                                    <p><?= $newCart['name'] ?></p>
                                    <span class="price text-info">$<?= $newCart['price']?></span> <span class="count">
                                        Quantity:
                                        <?= $one_cart['quantity']?></span>
                                </div>
                            </div>
                            <hr>
                            <?php 

                 isset($_SESSION['total']) ? $_SESSION['total'] += ($newCart['price'] * $one_cart['quantity']) : $_SESSION['total'] = ($newCart['price'] * $one_cart['quantity']);
                        } } }?>

                        </div>
                        <div class="text-center p-3">
                            <a href="checkout.php"> <button class="btn btn-primary btn-block">Checkout</button></a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- !Primary Navigation -->

    </header>