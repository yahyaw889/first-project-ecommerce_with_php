<!-- # http://localhost/ecommerce1/admin/layout/index.php -->

<?php
session_start();
include 'connect.php';
$pageTitle = 'Home page';
if(!isset($_SESSION['admin'])){

    header('Location: index.php');
}

include 'init.php';
include $page1 . 'header.php';
include $page1 . 'nav.php';


// $test = $conn->prepare("SELECT COUNT(*) AS ALL FROM users WHERE statusReg != 0 AND groupID != 1 LIMIT 1 , 3");
// $test->execute();
// $COUNTS = $test->fetchAll();
// echo $COUNTS['ALL'];


//////
$search = isset($_GET['search']) ? $_GET['search'] : '';
if($search == ''){
    if(isset($_SESSION['Manger'])){
$allUsers = $conn->prepare("SELECT * FROM users WHERE statusReg != 0 AND groupID = 0  ");
    }else{

    $allUsers = $conn->prepare("SELECT * FROM users WHERE statusReg != 0 AND groupID != 1 LIMIT 2 , 5");
    }
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
                    <a data-bs-toggle="tooltip" data-bs-title="View details" data-bs-placement="top"
                        class="btn btn-primary btn-sm" href="member.php?do=info&id=<?=$row['userID'] ?>"><i
                            class="bi bi-eye"></i></a>


                    <a data-bs-toggle="tooltip" data-bs-title="Edit user" data-bs-placement="top"
                        class="btn btn-primary btn-sm" href="member.php?do=update&id=<?=$row['userID']?>">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <a class="confirm" href="../changes/delete.php?id=<?=$row['userID'] ?>"><button
                            data-bs-toggle="tooltip" data-bs-title="Delete user" data-bs-placement="top"
                            class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>
                    </a>
                </td>
            </tr>
            <?php 
        $rowsCount++;} ?>
        </tbody>
    </table>
</section>



<?php

    } else {
        $allUsers = $conn->prepare("SELECT * FROM users WHERE username LIKE '%$search%' AND statusReg != 0 AND groupID != 1");
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
                <a href="dashboard.php?search=<?= '' ?>"> <button class="btn mx-2 btn-danger" type="button">
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
                    <?=  $rowsCount  ?> </th>
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
                    <a data-bs-toggle="tooltip" data-bs-title="View details" data-bs-placement="top"
                        class="btn btn-primary btn-sm" href="member.php?do=info&id=<?=$row['userID'] ?>"><i
                            class="bi bi-eye"></i></a>


                    <a data-bs-toggle="tooltip" data-bs-title="Edit user" data-bs-placement="top"
                        class="btn btn-primary btn-sm" href="member.php?do=update&id=<?=$row['userID']?>">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <a class="confirm" href="../changes/delete.php?id=<?=$row['userID'] ?>"><button
                            data-bs-toggle="tooltip" data-bs-title="Delete user" data-bs-placement="top"
                            class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>
                    </a>
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