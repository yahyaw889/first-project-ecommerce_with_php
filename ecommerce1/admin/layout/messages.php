<!-- # http://localhost/ecommerce1/admin/layout/index.php -->

<?php
session_start();
include 'connect.php';
$pageTitle = 'messages Page';
if(!isset($_SESSION['admin'])){

    header('Location: index.php');
}

include 'init.php';
include $page1 . 'header.php';
include $page1 . 'nav.php';




$search = isset($_GET['search']) ? $_GET['search'] : '';
if($search == ''){

    $allUsers = $conn->prepare("SELECT * FROM users WHERE statusReg != 0 ");
    
    $allUsers->execute();
    $rows = $allUsers->fetchAll();
?>


<section class="w-100">
    <nav class="navbar bg-dark my-3">
        <div class="container-fluid justify-content-center justify-content-md-between">
            <a class="navbar-brand fw-medium fs-3 mb-1 mb-md-0"> <?= lang("control_system") ?></a>

            <form class="d-flex" role="search" method="get" action="">
                <input name="search" class="form-control me-2" type="search" placeholder="<?= lang("search") ?>"
                    aria-label="Search"
                    value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />
                <button class="btn btn-outline-success" type="submit">
                    <?= lang("search") ?>
                </button>
            </form>
        </div>
    </nav>

    <table style="width: 99%" class="text-center mx-auto table mt-5 table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"><?= lang('FullName') ?></th>
                <th scope="col"><?= lang('gender') ?></th>
                <th scope="col"><?= lang('country') ?></th>
                <th scope="col"><?= lang('age') ?></th>
                <th scope="col"><?= lang('lastUpdated') ?></th>
                <th scope="col"><?= lang('actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <tr class="tableBody">
                <?php  
                $rowsCount = 1;
                foreach ($rows as $row ) {
    ?>
                <th scope="row"
                    class="<?= $row['groupID'] == 2 ? 'bg-success' : ($row['groupID'] == 1 ? 'bg-danger' : '') ?>">
                    <?=  $rowsCount ?> </th>
                <td class="name-col"><?=  $row['username'] ?> </td>
                <td><?php $gen =  $row['Gender']; if($gen == 1){echo "Male";}else{echo "Female";} ?> </td>
                <td><?php $newCountry =  $row['country'];

              $stmt = $conn->prepare("SELECT * FROM country WHERE countryID = $newCountry ");
              $stmt->execute();
              $country = $stmt->fetch();
              echo $country['name'];
              ?> </td>
                <td><?=  $row['age'] ?> </td>
                <td><?=  $row['date'] ?> </td>
                <td>
                    <?php if(!isset($_SESSION['Manger'])){ ?>
                    <a data-bs-toggle="tooltip" data-bs-title="View details" data-bs-placement="top"
                        class="btn btn-primary btn-sm mx-2" href="member.php?do=info&id=<?=$row['userID'] ?>"><i
                            class="bi bi-eye"></i></a>
                    <?php } ?>
                    <a data-bs-toggle="tooltip" data-bs-title="Send message" data-bs-placement="top"
                        class="btn btn-primary btn-sm" href="member.php?do=info&id=<?=$row['userID'] ?>"><i
                            class="bi bi-chat-dots-fill"></i></a>

                </td>
            </tr>
            <?php 
        $rowsCount++;} ?>
        </tbody>
    </table>
</section>



<?php

    } else {
        $allUsers = $conn->prepare("SELECT * FROM users WHERE username LIKE '%$search%' WHERE statusReg != 0");
        $allUsers->execute();
        $rows = $allUsers->fetchAll();
?>
<section class="w-100">
    <nav class="navbar bg-dark my-3">
        <div class="container-fluid justify-content-center justify-content-md-between">
            <a class="navbar-brand fw-medium fs-3 mb-1 mb-md-0"> <?= lang("control_system") ?></a>

            <form class="d-flex" role="search" method="get" action="">
                <input name="search" class="form-control me-2" type="search" placeholder="<?= lang("search") ?>"
                    aria-label="Search"
                    value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />
                <button class="btn btn-outline-success" type="submit">
                    <?= lang("search") ?>
                </button>
                <a href="messages.php?search=<?= '' ?>"> <button class="btn mx-2 btn-danger" type="button">
                        STOP
                    </button></a>
            </form>
        </div>
    </nav>

    <table style="width: 99%" class="text-center mx-auto table mt-5 table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"><?= lang('FullName') ?></th>
                <th scope="col"><?= lang('gender') ?></th>
                <th scope="col"><?= lang('country') ?></th>
                <th scope="col"><?= lang('age') ?></th>
                <th scope="col"><?= lang('lastUpdated') ?></th>
                <th scope="col"><?= lang('actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <tr class="tableBody">
                <?php  
                $rowsCount = 1;
                foreach ($rows as $row ) {
    ?>
                <th scope="row"
                    class="<?= $row['groupID'] == 2 ? 'bg-success' : ($row['groupID'] == 1 ? 'bg-danger' : '') ?>">
                    <?=  $rowsCount ?> </th>
                <td class="name-col"><?=  $row['username'] ?> </td>
                <td><?php $gen =  $row['Gender']; if($gen == 1){echo "Male";}else{echo "Female";} ?> </td>
                <td><?php $newCountry =  $row['country'];

              $stmt = $conn->prepare("SELECT * FROM country WHERE countryID = $newCountry ");
              $stmt->execute();
              $country = $stmt->fetch();
              echo $country['name'];
              ?> </td>
                <td><?=  $row['age'] ?> </td>
                <td><?=  $row['date'] ?> </td>
                <td>
                    <?php if(!isset($_SESSION['Manger'])){ ?>
                    <a data-bs-toggle="tooltip" data-bs-title="View details" data-bs-placement="top"
                        class="btn btn-primary btn-sm mx-2" href="member.php?do=info&id=<?=$row['userID'] ?>"><i
                            class="bi bi-eye"></i></a>
                    <?php } ?>
                    <a data-bs-toggle="tooltip" data-bs-title="View details" data-bs-placement="top"
                        class="btn btn-primary btn-sm" href="member.php?do=info&id=<?=$row['userID'] ?>"><i
                            class="bi bi-chat-dots-fill"></i></a>

                </td>
            </tr>
            <?php 
        $rowsCount++;} ?>
        </tbody>
    </table>
</section>

<?php 
}
include $page1 . 'footer.php' ; 
?>