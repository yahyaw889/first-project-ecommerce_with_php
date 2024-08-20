<?php
ob_start();
session_start();


if (isset($_SESSION['admin'])) {
  $pageTitle = 'Member Page';
  include 'init.php';
  include 'connect.php';
  include $page1 . 'header.php';
  include $page1 . 'nav.php';
  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

  if ($do == 'Manage') {
    header('Location: dashboard.php');
    exit();
  } elseif ($do == 'add') {



    ?>


<form class="mx-0 row gx-3 gy-4 mt-3" method="POST" action="../changes/addItem.php" enctype="multipart/form-data">
    <div class="col-md-6">
        <label for="inputfirstName4" class="form-label">Name:</label>
        <input placeholder="Name Package..." type="text" required class="form-control" name="name"
            id="inputfirstName4" />
    </div>
    <div class=" col-md-6">
        <label for="inputlastName4" class="form-label">Colors:</label>
        <input placeholder="colors..." type="text" class="form-control" required name="colors" id="inputlastName4" />
    </div>
    <div class="col-md-6">
        <label for="inputlastName4" class="form-label">Price:</label>
        <input placeholder="Your Price..." style="height: 50px; margin-bottom: 0px" type="number" required
            class="form-control" name="price" id="inputlastName4" />
    </div>

    <div class="col-md-6">
        <label for="inputemail4" class="form-label ">Description:</label>
        <input placeholder="Your Description ..." style="height: 150px" type="text" required name="Description"
            class="form-control" id="inputemail4" />
    </div>
    <div class="col-md-6">
        <label for="inputtele4" style=" position: absolute;
    margin-top: -104px;" class="form-label">Count:</label>
        <input placeholder="34..." type="text" style="margin-top: -61px;" required name="count" class="form-control"
            id="inputtele4" />
    </div>
    <input required type="hidden" value="<?= $_SESSION['id'] ?>" name="userID" class="form-control" id="inputage4" />

    <div>
        <div class="col-md-6">
            <label for="inputage4" class="form-label">Imgs:</label>
            <input placeholder="image..." required type="file" multiple="multiple" name="img[]" class="form-control"
                id="inputage4" />
        </div>
    </div>

    <div>
        <div class="col-md-6">
            <label for="inputCountry" class="form-label">Category:</label>
            <select id="inputCountry" class="form-select" name="catagories">

                <?php 
                $cate = $conn->prepare("SELECT * FROM catagories");
                $cate->execute();
                $cats = $cate->fetchAll();
                foreach ($cats as $cat) {
                    echo "<option value='" . $cat['id'] . "'>" . $cat['name'] . "</option>";
                }
                
                ?>
            </select>
        </div>
    </div>


    <div class="col-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
<?php

  }  elseif ($do == 'update' || $do == 'edit') {
    if (isset($_GET['id']) && is_numeric($_GET['id']) ) {
        if(isset($_SESSION['Manger'])){
           header('Location:showItems.php'); 
           exit();
        }
      $id = intval($_GET['id']);
      $stmt = $conn->prepare("SELECT * FROM item WHERE id = ?");
      $stmt->execute(array($id));
      $row = $stmt->fetch();
      $count = $stmt->rowCount();
      if ($count > 0) {
        ?>

<section class="w-100">
    <nav class="px-2 mt-4 d-flex flex-wrap justify-content-between" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        </ol>
        <p class="me-md-5"> <span class="fw-medium fs-6">Id :</span> <?= $id ?></p>
    </nav>
    <!-- //* form ************************************************************// -->
    <form class="mx-0 row gx-3 gy-4 mt-3" method="POST" action="../changes/editItem.php" enctype="multipart/form-data">
        <div class="col-md-6">
            <label for="inputfirstName4" class="form-label">Name:</label>
            <input placeholder="Name Package..." type="text" value="<?= $row['name']?>" required class="form-control"
                name="name" id="inputfirstName4" />
        </div>
        <div class=" col-md-6">
            <label for="inputlastName4" class="form-label">Colors:</label>
            <input placeholder="colors..." type="text" value="<?= $row['color']?>" class="form-control" required
                name="colors" id="inputlastName4" />
        </div>
        <div class=" col-md-6">
            <label for="inputlastName4" class="form-label">Sizes:</label>
            <input placeholder="Sizes..." type="text" value="<?= $row['size']?>" class="form-control" required
                name="size" id="inputlastName4" />
        </div>
        <div class="col-md-6">
            <label for="inputlastName4" class="form-label">Price:</label>
            <input placeholder="Your Price..." style="height: 50px; margin-bottom: 0px" type="number" required
                class="form-control" name="price" value="<?= $row['price']?>" id="inputlastName4" />
        </div>

        <div class="col-md-6">
            <label for="inputemail4" class="form-label ">Description:</label>
            <input placeholder="Your Description ..." style="height: 150px" type="text" required name="Description"
                class="form-control" value="<?= $row['description']?>" id="inputemail4" />
        </div>
        <div class="col-md-6">
            <label for="inputtele4" class="form-label">Count:</label>
            <input placeholder="34..." value="<?= $row['count']?>" type="text" style="" required name="count"
                class="form-control" id="inputtele4" />
        </div>
        <input required type="hidden" value="<?= $_SESSION['id'] ?>" name="userID" class="form-control"
            id="inputage4" />
        <input required type="hidden" value="<?= $row['id'] ?>" name="id" class="form-control" id="inputage4" />

        <div>
            <div class="col-md-6">
                <label for="inputage4" class="form-label">Imgs:</label>
                <input placeholder="Add New..." type="file" name="img[]" multiple="multiple" class="form-control"
                    id="inputage4" />
            </div>
        </div>
        <div>
            <div class="col-md-6">
                <label for="inputGender" class="form-label">Seller Trust:</label>
                <select id="inputGender" class="form-select" name="trustSeller">
                    <option <?= $row['trustSeller'] == 1 ? 'selected' : ''?> value="1">Trusted Seller</option>
                    <option <?= $row['trustSeller'] == 0 ? 'selected' : ''?> value="0">Not Trust Seller</option>
                </select>
            </div>
        </div>
        <div>
            <div class="col-md-6">
                <label for="inputCountry" class="form-label">Category:</label>
                <select id="inputCountry" class="form-select" value="<?= $row['categoryID']?>" name="catagories">

                    <?php 
                $cate = $conn->prepare("SELECT * FROM catagories");
                $cate->execute();
                $cats = $cate->fetchAll();
                foreach ($cats as $cat) { ?>

                    <option <?= $cat['id'] == $row['categoryID'] ? 'selected' : '' ?> value="<?= $cat['id'] ?>">
                        <?= $cat['name'] ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <?php
         $imgs = $conn->prepare("SELECT * FROM imgs WHERE itemID = $id");
        $imgs->execute();
        $imgs2 = $imgs->fetchAll();
        foreach ($imgs2 as $img) {
            if (!empty($img['name'])) {
        
        ?>
        <img src="../../layout/image/<?= $img['name'] ?>" style="width: 100px;height: 100px">
        <a href="deleteItem.php?id=<?= $img['id']; ?>" style="margin-top: -5px;margin-left: 35px;"><i
                class="bi bi-x-circle-fill"></i></a>
        <?php } }?>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</section>




<?php
} else {
        redirectHome('Error: You can not browse this page directly.', 'back' , 2);
    }
    }
} elseif ($do == 'info') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM item WHERE id = ?");
    $stmt->execute(array($id));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) {
        ?>

<section class=" w-100">
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid justify-content-center justify-content-md-between">
            <a class="navbar-brand fw-medium fs-3 mb-1 mb-md-0">Shop</a>
            <div>
    </nav>

    <nav style="width: 88%" class="px-2 mt-4 d-flex flex-wrap justify-content-between" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php  $username = $row['userID'];

                $ss = $conn->prepare("SELECT * FROM users WHERE userID = $username ");
                $ss->execute();
                $gen = $ss->fetch();
                echo $gen['username'];
                ?>
            </li>
        </ol>

        <p class=" ">
            <span class="fw-medium fs-6">Id Item:</span> <?= $row['id'] ?>
        </p>
    </nav>

    <table style="width: 88%" class="ms-1 table mt-5 table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col"> Name</th>
                <th class="fw-normal" scope="col"><?= $row['name'] ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Colors</th>
                <td><?= $row['color'] ?></td>
            </tr>

            <tr>
                <th scope="row">Price</th>
                <td><?= $row['price'] ?></td>
            </tr>

            <tr>
                <th scope="row">TrustSeller</th>
                <td <?= $row['trustSeller'] != 0 ? "class=text-success": "class=text-warning"   ?>>
                    <?= $row['trustSeller'] != 0 ? 'Trusted': 'Not Trusted'   ?></td>
            </tr>

            <tr>
                <th scope="row">count</th>
                <td>
                    <?= $row['count']?>
                </td>
            </tr>
            <tr>
                <th scope="row"> Seller Name</th>
                <td><a href="member.php?do=info&id=<?= $row['userID'] ?>" style="text-decoration:none;color:#adb5bd">
                        <?php $username = $row['userID'];

                    $ss = $conn->prepare("SELECT * FROM users WHERE userID = $username ");
                    $ss->execute();
                    $gen = $ss->fetch();
                    echo $gen['username'];
                        ?>
                    </a>
                </td>
            </tr>

            <tr>
                <th scope="row">categoryID </th>
                <td><?php $categoryID = $row['categoryID'];

                          $ss = $conn->prepare("SELECT * FROM catagories WHERE id = $categoryID ");
                            $ss->execute();
                            $gen = $ss->fetch();
                            echo $gen['name'];
                            ?></td>
            </tr>


            <tr>
                <th scope="row">Created on</th>
                <td><?= $row['date'] ?></td>
            </tr>
            <tr>
                <th scope="row">description</th>
                <td>
                    <?= $row['description']?>
                </td>
            </tr>
            <tr>
                <th scope="row">Images </th>
                <td><?php 

                          $ss = $conn->prepare("SELECT itemID,name FROM imgs WHERE itemID = $id ");
                            $ss->execute();
                            $gens = $ss->fetchAll();
                         foreach($gens as $gen){
                            if(!empty($gen['name'])){ ?>
                    <img src="../../layout/image/<?= $gen['name']?>" class="w-25">
                    <?php  }}?>
                </td>
            </tr>
        </tbody>
    </table>
</section>
<?php

      } else {
        redirectHome('Error: You can not browse this page directly.', 'back' , 2);
      }
    }
  }

  include $page1 . 'footer.php';
} else {
  header('Location:dashboard.php');
  exit();
}

ob_end_flush();