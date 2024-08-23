<?php require "top.php";
$order_id = get_safe_value($con, $_GET['id'])
?>
<div class="body__overlay"></div>
<!-- Start Offset Wrapper -->
<div class="offset__wrapper">
    <!-- Start Search Popap -->
    <div class="search__area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search__inner">
                        <form action="#" method="get">
                            <input placeholder="Search here... " type="text">
                            <button type="submit"></button>
                        </form>
                        <div class="search__close__btn">
                            <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Search Popap -->
    <!-- Start Cart Panel -->
    <div class="shopping__cart">
        <div class="shopping__cart__inner">
            <div class="offsetmenu__close__btn">
                <a href="#"><i class="zmdi zmdi-close"></i></a>
            </div>
            <div class="shp__cart__wrap">
                <div class="shp__single__product">
                    <div class="shp__pro__thumb">
                        <a href="#">
                            <img src="images/product-2/sm-smg/1.jpg" alt="product images">
                        </a>
                    </div>
                    <div class="shp__pro__details">
                        <h2><a href="product-details.html">BO&Play Wireless Speaker</a></h2>
                        <span class="quantity">QTY: 1</span>
                        <span class="shp__price">$105.00</span>
                    </div>
                    <div class="remove__btn">
                        <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="shp__single__product">
                    <div class="shp__pro__thumb">
                        <a href="#">
                            <img src="images/product-2/sm-smg/2.jpg" alt="product images">
                        </a>
                    </div>
                    <div class="shp__pro__details">
                        <h2><a href="product-details.html">Brone Candle</a></h2>
                        <span class="quantity">QTY: 1</span>
                        <span class="shp__price">$25.00</span>
                    </div>
                    <div class="remove__btn">
                        <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
            </div>
            <ul class="shoping__total">
                <li class="subtotal">Subtotal:</li>
                <li class="total__price">$130.00</li>
            </ul>
            <ul class="shopping__btn">
                <li><a href="cart.html">View Cart</a></li>
                <li class="shp__checkout"><a href="checkout.html">Checkout</a></li>
            </ul>
        </div>
    </div>
    <!-- End Cart Panel -->
</div>
<!-- End Offset Wrapper -->
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.html">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Wishlist</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- wishlist-area start -->
<div class="wishlist-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wishlist-content">
                    <form action="#">
                        <div class="wishlist-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Product Name</th>
                                        <th class="product-name"><span class="nobr">Product Image</span></th>
                                        <th class="product-price"><span class="nobr">Qty </span></th>
                                        <th class="product-stock-stauts"><span class="nobr">Price </span></th>
                                        <th class="product-add-to-cart"><span class="nobr">Total Price</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $uid = $_SESSION['user_id'];
                                    $result = mysqli_query($con, "SELECT  distinct(`order_detail`.`id`),`order_detail`.*,product.name,product.image FROM `order_detail`, `product`, `order`WHERE `order_detail`.`order_id`='$order_id' AND `product`.`id`=`order_detail`.`product_id` AND `order`.user_id='$uid';");
                                    $total_price = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $total_price = $total_price + ($row['price'] * $row['qty']);
                                    ?>
                                        <tr>
                                            <td class="product-thumbnail"><?= $row['name'] ?></td>
                                            <td class="product-thumbnail"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image'] ?>"></td>
                                            <td class="product-thumbnail"><?= $row['qty'] ?></td>
                                            <td class="product-thumbnail"><?= $row['price'] ?></td>
                                            <td class="product-thumbnail"><?= $row['qty'] * $row['price'] ?></td>

                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="4" class="product-thumbnail" style="font-weight: bold;">Total Price</td>
                                        <td class="product-thumbnail"><?= $total_price ?></td>

                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- wishlist-area end -->


<?php require "footer.php"; ?>