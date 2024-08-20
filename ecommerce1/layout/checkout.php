<?php
session_start();
include "init.php";
include $includes ."header.php";

$catigory = new catigory;

$cat            = $catigory->getCatigorys();
$topSallery     = $catigory->topSell();
$newProducts    = $catigory->newProducts();
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $quantity = $_POST['quantity'];
    $id_item  = $_POST['id']; 
    $_SESSION['cart'][$id_item]['quantity'] = $quantity;
}
?>
<main id="main-site">

    <!-- Shopping cart section  -->
    <section id="cart" class="py-3">
        <div class="container-fluid w-75">
            <h5 class="font-baloo font-size-20">Shopping Cart</h5>

            <!--  shopping cart items   -->
            <div class="row">
                <div class="col-sm-9">
                    <?php
                  echo  isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
                        if(isset($_SESSION['cart'])){
                            $_SESSION['msg']  = '';
                            unset($_SESSION['msg'] );
                            $cc = 1;
                            $_SESSION['total'] = 0;
                    foreach($_SESSION['cart'] as $oneCart){
                        $id = $oneCart['id'];
                        $getItem= $catigory->getItem($id);
                        while($row1 = mysqli_fetch_assoc($getItem)){
                            $imgs = $catigory->itemImg($id);
                            while($oneImg = mysqli_fetch_assoc($imgs)){
                            $one_img = $oneImg['name'];}
                        ?>
                    <!-- cart item -->
                    <div class="row border-top py-3 mt-3">
                        <div class="col-sm-2">
                            <img src="image/<?= $one_img?>" style="height: 120px;" alt="cart1" class="img-fluid">
                        </div>
                        <div class="col-sm-8">
                            <h5 class="font-baloo font-size-20"><?= $row1['name']?></h5>
                            <small>by Samsung</small>
                            <!-- product rating -->
                            <div class="d-flex">
                                <div class="rating text-warning font-size-12">
                                    <?php 
                                for ($i=0; $i < 5 ; $i++ ) { 
                                    
                                ?>
                                    <span><i
                                            class="<?= $row1['rating'] > $i ? 'fas fa-star' : 'far fa-star' ?>"></i></span>
                                    <?php } ?>
                                </div>
                                <a href="#" class="px-2 font-rale font-size-14"><?= $row1['ratingNum']?> ratings</a>
                            </div>
                            <!--  !product rating-->

                            <!-- product qty -->
                            <form action="checkout.php" method="POST">
                                <input type="hidden" value="<?= $id ?>" name="id">
                                <div class="qty d-flex pt-2">
                                    <div class="d-flex font-rale w-25">
                                        <button type="button" class="qty-up border bg-light" data-id="pro1"
                                            aria-label="Increase quantity">
                                            <i class="fas fa-angle-up"></i>
                                        </button>
                                        <input type="number" data-id="pro1" class="qty_input border px-2 w-100 bg-light"
                                            name="quantity" value="<?= $oneCart['quantity'] ?>" placeholder="1" min="1">
                                        <button type="button" class="qty-down border bg-light" data-id="pro1"
                                            aria-label="Decrease quantity">
                                            <i class="fas fa-angle-down"></i>
                                        </button>
                                    </div>
                                    <a class="confirm" href="../includes/libs/deleteCart.php?id=<?= $id?>"><button
                                            type="button" class="btn font-baloo text-danger px-3 border-right">
                                            Delete
                                        </button></a>
                                    <button type="submit" name="action" value="save_for_later"
                                        class="btn font-baloo text-danger">
                                        Save for Later
                                    </button>
                                </div>
                                <?php
                              $cc == 1 ?  $_SESSION['total'] =   $oneCart['quantity'] * $row1['price'] : $_SESSION['total'] +=   $oneCart['quantity'] * $row1['price'];
                                ?>
                            </form>
                            <!-- !product qty -->

                        </div>

                        <div class="col-sm-2 text-right">
                            <div class="font-size-20 text-danger font-baloo">
                                $<span class="product_price"><?= $row1['price'] * $oneCart['quantity'] ?></span>
                            </div>
                        </div>
                    </div>
                    <!-- !cart item -->
                    <?php 
                $cc++;
                }}}?>
                    <!-- cart item -->
                </div>
                <!-- subtotal section-->
                <div class="col-sm-3">
                    <div class="sub-total border text-center mt-2">
                        <h6 class="font-size-12 font-rale text-success py-3"><i class="fas fa-check"></i> Your order is
                            eligible for FREE Delivery.</h6>
                        <div class="border-top py-4">
                            <?php 
                            $allItems = 0;
                            if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
                            if(!isset($_SESSION['total'])) $_SESSION['total'] = 0;
                            foreach($_SESSION['cart'] as $countOne){
                            $allItems += $countOne['quantity'];
                            
                            }
                            ?>
                            <h5 class="font-baloo font-size-20">Subtotal (<?= $allItems?> item):&nbsp;
                                <span class="text-danger">$<span class="text-danger"
                                        id="deal-price"><?= $_SESSION['total']?>.00</span> </span>
                            </h5>
                            <a href="askOrder.php"> <button type="submit" class="btn btn-warning mt-3">Proceed to
                                    Buy</button></a>
                        </div>
                    </div>
                </div>
                <!-- !subtotal section-->
            </div>
            <!--  !shopping cart items   -->
        </div>
    </section>
    <!-- !Shopping cart section  -->

    <!-- New Phones -->
    <section id="new-phones">
        <div class="container py-5">
            <h4 class="font-rubik font-size-20">New Phones</h4>
            <hr>
            <div class="owl-carousel owl-theme">

                <!-- owl carousel -->
                <?php 
                    if($newProducts){
                        while($row3 = mysqli_fetch_assoc($newProducts)){
                            $firstImg = $catigory->itemImg($row3['id']); 
                            $img3 = mysqli_fetch_assoc($firstImg);
                            $imgSrc3 = $img3 ? 'image/' . $img3['name'] : 'image/default.jpg';
                            
                    ?>
                <div class="grid-item Apple normalBox border">
                    <div class="item py-2" style="width: 200px;">
                        <div class="product font-rale">
                            <a href="product.php?id=<?= $row3['id']?>"><img id="topSallery" src="<?= $imgSrc3 ?>"
                                    alt="product1" class="img-fluid"></a>
                            <div class="text-center">
                                <h6><?= $row3['name']?></h6>
                                <div class="rating text-warning font-size-12">
                                    <?php 
                                                for ($i=0; $i < 5 ; $i++ ) { 
                                                ?>
                                    <span><i
                                            class="<?= $row3['rating'] > $i ? 'fas fa-star' : 'far fa-star' ?>"></i></span>
                                    <?php } ?>
                                </div>
                                <div class="price py-2">
                                    <span>$<?= $row3['price']?></span>
                                </div>
                                <a href="add_to_cart.php?id=<?= $row3['id']?>"><button type="submit"
                                        class="btn btn-warning font-size-12">Add to Cart</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                        }
                    }
                    ?>
            </div>
        </div>
        <!-- !owl carousel -->

        </div>
    </section>
    <!-- !New Phones -->

