<?php
session_start();

$pageTitle = 'Info Page';
if(!isset($_SESSION['admin'])){

    header('Location: index.php');
}

include 'init.php';
include $page1 . 'header.php';
include $page1 . 'nav.php';

// echo countItem('userID','users');
?>

<section class="info_section" style="margin: 62px auto;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6" style="margin-top: 20px; width: 100%;">
                <a href="dashboard.php" style="text-decoration: none;">
                    <div class="card border-primary">
                        <div class="card-body bg-primary text-white">
                            <div class="row">
                                <div class="col-md-3 d-flex align-items-center justify-content-center">
                                    <i class="fa fa-random fa-5x"></i>
                                </div>
                                <div class="col-md-9 d-flex flex-column align-items-center justify-content-center text-center"
                                    style="margin-left: -180px">
                                    <h2>
                                        <?= countItem('userID','users'); ?>
                                    </h2>
                                    <h4>Total Members</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>



            <div class="col-lg-4 col-md-6" style="margin-top: 20px">
                <a href="orders.php" style="text-decoration: none;">
                    <div class="card border-secondary">
                        <div class="card-body bg-secondary text-white">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-user-graduate fa-5x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <h2 class="mx-5"><?= countItem('id','orders'); ?></h2>
                                    <h4>...Orders</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6" style="margin-top: 20px">
                <a href="Admin.php" style="text-decoration: none;">
                    <div class="card border-success">
                        <div class="card-body bg-success text-white">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-user-tie fa-5x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <h2 class="mx-5">
                                        <?= countItem('groupID','users WHERE groupID = 1')?>
                                    </h2>
                                    <h4 class="mx-4">Admin</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6" style="margin-top: 20px">
                <a href="Mangers.php" style="text-decoration: none;">
                    <div class="card border-success">
                        <div class="card-body bg-success text-white">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-user-tie fa-5x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <h2 class="mx-5">
                                        <?= countItem('groupID','users WHERE groupID = 2')?>
                                    </h2>
                                    <h4 class="mx-2">Mangers</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6" style="margin-top: 20px">
                <a href="activeUser.php" style="text-decoration: none;">
                    <div class="card border-danger">
                        <div class="card-body bg-danger text-white">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <h2 class="mx-5"><?= countItem('groupID','users WHERE statusReg = 0')?></h2>
                                    <h4>Need Actived</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6" style="margin-top: 20px">
                <a href="Catagories.php" style="text-decoration: none;">
                    <div class="card border-warning">
                        <div class="card-body bg-warning text-white">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-university fa-5x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <h2 class="mx-5">
                                        <?= countItem('id' , 'catagories')  ?>
                                    </h2>
                                    <h4 class="mx-2">Categories</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6" style="margin-top: 20px">
                <a href="" style="text-decoration: none;">
                    <div class="card border-info">
                        <div class="card-body bg-info text-white">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fa fa-suitcase fa-5x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <h2 class="mx-5"><?= countItem('id' , 'item')  ?></h2>
                                    <h4 class="mx-2">Total Items</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    </div>
</section>




<?php

include $page1 . 'footer.php' ;