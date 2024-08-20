<?php
session_start();

$pageTitle = 'Notification Page';
if(!isset($_SESSION['admin'])){

    header('Location: index.php');
}

include 'init.php';
include $page1 . 'header.php';
include $page1 . 'nav.php';

?>
<section>
    <div class="container my-5 " style="width: 1000px;display:flex;justify-content: center">
        <div style="margin: 10px 50px;width: 100%; display:grid;text-align: center">
            <div class="alert alert-warning col-12" role=" alert" style="overflow:hidden;">
                A simple warning alert—check it out!
            </div>
        </div>
    </div>
</section>
<?php
include $page1 . 'footer.php';
?>