</main>
<!-- !start #main-site -->

<!-- start #footer -->
<footer id="footer" class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12">
                <h4 class="font-rubik font-size-20">Mobile Shopee</h4>
                <p class="font-size-14 font-rale text-white-50">Lorem ipsum dolor sit amet consectetur, adipisicing
                    elit. Repellendus, deserunt.</p>
            </div>
            <div class="col-lg-4 col-12">
                <h4 class="font-rubik font-size-20">Newslatter</h4>
                <form class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Email *">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary mb-2">Subscribe</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-2 col-12">
                <h4 class="font-rubik font-size-20">Information</h4>
                <div class="d-flex flex-column flex-wrap">
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">About Us</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Delivery Information</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Privacy Policy</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Terms & Conditions</a>
                </div>
            </div>
            <div class="col-lg-2 col-12">
                <h4 class="font-rubik font-size-20">Account</h4>
                <div class="d-flex flex-column flex-wrap">
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">My Account</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Order History</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Wish List</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Newslatters</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyright text-center bg-dark text-white py-2">
    <p class="font-rale font-size-14">&copy; Copyrights 2020. Desing By <a href="#" class="color-second">Daily
            Tuition</a></p>
</div>



<script>
document.querySelectorAll('.qty-up').forEach(button => {
    button.addEventListener('click', function() {
        const input = this.parentNode.querySelector('.qty_input');
        input.value = parseInt(input.value) + 1;
    });
});

document.querySelectorAll('.qty-down').forEach(button => {
    button.addEventListener('click', function() {
        const input = this.parentNode.querySelector('.qty_input');
        if (parseInt(input.value) > 1) { // Ensure the quantity doesn't go below 1
            input.value = parseInt(input.value) - 1;
        }
    });
});

function deleteItem(id) {
    // Implement item deletion logic, possibly via AJAX or by submitting a form with a delete action
    console.log("Delete item with ID: " + id);
}
</script>
<?php
include $includes . "footer.php"; ?>
<script>
$('.confirm').click(function() {
    return confirm('Are you sure?');
})
</script>