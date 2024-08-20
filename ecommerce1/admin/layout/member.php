<?php
ob_start();
session_start();
include 'connect.php';

if (isset($_SESSION['admin'])) {
  $pageTitle = 'Member Page';
  include 'init.php';
  include $page1 . 'header.php';
  include $page1 . 'nav.php';
  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

  if ($do == 'Manage') {
    header('Location: dashboard.php');
    exit();
  } elseif ($do == 'add') {



    ?>


<form class="mx-0 row gx-3 gy-4 mt-3" method="POST" action="../changes/add.php">
    <div class="col-md-6">
        <label for="inputfirstName4" class="form-label">Username:</label>
        <input placeholder="Username..." type="text" required class="form-control" name="username"
            id="inputfirstName4" />
    </div>
    <div class="col-md-6">
        <label for="inputlastName4" class="form-label">Full Name:</label>
        <input placeholder="Full Name..." type="text" class="form-control" required name="fullName"
            id="inputlastName4" />
    </div>
    <div class="col-md-6">
        <label for="inputlastName4" class="form-label">Password:</label>
        <input placeholder="Your Password..." type="password" required class="form-control" name="password"
            id="inputlastName4" />
    </div>

    <div class="col-md-6">
        <label for="inputemail4" class="form-label">Email:</label>
        <input placeholder="Your Email ..." type="email" required name="Email" class="form-control" id="inputemail4" />
    </div>
    <div class="col-md-6">
        <label for="inputtele4" class="form-label">Telephone:</label>
        <input placeholder="01111111111" type="number" required name="phone" class="form-control" id="inputtele4" />
    </div>

    <div>
        <div class="col-md-6">
            <label for="inputage4" class="form-label">Age:</label>
            <input placeholder="Your Age: ..." required type="number" name="age" class="form-control" id="inputage4" />
        </div>
    </div>

    <div>
        <div class="col-md-6">
            <label for="inputCountry" class="form-label">Country:</label>
            <select id="inputCountry" class="form-select" name="country">

                <option value="Morocco">Morocco</option>
                <option selected value="Egypt">Egypt</option>
            </select>
        </div>
    </div>
    <div>
        <div class="col-md-6">
            <label for="inputCountry" class="form-label">Permashines:</label>
            <select id="inputCountry" class="form-select" name="groupID">
                <option selected value="0">User</option>
                <?php if (!isset($_SESSION['Manger'])) {?>
                <option value="1">Admin</option>
                <option value="2">Manger</option>
                <?php }?>
            </select>
        </div>
    </div>

    <div>
        <div class="col-md-6">
            <label for="inputGender" class="form-label">Gender:</label>
            <select id="inputGender" class="form-select" name="Gender">
                <option selected value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
<?php

  }  elseif ($do == 'update' || $do == 'edit') {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
      $id = intval($_GET['id']);
      $stmt = $conn->prepare("SELECT * FROM users WHERE userID = ?");
      $stmt->execute(array($id));
      $row = $stmt->fetch();
      $count = $stmt->rowCount();
      if ($count > 0) {
        ?>

<section class="w-100">
    <nav class="px-2 mt-4 d-flex flex-wrap justify-content-between" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $row['username'] ?></li>
        </ol>
        <p class="me-md-5"> <span class="fw-medium fs-6">Id :</span> <?= $row['userID'] ?></p>
    </nav>
    <!-- //* form ************************************************************// -->
    <form class="mx-0 row gx-3 gy-4 mt-2" method="POST" action="../changes/edit.php">
        <input type="hidden" name="userID" value="<?= $row['userID'] ?>">
        <input type="hidden" name="oldpass" value="<?= $row['password'] ?>">
        <div class="col-md-6">
            <label for="inputfirstName4" class="form-label">Full Name:</label>
            <input placeholder="Full Name" name="fullName" required value="<?= $row['fullName'] ?>" type="text"
                class="form-control" id="inputfirstName4" />
        </div>
        <div class="col-md-6">
            <label for="inputfirstName4" class="form-label">Username:</label>
            <input placeholder="Username" name="username" required value="<?= $row['username'] ?>" type="text"
                class="form-control" />
        </div>
        <div class="col-md-6">
            <label for="inputemail4" class="form-label">Password:</label>
            <input placeholder="New password" name="newpass" value="" type="password" class="form-control"
                id="inputemail4" />
        </div>
        <div class="col-md-6">
            <label for="inputemail4" class="form-label">Email:</label>
            <input placeholder="Email" required name="Email" value="<?= $row['Email'] ?>" type="email"
                class="form-control" id="inputemail4" />
        </div>
        <div class="col-md-6">
            <label for="inputtele4" class="form-label">Telephone:</label>
            <input placeholder="01111111111" required name="phone" type="number" value="0<?= $row['phone'] ?>"
                class="form-control" id="inputtele4" />
        </div>

        <div>

            <?php if(!isset($_SESSION['Manger'])){ ?>
            <div class="col-md-6">
                <label for="inputCountry" class="form-label">Permashines:</label>
                <select id="inputCountry" class="form-select" name="groupID">

                    <option value="1" <?php if ($row['groupID'] == 1) {
                                                echo "selected";
                                                    } ?>>Admin</option>
                    <option value="0" <?php if ($row['groupID']==0) { echo "selected" ; } ?>>User
                    </option>
                    <option value="2" <?php if ($row['groupID']==2) { echo "selected" ; } ?>>Manger
                    </option>
                </select>
            </div>
        </div>
        <?php } ?>
        <div>
            <div class="col-md-6">
                <label for="inputage4" class="form-label">Age:</label>
                <input placeholder="Your Age: ..." value="<?= $row['age'] ?>" name="age" type="number"
                    class="form-control" required id="inputage4" />
            </div>
        </div>
        <div class="col-md-6">
            <label for="inputCountry" class="form-label">Country:</label>
            <select id="inputCountry" name="country" class="form-select">
                <option value="Morocco" <?php if ($row['country'] == '2') {
                                                    echo "selected";
                                                    } ?>>Morocco</option>
                <option value="Egypt" <?php if ($row['country'] == '1') {
                                                    echo "selected";
                                                    } ?>>Egypt</option>
            </select>
        </div>


        <div class="col-md-6">
            <label for="inputGender" class="form-label">Gender:</label>
            <select id="inputGender" name="Gender" class="form-select">
                <option value="Male" <?php if ($row['Gender'] == '1') {
                            echo "selected";
                    } ?>>Male</option>
                <option value="Female" <?php if ($row['Gender'] == '2') {
                            echo "selected";
                    } ?>>Female</option>
            </select>
        </div>

        <div class="col-12 my-3">
            <button type="submit" class="btn btn-primary mx-3">Edit changes </button>
            <a class="confirm" href="../changes/delete.php?id=<?= $row['userID'] ?>"> <button data-bs-toggle="modal"
                    data-bs-target="#exampleModal" type="button" class="btn btn-danger">Delete
                    Customer </button></a>
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
    $stmt = $conn->prepare("SELECT * FROM users WHERE userID = ?");
    $stmt->execute(array($id));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) {
        ?>

<section class=" w-100">
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid justify-content-center justify-content-md-between">
            <a class="navbar-brand fw-medium fs-3 mb-1 mb-md-0">Shop</a>

            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit">
                    Search
                </button>
            </form>
        </div>
    </nav>

    <nav style="width: 88%" class="px-2 mt-4 d-flex flex-wrap justify-content-between" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= $row['username'] ?>
            </li>
        </ol>

        <p class=" ">
            <span class="fw-medium fs-6">Id :</span> <?= $row['userID'] ?>
        </p>
    </nav>

    <table style="width: 88%" class="ms-1 table mt-5 table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">User Name</th>
                <th class="fw-normal" scope="col"><?= $row['username'] ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Full Name</th>
                <td><?= $row['fullName'] ?></td>
            </tr>

            <tr>
                <th scope="row">Telephone</th>
                <td>0<?= $row['phone'] ?></td>
            </tr>

            <tr>
                <th scope="row">Email</th>
                <td><?= $row['Email'] ?></td>
            </tr>

            <tr>
                <th scope="row">Permashines</th>
                <td>
                    <?= $row['groupID'] == 1 ? "Admin" : ($row['groupID'] == 2 ? "Manager" : "User"); ?>
                </td>
            </tr>
            <tr>
                <th scope="row">Condition</th>
                <td>
                    <?= $row['statusReg']== 0 ?  "Inactived" :  "Actived"; ?>

                </td>
            </tr>

            <tr>
                <th scope="row">Gender</th>
                <td><?php $gender = $row['Gender'];

                          $ss = $conn->prepare("SELECT * FROM Gender WHERE id = $gender ");
                          $ss->execute();
                          $gen = $ss->fetch();
                          echo $gen['GenderType'];
                          ?></td>
            </tr>

            <tr>
                <th scope="row">Age</th>
                <td><?= $row['age'] ?></td>
            </tr>

            <tr>
                <th scope="row">Country</th>
                <td><?php $newCountry = $row['country'];
                          $stmt = $conn->prepare("SELECT * FROM country WHERE countryID = $newCountry ");
                          $stmt->execute();
                          $country = $stmt->fetch();
                          echo $country['name'];
                          ?></td>
            </tr>

            <tr>
                <th scope="row">Created on</th>
                <td><?= $row['date'] ?></td>
            </tr>
            <tr>
                <th scope="row">Address</th>
                <td><?= $row['address'] ?></td>
            </tr>
        </tbody>
    </table>
    <?php if($row['statusReg']== 0){ ?> <a class="confirm" href="../changes/active.php?id=<?=$row['userID'] ?>"><button
            data-bs-toggle="tooltip" data-bs-title="Active user" data-bs-placement="top" class="btn btn-info btn-lg ">
            <i class="bi bi-check-circle-fill"></i>
        </button>
    </a>
    <?php } ?>
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