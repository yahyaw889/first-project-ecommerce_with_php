<!-- # http://localhost/ecommerce1/admin/layout/index.php -->

<?php
session_start();
$pageTitle = "Login Page";
include 'init.php';
include 'connect.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $username = $_POST['user'];
      $password = $_POST['pass'];
      $passhash = sha1($password);

  $login = $conn-> prepare("SELECT userID, username , password ,groupID FROM users WHERE username = ? AND password = ? AND (groupID = 1 or groupID = 2) AND statusReg = 1");
      $login-> execute(array($username , $passhash));
      $row = $login-> fetch();
      $count =  $login->rowCount();
      if($count > 0 ){

        $_SESSION['admin'] = $username;
        $_SESSION['id'] = $row['userID'];
        if($row['groupID'] == 2){
        $_SESSION['Manger'] = $row['groupID'];
        }

        header('Location: Catagories.php');
      }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/bootstrap-login-form.min.css" />
</head>

<body>
    <!-- Start your project here-->
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="card-body p-5 text-center">

                                <h3 class="mb-5">Sign in</h3>

                                <div class="form-outline mb-4">
                                    <input type="text" name="user" id="typeEmailX-2"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" for="typeEmailX-2">username</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" name="pass" id="typePasswordX-2"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" for="typePasswordX-2">Password</label>
                                </div>

                                <!-- Checkbox -->
                                <div class="form-check d-flex justify-content-start mb-4">
                                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                                    <label class="form-check-label" for="form1Example3"> Remember password </label>
                                </div>

                                <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>

                                <hr class="my-4">

                                <button class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;"
                                    type="submit"><i class="fab fa-google me-2"></i> Sign in with google</button>
                                <button class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;"
                                    type="submit"><i class="fab fa-facebook-f me-2"></i>Sign in with facebook</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End your project here-->

    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>

</html>