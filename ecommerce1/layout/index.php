<?php
session_start();
include "init.php";
include $includes ."header.php";

$catigory = new catigory;

$cat            = $catigory->getCatigorys();
$catig          = $catigory->getCatigorys();
$topSallery     = $catigory->topSell();
$someItems      = $catigory->someItems();
$newProducts    = $catigory->newProducts();
$ads            = $catigory->ads();

?>

<!-- !start #header -->

<!-- start #main-site -->
<main id="main-site">

    <!-- Owl-carousel -->
    <section id="banner-area">
        <div class="owl-carousel owl-theme ads">
            <?php 
        if($ads){
            while($oneAds = mysqli_fetch_assoc($ads)){
                
        ?>
            <div class="item">
                <img src="assets/<?= $oneAds['img'] ?>" alt="Banner1" class="product-img img-fluid">
            </div>
            <?php }}?>

        </div>
    </section>


    <!-- !Owl-carousel -->
    <div id="categories" class="market-partition my-4">
        <?php
            if ($cat) {
    
                while ($row = mysqli_fetch_assoc($cat)) {
                    echo "<img data-id=". $row['id'] ." src=image/" . $row['img'] . ">";
            
                }
            }
            ?>

    </div>


    <!-- Top Sale -->
    <section id="top-sale">
        <div>
            <div class="container py-5">
                <h4 class="font-rubik font-size-20">Top Sale</h4>
                <hr>
                <!-- owl carousel -->

                <div class="owl-carousel owl-theme">

                    <?php
                    
                        if ($topSallery) {
                            while ($Sallery = mysqli_fetch_assoc($topSallery)) {
                                $oneImg = $catigory->itemImg($Sallery['id']);
                                $img = mysqli_fetch_assoc($oneImg);
                                $imgSrc = $img ? 'image/' . $img['name'] : 'image/default.jpg'; // Use a default image if none found
                        ?>
                    <div class="item py-2 product-add" data-id="<?= $Sallery['id']?>">
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
                                <a href="add_to_cart.php?id=<?= $Sallery['id']?>"> <button type="submit"
                                        class="btn btn-success font-size-12 add-to-cart">Add to
                                        Cart</button></a>

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

    </section>
    <!-- !Top Sale -->


    <!-- Special Price -->
    <section id="special-price">
        <div class="container">
            <h4 class="font-rubik font-size-20">Special Price</h4>
            <div id="filters" class="button-group text-right font-baloo font-size-16">
                <button class="btn is-checked" data-filter="*" style="font-weight:bold">All Products</button>
                <?php 
                    if($catig){
                    while ($rowName = mysqli_fetch_assoc($catig)) {
                    ?>
                <button class="btn" data-filter=".<?= $rowName['id']?>"><?= $rowName['name']?></button>
                <?php }}?>
            </div>

            <div class="grid">
                <?php 
                    if($someItems){
                        while($row2 = mysqli_fetch_assoc($someItems)){
                            $firstImg = $catigory->itemImg($row2['id']); 
                            $img2 = mysqli_fetch_assoc($firstImg);
                            $imgSrc2 = $img2 ? 'image/' . $img2['name'] : 'image/default.jpg';
                            
                    ?>
                <div class="grid-item Apple normalBox border">
                    <div class="item py-2" data-id="<?= $row2['categoryID']?>" style="width: 200px;">
                        <div class="product font-rale">
                            <a href="product.php?id=<?= $row2['id']?>"><img id="topSallery" src="<?= $imgSrc2 ?>"
                                    alt="product1" class="img-fluid"></a>
                            <div class="text-center">
                                <h6><?= $row2['name']?></h6>
                                <div class="rating text-warning font-size-12">
                                    <?php 
                                                for ($i=0; $i < 5 ; $i++ ) { 
                                                ?>
                                    <span><i
                                            class="<?= $row2['rating'] > $i ? 'fas fa-star' : 'far fa-star' ?>"></i></span>
                                    <?php } ?>
                                </div>
                                <div class="price py-2">
                                    <span>$<?= $row2['price']?></span>
                                </div>
                                <a href="add_to_cart.php?id=<?= $row2['id']?>"><button type="submit"
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
    </section>
    <!-- !Special Price -->

    <!-- Banner Ads  -->
    <section id="banner_adds">
        <div class="container py-5 text-center">
            <img src="assets/adds6.avif" alt="banner1" class="img-fluid">
            <hr>
            <img src="assets/adds7.avif" alt="banner1" class="img-fluid">
            <hr>
            <img src="assets/adds5.gif" alt="banner1" class="img-fluid">
        </div>
    </section>
    <!-- !Banner Ads  -->

    <!-- New Phones -->
    <section id="new-phones">
        <div class="container">
            <h4 class="font-rubik font-size-20">New Products</h4>
            <hr>
            <!-- ************************************************************************* -->
            <!-- owl carousel -->
            <div class="owl-carousel owl-theme">
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
            <!-- !owl carousel -->

        </div>
    </section>
    <!-- !New Phones -->

    <!-- Blogs -->
    <section id="blogs">
        <div class="container py-4">
            <h4 class="font-rubik font-size-20">Latest Blogs</h4>
            <hr>

            <div class="owl-carousel owl-theme">
                <div class="item">
                    <div class="card border-0 font-rale mr-5" style="width: 18rem;">
                        <h5 class="card-title font-size-16">Upcoming Mobiles</h5>
                        <img src="assets/blog/blog1.jpg" alt="cart image" class="card-img-top">
                        <p class="card-text font-size-14 text-black-50 py-1">Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Veritatis non iste sequi cupiditate tempora iure. Velit accusamus
                            saepe harum sed.</p>
                        <a href="#" class="color-second text-left">Go somewhere</a>
                    </div>
                </div>
                <div class="item">
                    <div class="card border-0 font-rale mr-5" style="width: 18rem;">
                        <h5 class="card-title font-size-16">Upcoming Mobiles</h5>
                        <img src="assets/blog/blog2.jpg" alt="cart image" class="card-img-top">
                        <p class="card-text font-size-14 text-black-50 py-1">Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Veritatis non iste sequi cupiditate tempora iure. Velit accusamus
                            saepe harum sed.</p>
                        <a href="#" class="color-second text-left">Go somewhere</a>
                    </div>
                </div>
                <div class="item">
                    <div class="card border-0 font-rale mr-5" style="width: 18rem;">
                        <h5 class="card-title font-size-16">Upcoming Mobiles</h5>
                        <img src="assets/blog/blog3.jpg" alt="cart image" class="card-img-top">
                        <p class="card-text font-size-14 text-black-50 py-1">Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Veritatis non iste sequi cupiditate tempora iure. Velit accusamus
                            saepe harum sed.</p>
                        <a href="#" class="color-second text-left">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- !Blogs -->

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
    <p class="font-rale font-size-14">&copy; Copyrights 2024. Desing By <a href="#" class="color-second">Yahya
            wael</a></p>
</div>
<!-- !start #footer -->
<?php
include $includes . "footer.php";