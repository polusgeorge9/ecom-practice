<?php require "top.php";
$cart_total = 0;
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
?>
   <script>
      window.location.href = "index.php";
   </script>
   <?php }

$cart_total = 0;
foreach ($_SESSION['cart'] as $key => $val) {
   $productArr = get_product($con, '', '', $key);
   $price = $productArr['0']['price'];
   $qty = $val['qty'];
   $cart_total = $cart_total + ($price * $qty);
}

if (isset($_POST['submit'])) {
   $address = get_safe_value($con, $_POST['address']);
   $city = get_safe_value($con, $_POST['city']);
   $pincode = get_safe_value($con, $_POST['pincode']);
   $payment_type = get_safe_value($con, $_POST['payment_type']);
   $user_id = $_SESSION['user_id'];
   $total_price = $cart_total;
   $payment_status = 'Pending';
   if ($payment_type == 'cod') {
      $payment_status = 'Success';
   }
   $order_status = '1';
   $txnid = substr(hash('sha512', mt_rand() . microtime()), 0, 20);
   $added_on = date('Y-m-d h:i:s');
   mysqli_query($con, "INSERT INTO `order`(user_id,address,city,pincode,payment_type,total_price,payment_status,order_status,txnid,added_on)
    VALUES('$user_id','$address','$city','$pincode','$payment_type','$total_price','$payment_status','$order_status','$txnid','$added_on')");

   $order_id = mysqli_insert_id($con);
   $cart_total = 0;
   foreach ($_SESSION['cart'] as $key => $val) {
      $productArr = get_product($con, '', '', $key);
      $price = $productArr['0']['price'];
      $qty = $val['qty'];
      mysqli_query($con, "INSERT INTO `order_detail`(`order_id`, `product_id`, `qty`, `price`)
      VALUES ('$order_id','$key','$qty','$price')");
   }
   unset($_SESSION['cart']);

   if ($payment_type == 'payu') {
      //namespace APITestCode;
      require_once('PayU.php');


      $userArr = mysqli_fetch_assoc(mysqli_query($con, "select * from users where id='$user_id'"));
      $res = $payu_obj->initGateway();

      $param['txnid'] = $txnid;
      $param['firstname'] = $userArr['name'];
      $param['amount'] = $total_price;
      $param['email'] = $userArr['email'];
      $param['productinfo'] = 'productinfo';
      $param['phone'] = $userArr['mobile'];
      // $param['address1'] = 'address1';
      //$param['city'] = 'delhi';
      //$param['state'] = 'Delhi';
      //$param['country'] = 'India';
      //$param['zipcode'] = 'zipcode';
      //$par//am['api_version'] = '1';
      //$param['udf1'] = 'test';


      $res = $payu_obj->showPaymentForm($param);
   } else { ?>
      <script>
         window.location.href = "thank_you.php";
      </script>
<?php
   }
}


?>
<div class="checkout-wrap ptb--100">
   <div class="container">
      <div class="row">
         <div class="col-md-8">
            <div class="checkout__inner">
               <div class="accordion-list">
                  <div class="accordion">
                     <?php
                     $accordion__class = "accordion__title";
                     if (!isset($_SESSION['user_login'])) {
                        $accordion__class = "accordion__hide"; ?>
                        <div class="accordion__title">
                           Checkout Method
                        </div>
                        <div class="accordion__body">
                           <div class="accordion__body__form">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="checkout-method__login">
                                       <form id="login-form" method="post">
                                          <h5 class="checkout-method__title">Login</h5>
                                          <div class="single-input">
                                             <label for="user-email">Email Address</label>
                                             <input type="email" name="login_email" id="login_email" placeholder="Your Email*" style="width:100%">
                                             <span id="login_email_error" class="field_error"></span>
                                          </div>
                                          <div class="single-input">
                                             <label for="user-pass">Password</label>
                                             <input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
                                             <span id="login_password_error" class="field_error"></span>
                                          </div>
                                          <p class="require">* Required fields</p>
                                          <div class="dark-btn">
                                             <button type="button" onclick="user_login()" class="fv-btn">Login</button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="checkout-method__login">
                                       <form action="#">
                                          <h5 class="checkout-method__title">Register</h5>
                                          <div class="single-input">
                                             <label for="user-email">Name</label>
                                             <input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
                                             <span id="name_error" class="field_error"></span>
                                          </div>
                                          <div class="single-input">
                                             <label for="user-email">Email Address</label>
                                             <input type="text" name="email" id="email" placeholder="Your Email*" style="width:100%">
                                             <span id="email_error" class="field_error"></span>
                                          </div>
                                          <div class="single-input">
                                             <label for="user-mobile">Mobile</label>
                                             <input type="text" name="mobile" id="mobile" placeholder="Your * Mobile " style="width:100%">
                                             <span id="mobile_error" class="field_error"></span>
                                          </div>
                                          <div class="single-input">
                                             <label for="user-pass">Password</label>
                                             <input type="text" name="password" id="password" placeholder="Your Password*" style="width:100%">
                                             <span id="password_error" class="field_error"></span>
                                          </div>
                                          <div class="contact-btn">
                                             <button type="button" onclick="user_registeration()" class="fv-btn">Register</button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php } ?>
                     <div class="<?= $accordion__class ?>">
                        Address Information
                     </div>
                     <form method="post">
                        <div class="accordion__body">
                           <div class="bilinfo">

                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="single-input">
                                       <input type="text" name="address" placeholder="Street Address" required>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="single-input">
                                       <input type="text" name="city" placeholder="City/State" required>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="single-input">
                                       <input type="text" name="pincode" placeholder="Post code/ zip" required>
                                    </div>
                                 </div>
                              </div>

                           </div>
                        </div>
                        <div class="<?= $accordion__class ?>">
                           payment information
                        </div>
                        <div class="accordion__body">
                           <div class="paymentinfo">
                              <div class="single-method">
                                 COD <input type="radio" name="payment_type" value="cod" required>
                                 &nbsp; PayU <input type="radio" name="payment_type" value="payu" required>
                              </div>
                              <div class="single-method">

                              </div>
                           </div>
                        </div>
                        <input type="submit" name="submit">
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="order-details">
               <h5 class="order-details__title">Your Order</h5>
               <div class="order-details__item">
                  <?php
                  $cart_total = 0;
                  foreach ($_SESSION['cart'] as $key => $val) {
                     $productArr = get_product($con, '', '', $key);
                     $pname = $productArr['0']['name'];
                     $mrp = $productArr['0']['mrp'];
                     $price = $productArr['0']['price'];
                     $image = $productArr['0']['image'];
                     $qty = $val['qty'];
                     $cart_total = $cart_total + ($price * $qty);
                  ?>
                     <div class="single-item">
                        <div class="single-item__thumb">
                           <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $image; ?>" alt="ordered item">
                        </div>
                        <div class="single-item__content">
                           <a href="#"><?php echo $pname ?></a>
                           <span class="price"><?= $price * $qty ?></span>
                        </div>
                        <div class="single-item__remove">
                           <a href="javascript:void(0)" onclick="manage_cart('<?= $key ?>','remove')"><i class="zmdi zmdi-delete"></i></a>
                        </div>
                     </div>
                  <?php } ?>
               </div>
               <div class="ordre-details__total">
                  <h5>Order total</h5>
                  <span class="price"><?= $cart_total ?></span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- cart-main-area end -->
<!-- Start Footer Area -->
<footer id="htc__footer">
   <!-- Start Footer Widget -->
   <div class="footer__container bg__cat--1">
      <div class="container">
         <div class="row">
            <!-- Start Single Footer Widget -->
            <div class="col-md-3 col-sm-6 col-xs-12">
               <div class="footer">
                  <h2 class="title__line--2">ABOUT US</h2>
                  <div class="ft__details">
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim</p>
                     <div class="ft__social__link">
                        <ul class="social__link">
                           <li><a href="#"><i class="icon-social-twitter icons"></i></a></li>
                           <li><a href="#"><i class="icon-social-instagram icons"></i></a></li>
                           <li><a href="#"><i class="icon-social-facebook icons"></i></a></li>
                           <li><a href="#"><i class="icon-social-google icons"></i></a></li>
                           <li><a href="#"><i class="icon-social-linkedin icons"></i></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <!-- End Single Footer Widget -->
            <!-- Start Single Footer Widget -->
            <div class="col-md-2 col-sm-6 col-xs-12 xmt-40">
               <div class="footer">
                  <h2 class="title__line--2">information</h2>
                  <div class="ft__inner">
                     <ul class="ft__list">
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Delivery Information</a></li>
                        <li><a href="#">Privacy & Policy</a></li>
                        <li><a href="#">Terms & Condition</a></li>
                        <li><a href="#">Manufactures</a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <!-- End Single Footer Widget -->
            <!-- Start Single Footer Widget -->
            <div class="col-md-2 col-sm-6 col-xs-12 xmt-40 smt-40">
               <div class="footer">
                  <h2 class="title__line--2">my account</h2>
                  <div class="ft__inner">
                     <ul class="ft__list">
                        <li><a href="#">My Account</a></li>
                        <li><a href="cart.html">My Cart</a></li>
                        <li><a href="#">Login</a></li>
                        <li><a href="wishlist.html">Wishlist</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <?php require "footer.php"; ?>