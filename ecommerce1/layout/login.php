<?php
session_start();
include 'init.php';

if( $_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passhash = sha1($password);

    $logging =   new logging();
    $logs = $logging->loginCheck($username , $passhash);
    if($logs){
    while($login = mysqli_fetch_assoc($logs)){

        $_SESSION['userName'] = $login['username'];
        $_SESSION['login'] = "success";
        $_SESSION['id'] = $login['userID'];
        header("location:checkout.php");
        exit();
    
}}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style/login.css">
    <title>Modern Login Page | AsmrProg</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registeration</span>
                <input type="text" placeholder="Name">
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Password">
                <button style="background-color:#a9a9a9;">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="POST" action="login.php">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <a href="#">Forget Your Password?</a>
                <button type="submit" style="background-color:#a9a9;">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle" style="background: linear-gradient(to right, #b1b12e, #efe531);">
                <div class="toggle-panel toggle-left" style="background-color:#ffff0b;">
                    <img src="image/logo.png" style="width:200px; margin-bottom:20px;" alt="">

                    <button class="hidden" style="background-color:#000000;" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right" style="background:#ffff0b;">
                    <img src="image/logo.png" style="width:200px; margin-bottom:20px;" alt="">
                    <button class="hidden" style="background-color:#000000;" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    const container = document.getElementById('container');
    const registerBtn = document.getElementById('register');
    const loginBtn = document.getElementById('login');

    registerBtn.addEventListener('click', () => {
        container.classList.add("active");
    });

    loginBtn.addEventListener('click', () => {
        container.classList.remove("active");
    });
    </script>
</body>

</html>