<!-- Page Preloder -->
<?php
session_start();
?>
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__option">
        <div class="offcanvas__links">
            <?php
            if ($_SESSION['isLogged']) {
                echo '<a href="#"><img src="img/icon/small_user.png"></a> <a href="./logout.php">LOGOUT</a>';
            } else {
                echo '<a href="./signin.php">Sign in</a>';
            }
            ?>
            
            <a href="#">FAQs</a>
        </div>
    </div>
    <div class="offcanvas__nav__option">
        <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
        <a href="#"><img src="img/icon/heart.png" alt=""></a>
        <a href="./shopping-cart.php"><img width="23px" src="img/icon/cart.png" alt=""> <span
                            style="font-weight: bold;" id="cartNumber1" ><?php if(isset($_SESSION['isLogged'])){echo $_SESSION['cartCount'];}else echo "0";?></span></a>
        <div class="price">$0.00</div>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__text">
        <p>Free shipping, 30-day return or refund guarantee.</p>
    </div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p>Free shipping, 30-day return or refund guarantee.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            <?php
                            if (isset($_SESSION['isLogged'])) {
                                echo '<a href="#"><img src="img/icon/small_user.png"></a>
                                <a href="./logout.php">LOGOUT</a> ';
                            } else {
                                echo '<a href="./signin.php">Sign in</a>';
                            }
                            ?>                           
                            <a href="#">FAQs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="./index.php"><img src="img/logo1.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="<?php
                        $current_file_name = basename($_SERVER['PHP_SELF']);
                        if($current_file_name=="index.php"){echo "active";}
                        ?>"><a href="./index.php">Home</a>
                        </li>
                        <li class="<?php
                        $current_file_name = basename($_SERVER['PHP_SELF']);
                        if($current_file_name!=="index.php"){echo "active";}
                        ?>"><a href="./shop.php">Shop</a>
                        </li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="./about.php">About Us</a></li>
                                <li><a href="./shop-details.php">Shop Details</a></li>
                                <li><a href="./shopping-cart.php">Shopping Cart</a></li>
                                <li><a href="./checkout.php">Check Out</a></li>
                            </ul>
                        </li>
                        <li><a href="./contact.php">Contacts</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3" >
                <div class="header__nav__option" >
                    <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                    <a href="./shopping-cart.php"><img width="23px" src="img/icon/cart.png" alt=""> <span
                            style="font-weight: bold;" id="cartNumber" ><?php if(isset($_SESSION['isLogged'])){echo $_SESSION['cartCount'];}else echo "0";?></span></a>
                    <div id="carttotalheader"><?php if(isset($_SESSION['isLogged'])){echo number_format($_SESSION['cartTotal']);} else echo '0,000' ;?> VND</div>
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<!-- Header Section End -->