<?php require "connection.inc.php";
require "functions.inc.php";
require "add_to_cart.inc.php";
$obj = new add_to_cart;
$totalProduct = $obj->totalProduct();
$cat_res = mysqli_query($con, "SELECT * FROM categories WHERE status=1");
$cat_arr = array();
while ($row = mysqli_fetch_assoc($cat_res)) {
    $cat_arr[] = $row;
} ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ecom website</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">


    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="css/shortcode/header.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">

    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start Header Style -->
        <header id="htc__header" class="htc__header__area header--one">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                                <div class="logo">
                                    <a href="index.html"><img src="images/logo/4.png" alt="logo images"></a>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="index.php">Home</a></li>
                                        <?php foreach ($cat_arr as $list) { ?>
                                            <li><a href="categories.php?id=<?= $list['id'] ?>"><?= $list['categories'] ?></a></li>
                                        <?php } ?>
                                        <li><a href="contact.php">contact</a></li>
                                    </ul>
                                </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="index.html">Home</a></li>
                                            <?php foreach ($cat_arr as $list) { ?>
                                                <li><a href="categories.php?id=<?= $list['id'] ?>"><?= $list['categories'] ?></a></li>
                                            <?php } ?>
                                            <li><a href="contact.php">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2 col-sm-4 col-xs-4">
                                <div class="header__right">
                                    <div id="search-btn" class="header__search search search__inner search_open ">
                                        <a href="#"><i class="icon-magnifier icons"></i></a>
                                    </div>
                                    <div class="header__account">
                                        <?php if (isset($_SESSION['user_login'])) { ?>
                                            <a href="logout.php">Logout</a><a href="my_order.php">My Order</a>
                                        <?php
                                        } else {
                                        ?><a href="login.php">Login/Register</a>
                                        <?php } ?>
                                    </div>
                                    <div class="htc__shopping__cart">
                                        <a class="cart__menu" href=""><i class="icon-handbag icons"></i></a>
                                        <a href="cart.php"><span class="htc__qua"><?= $totalProduct ?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->

            <!-- End Header Area -->
            <div class="body__overlay ">
                <div class="offset__wrapper">
                    <div class="search__area">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="search__inner ">
                                        <form action="#" method="get">
                                            <input placeholder="Search here..." type="text" name="str">
                                            <button type="submit">Search</button>
                                        </form>
                                        <div class="search__close__btn">
                                            <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>