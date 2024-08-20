<?php
session_start();
include "init.php";
include $includes ."header.php";
$id = isset( $_GET['id']) ? $id = $_GET['id'] : 0 ;
if($id == 0 ){
header("location:index.php");
exit();
}
include_once "../classes/main.php";
$item = new catigory();
$getItem = $item->getItem($id);
$getImg = $item->itemImgs($id);
?>

<!-- start #main-site -->
<main id="main-site">

    <!--   product  -->
    <?php 
    if($getItem){
      while ($items = mysqli_fetch_assoc($getItem) ){
        $catID =  $items['categoryID']
      
      ?>
    <section id="product" class="py-3">
        <div class="mx-5">
            <div class="row" style="justify-content: space-around;
    display: flex;
    margin-left: -30px;">
                <!-- Carousel Section -->
                <div id="product-img" class="col-sm-4 carousel" style="margin-left:80px">
                    <div class="carousel-images" id="bigImg">
                        <div id="banner-area">
                            <div class="owl-carousel owl-theme big">
                                <?php
                            if ($getImg) {
                                while ($imgs = mysqli_fetch_assoc($getImg)) {
                                    ?>
                                <img id="bigImg" src="image/<?= $imgs['name'] ?>" alt="product" class="img-fluid">
                                <?php
                                }
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row pt-4 font-size-16 font-baloo my-2">
                        <div class="col">
                            <button type="submit" class="btn btn-danger form-control">Proceed to Buy</button>
                        </div>
                        <div class="col">
                            <a href="add_to_cart.php?id=<?= $id?>"><button type="submit"
                                    class="btn btn-warning form-control">Add to Cart</button></a>
                        </div>
                    </div>
                </div>

                <!-- Product Details Section -->
                <div class="col-sm-5 py-5">
                    <h5 class="font-baloo font-size-20"><?= $items['name'] ?></h5>
                    <?php
                $getCat = $item->getCatigory($items['categoryID']);
                while ($cat = mysqli_fetch_assoc($getCat)) { ?>
                    <small>by <?= $cat['name'] ?></small>
                    <?php } ?>
                    <div class="d-flex">
                        <div class="rating text-warning font-size-12">
                            <?php
                        for ($i = 0; $i < 5; $i++) {
                            ?>
                            <span><i class="<?= $items['rating'] > $i ? 'fas fa-star' : 'far fa-star' ?>"></i></span>
                            <?php
                        }
                        ?>
                        </div>
                        <a href="#" class="px-2 font-rale font-size-14"><?= $items['ratingNum'] ?> ratings | 1000+
                            answered questions</a>
                    </div>
                    <hr class="m-0">

                    <!-- Product Price -->
                    <table class="my-3">
                        <tr class="font-rale font-size-14">
                            <td>M.R.P:</td>
                            <td><strike>$<?= $items['price'] ?>.00</strike></td>
                        </tr>
                        <tr class="font-rale font-size-14">
                            <td>Deal Price:</td>
                            <td class="font-size-20 text-danger">$<span><?= $items['price'] * 0.9 ?>.00</span><small
                                    class="text-dark font-size-12">&nbsp;&nbsp;Inclusive of all taxes</small></td>
                        </tr>
                        <tr class="font-rale font-size-14">
                            <td>You Save:</td>
                            <td><span
                                    class="font-size-16 text-danger"><?= $items['price'] - ($items['price'] * 0.9) ?>.00</span>
                            </td>
                        </tr>
                    </table>
                    <!-- !Product Price -->

                    <!-- Policy -->
                    <div id="policy">
                        <div class="d-flex">
                            <div class="return text-center mr-5">
                                <div class="font-size-20 my-2 color-second">
                                    <span class="fas fa-retweet border p-3 rounded-pill"></span>
                                </div>
                                <a href="#" class="font-rale font-size-12">10 Days <br> Replacement</a>
                            </div>
                            <div class="return text-center mr-5">
                                <div class="font-size-20 my-2 color-second">
                                    <span class="fas fa-truck  border p-3 rounded-pill"></span>
                                </div>
                                <a href="#" class="font-rale font-size-12"><?php
                                $sellerName = $item->getSeller($items['userID']);
                                $name = mysqli_fetch_assoc($sellerName);
                                echo $name['username'];
                                ?> <br>Delivered</a>
                            </div>
                            <div class="return text-center mr-5">
                                <div class="font-size-20 my-2 color-second">
                                    <span class="fas fa-check-double border p-3 rounded-pill"></span>
                                </div>
                                <a href="#" class="font-rale font-size-12">1 Year <br>Warranty</a>
                            </div>
                        </div>
                    </div>
                    <!-- !Policy -->
                    <hr>

                    <!-- Order Details -->
                    <div id="order-details" class="font-rale d-flex flex-column text-dark">
                        <small>Delivery by : <?= $items['date'] ?></small>
                        <small>Sold by <a href="#"><?php
                        $sellerName = $item->getSeller($items['userID']);
                        $name = mysqli_fetch_assoc($sellerName);
                        echo $name['fullName'];
                        ?></a> (4.5 out of 5 | 18,198 ratings)</small>
                        <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver to Customer -
                            424201</small>
                    </div>
                    <!-- !Order Details -->

                    <div class="row">
                        <div class="col-6">
                            <!-- Color -->
                            <div class="color my-3">
                                <div class="d-flex justify-content-between">
                                    <h6 class="font-baloo">Color:</h6>
                                    <?php
                                $color = explode(",", $items['color']);
                                for ($j = 0; $j < count($color); $j++) {
                                    ?>
                                    <div class="p-2 rounded-circle"
                                        style="background-color: <?= $color[$j]; ?>;border:1px solid black">
                                        <button class="btn font-size-14"></button>
                                    </div>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                            <!-- !Color -->
                        </div>
                        <div class="col-6">
                            <!-- Product Qty Section -->
                            <div class="qty d-flex">
                                <h6 class="font-baloo">Qty</h6>
                                <div class="px-4 d-flex font-rale">
                                    <button class="qty-up border bg-light" data-id="pro1"><i
                                            class="fas fa-angle-up"></i></button>
                                    <input type="text" data-id="pro1" class="qty_input border px-2 w-50 bg-light"
                                        disabled value="1" placeholder="1">
                                    <button data-id="pro1" class="qty-down border bg-light"><i
                                            class="fas fa-angle-down"></i></button>
                                </div>
                            </div>
                            <!-- !Product Qty Section -->
                        </div>
                    </div>

                    <!-- Size -->
                    <div class="size my-3">
                        <h6 class="font-baloo">Size :</h6>
                        <div class="d-flex justify-content-between w-75">
                            <?php
                        $size = explode(",", $items['size']);
                        for ($k = 0; $k < count($size); $k++) {
                            ?>
                            <div class="font-rubik border p-2">
                                <button class="btn p-0 font-size-14"><?= $size[$k] ?></button>
                            </div>
                            <?php
                        }
                        ?>
                        </div>
                    </div>
                    <!-- !Size -->
                </div>

                <!-- Product Description -->
                <div class="col-12">
                    <h6 class="font-rubik">Product Description</h6>
                    <hr>
                    <p class="font-rale font-size-14"><?= $items['description'] ?></p>
                    <p class="font-rale font-size-14">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat
                        inventore vero numquam error est ipsa, consequuntur temporibus debitis nobis sit, delectus
                        officia ducimus dolorum sed corrupti. Sapiente optio sunt provident, accusantium eligendi eius
                        reiciendis animi? Laboriosam, optio qui? Numquam, quo fuga. Maiores minus, accusantium velit
                        numquam a aliquam vitae vel?</p>
                </div>

                <!-- Action Buttons -->

            </div>
        </div>
    </section>

    <?php }} ?>

    <!--   !product  -->

    <!-- ************************************************************************************************************************************************* -->
    <!-- ************************************************************************************************************************************************* -->
    <!-- ************************************************************************************************************************************************* -->
    <!-- ************************************************************************************************************************************************* -->
    <!-- ************************************************************************************************************************************************* -->
    <!-- ************************************************************************************************************************************************* -->
    <!-- ************************************************************************************************************************************************* -->
    <!-- ************************************************************************************************************************************************* -->
    <!-- ************************************************************************************************************************************************* -->
    <!-- ************************************************************************************************************************************************* -->
    <!-- ************************************************************************************************************************************************* -->
    <!-- Top Sale -->
    <section id="top-sale">
        <div>
            <div class="container py-5">
                <h4 class="font-rubik font-size-20">Top Sale</h4>
                <hr>
                <!-- owl carousel -->

                <div class="owl-carousel owl-theme">

                    <?php
                        $topSallery = $item->topSellOfProduct($catID);
                        if ($topSallery) {
                            while ($Sallery = mysqli_fetch_assoc($topSallery)) {
                                $oneImg = $item->itemImg($Sallery['id']);
                                $img = mysqli_fetch_assoc($oneImg);
                                $imgSrc = $img ? 'image/' . $img['name'] : 'image/default.jpg'; // Use a default image if none found
                        ?>
                    <div class="item py-2">
                        <div class="product font-rale">
                            <a href="product.php?id=<?= $Sallery['id']?>"><img id="topSallery" src="<?= $imgSrc ?>"
                                    class="img-fluid"></a>
                            <div class="text-center">
                                <h6><?= $Sallery['name'] ?></h6>
                                <div class="rating text-warning font-size-12">

                                    <?php 
                                for ($i=0; $i < 5 ; $i++ ) { 
                                    
                                ?>
                                    <span><i
                                            class="<?= $Sallery['rating'] > $i ? 'fas fa-star' : 'far fa-star' ?>"></i></span>
                                    <?php } ?>
                                </div>
                                <div class="price py-2">
                                    <span>$<?= $Sallery['price'] ?></span>
                                </div>
                                <a href="add_to_cart.php?id=<?= $Sallery['id']?>"></a> <button type="submit"
                                    class="btn btn-success font-size-12">Add to Cart</button>
                            </div>
                        </div>
                    </div>

                    <?php 
    }
}
?>
                    <!-- !Top Sale -->

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
<!-- !start #footer -->
<?php
include $includes . "footer.php";