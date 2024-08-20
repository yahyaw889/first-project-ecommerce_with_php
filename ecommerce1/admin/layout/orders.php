<?php
session_start();

$pageTitle = 'Orders Page';
if(!isset($_SESSION['admin'])){

    header('Location: index.php');
}

include 'init.php';
include $page1 . 'header.php';
include $page1 . 'nav.php';




$allOrders = $conn->prepare("SELECT id, userID , date  , outlet ,count, itemID FROM orders WHERE outlet = 0 ORDER BY date DESC  ");

$allOrders->execute();
$rows = $allOrders->fetchAll();
$allOrders2 = $conn->prepare("SELECT id, userID , date  , outlet,count , itemID FROM orders WHERE outlet = 1 ORDER BY date ASC  ");

$allOrders2->execute();
$rows2 = $allOrders2->fetchAll();
?>
<div class="container-fluid mt-3">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 mb-5">Tables</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables OF Orders</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>ITEM NAME</th>
                            <th>Product status</th>
                            <th>Start date</th>
                            <th>count</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php   foreach($rows as $row){                   ?>
                        <tr>

                            <td>
                                <a href="member.php?do=info&id=<?= $row['userID'] ?>"
                                    style="text-decoration:none;color:#adb5bd">
                                    <?php 
            $user = $row['userID'];
            $callUser = $conn->prepare("SELECT FullName FROM users WHERE userID = :userID");
            $callUser->bindParam(':userID', $user, PDO::PARAM_INT);
            $callUser->execute();
            $userRow = $callUser->fetch();
            echo $userRow['FullName'];
        ?>
                                </a>
                            </td>

                            <td>
                                <a href="member.php?do=info&id=<?= $row['userID'] ?>"
                                    style="text-decoration:none;color:#adb5bd">
                                    <?php 
                                    $callAddress = $conn->prepare("SELECT address FROM users WHERE userID = :userID");
                                    $callAddress->bindParam(':userID', $user, PDO::PARAM_INT);
                                    $callAddress->execute();
                                    $addressRow = $callAddress->fetch();
                                    echo $addressRow['address'];
                                    ?></a>
                            </td>
                            <td><a href="addItems.php?do=info&id=<?= $row['itemID'] ?>"
                                    style="text-decoration:none;color:#adb5bd"><?php
                                $item = $row['itemID'];
                                $callitem = $conn->prepare("SELECT name FROM item WHERE id = $item");
                                $callitem->execute();
                                $itemRow = $callitem->fetch();
                                echo $itemRow['name'];
                                ?></a></td>
                            <td class="text-warning">Pending</td>
                            <td><?= $row['date']?></td>
                            <td><?= $row['count']?></td>
                            <td>$<?php 
                            $itemId = $row['itemID'];
                            $callPrice = $conn->prepare("SELECT price FROM item WHERE id = :itemId");
                            $callPrice->bindParam(':itemId', $itemId, PDO::PARAM_INT);
                            $callPrice->execute();
                            $priceRow = $callPrice->fetch();
                            echo $priceRow['price'] * $row['count'];
                            
                            ?></td>
                            <td><a class="confirm mx-3"
                                    href="../changes/completedActive.php?id=<?=$row['id'] ?>"><button
                                        data-bs-toggle="tooltip" data-bs-title="Accept Order" data-bs-placement="top"
                                        class="btn btn-info btn-sm">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </button>
                                </a></td>

                        </tr>
                        <?php } ?>
                        <?php   foreach($rows2 as $row2){                   ?>
                        <tr>

                            <td>
                                <a href="member.php?do=info&id=<?= $row2['userID'] ?>"
                                    style="text-decoration:none;color:#adb5bd">
                                    <?php 
            $user = $row2['userID'];
            $callUser = $conn->prepare("SELECT FullName FROM users WHERE userID = :userID");
            $callUser->bindParam(':userID', $user, PDO::PARAM_INT);
            $callUser->execute();
            $userrow2 = $callUser->fetch();
            echo $userrow2['FullName'];
        ?>
                                </a>
                            </td>

                            <td>
                                <a href="member.php?do=info&id=<?= $row['userID'] ?>"
                                    style="text-decoration:none;color:#adb5bd">
                                    <?php 
                                    $callAddress = $conn->prepare("SELECT address FROM users WHERE userID = :userID");
                                    $callAddress->bindParam(':userID', $user, PDO::PARAM_INT);
                                    $callAddress->execute();
                                    $addressRow = $callAddress->fetch();
                                    echo $addressRow['address'];
                                    ?></a>
                            </td>
                            <td><a href="addItems.php?do=info&id=<?= $row2['itemID'] ?>"
                                    style="text-decoration:none;color:#adb5bd"><?php
                                $item = $row2['itemID'];
                                $callitem = $conn->prepare("SELECT name FROM item WHERE id = $item");
                                $callitem->execute();
                                $itemRow = $callitem->fetch();
                                echo $itemRow['name'];
                                ?></a></td>
                            <td class="text-success">Completed</td>
                            <td><?= $row2['date']?></td>
                            <td><?= $row2['count']?></td>
                            <td>$<?php 
                            $itemId1 = $row2['itemID'];
                            $callPrice1 = $conn->prepare("SELECT price FROM item WHERE id = :itemId1");
                            $callPrice1->bindParam(':itemId1', $itemId1, PDO::PARAM_INT);
                            $callPrice1->execute();
                            $priceRow1 = $callPrice1->fetch();
                            echo $priceRow1['price'] * $row2['count'];
                            
                            ?></td>
                            <td><button data-bs-toggle="tooltip" data-bs-title="Actived Order" data-bs-placement="top"
                                    class="btn btn-success btn-sm">
                                    <i class="bi bi-check-circle-fill"></i>
                                </button>
                            </td>

                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php
include $page1 . 'footer.php';
?>