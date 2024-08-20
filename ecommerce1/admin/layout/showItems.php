<?php
session_start();
include 'connect.php';
$pageTitle = 'items Page';
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit();
}

include 'init.php';
include $page1 . 'header.php';
include $page1 . 'nav.php';

$id = isset($_GET['do']) && is_numeric($_GET['do']) ? $_GET['do'] : 0;

if ($id != 0) {
    $stmt = $conn->prepare("SELECT * FROM item WHERE categoryID = :id");
    $stmt->execute(['id' => $id]);
    $rows = $stmt->fetchAll();
    $count = $stmt->rowCount();
    
        ?>
<div class="container-fluid mt-5">
    <h1 class="h3 mb-2 text-gray-800 mb-5">Tables</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name OF Item</th>
                            <th>Colors</th>
                            <th>Seller</th>
                            <th>Count</th>
                            <th>Start date</th>
                            <th>Price</th>
                            <th>Trusted</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                if ($count > 0) {
                                foreach ($rows as $row) {
                                    ?>
                        <tr>
                            <td><a href="addItems.php?do=info&id=<?= $row['id'] ?>"
                                    style="text-decoration:none;color:#adb5bd"><?=$row['name']?></a></td>
                            <td><?=$row['color']?>
                            </td>
                            <td><a href="member.php?do=info&id=<?= $row['userID'] ?>"
                                    style="text-decoration:none;color:#adb5bd">
                                    <?php
                            $user = $row['userID'];
                            $stmt5 = $conn->prepare("SELECT fullName FROM users WHERE userID = :userID");
                            $stmt5->execute(['userID' => $user]);
                            $row5 = $stmt5->fetch();
                            echo $row5['fullName'];
                            
                            ?></a>
                            </td>
                            <td><?=$row['count']?></td>
                            <td><?=$row['date']?></td>
                            <td>$<?=$row['price']?></td>
                            <td <?=$row['trustSeller'] == 0 ? 'class="text-danger"' : 'class="text-success"'?>
                                style="position:relative;">
                                <?= $row['trustSeller'] == 0 ? '<i class="bi bi-person-exclamation w-100"></i>' : '<i class="bi bi-person-fill-check w-100"></i>' ?>
                                <a data-bs-toggle="tooltip" data-bs-title="Edit Item" data-bs-placement="top"
                                    class="btn btn-primary btn-sm"
                                    style="position:absolute; right: 15px;background:#1b2534; color:#0d6efd"
                                    href="addItems.php?do=update&id=<?=$row['id']?>">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>

                        </tr>
                        <?php 
                                } }else{
                                    echo '<tr><div class="alert alert-danger">There Is No Items</div></tr>';
                                    }
                                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php 
    
} else {
    $stmt = $conn->prepare("SELECT * FROM item ORDER BY date DESC");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $count = $stmt->rowCount();
    if ($count > 0) {
        ?>
<div class="container-fluid mt-5">
    <h1 class="h3 mb-2 text-gray-800 mb-5">Tables</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name OF Item</th>
                            <th>Colors</th>
                            <th>Seller</th>
                            <th>Count</th>
                            <th>Start date</th>
                            <th>Price</th>
                            <th>Trusted</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                foreach ($rows as $row) {
                                    ?>
                        <tr>
                            <td><a href="addItems.php?do=info&id=<?= $row['id'] ?>"
                                    style="text-decoration:none;color:#adb5bd"><?=$row['name']?></a></td>
                            <td><?=$row['color']?></td>
                            <td><a href="member.php?do=info&id=<?= $row['userID'] ?>"
                                    style="text-decoration:none;color:#adb5bd">
                                    <?php
                            $user = $row['userID'];
                            $stmt5 = $conn->prepare("SELECT fullName FROM users WHERE userID = :userID");
                            $stmt5->execute(['userID' => $user]);
                            $row5 = $stmt5->fetch();
                            echo $row5['fullName'];
                            
                            ?></a>
                            </td>
                            <td><?=$row['count']?></td>
                            <td><?=$row['date']?></td>
                            <td>$<?=$row['price']?></td>
                            <td <?=$row['trustSeller'] == 0 ? 'class="text-danger"' : 'class="text-success"'?>
                                style="position:relative;">
                                <?= $row['trustSeller'] == 0 ? '<i class="bi bi-person-exclamation w-100"></i>' : '<i class="bi bi-person-fill-check w-100"></i>' ?>
                                <a data-bs-toggle="tooltip" data-bs-title="Edit Item" data-bs-placement="top"
                                    class="btn btn-primary btn-sm"
                                    style="position:absolute; right: 15px;background:#1b2534; color:#0d6efd"
                                    href="addItems.php?do=update&id=<?=$row['id']?>">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                        </tr>
                        <?php 
                                } 
                                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php 
    }
}
include $page1 . 'footer.php';
?>