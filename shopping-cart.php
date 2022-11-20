<!DOCTYPE html>
<html lang="zxx">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $(document).on('click', ".pro-qty-2", function(){
    $div=$(this);
    $totalmoney = parseInt($div.find('input').val())*parseInt($div.find('input').attr('name'));
 
    $("#totalmoney"+$div.find('input').attr('id')).text($totalmoney);
    $("#totalmoney"+$div.find('input').attr('id')).val($totalmoney);
    $ajaxdata = 
    {'itemId':$div.find('input').attr('id'),
    'quantity':$div.find('input').val()
    };
    console.log($ajaxdata);
    $.ajax({
        type:'POST',
        url:'updatecart.php',
        data:$ajaxdata,
        success:function(response) { 
            var res=response;
            console.log(res);   
            console.log($(document).find('#carttotalheader'));
            $('#cartTotal').text(res+" VND");
            $(document).find('#carttotalheader').text(res+"VND");                
        
        },
    // Alert status code and error if fail
    error: function (xhr, ajaxOptions, thrownError){
        alert(xhr.status);
        alert(thrownError);
    }
      });
});
});

function deleteitemcart(cartitemId){

}
</script>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Wedding_Fashion Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wedding-Fashion</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>


<body>
    
<?php 
include("./includes/header.php");
?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.php">Home</a>
                            <a href="./shop.php">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                include("./includes/db.php");
                                //query cart
                                $customerId = $_SESSION['customerId'];
                                $sqlcartitem= "SELECT * FROM carts WHERE customerId= '$customerId'";
                                $cartitem = $conn->query($sqlcartitem)->fetchAll();
                                foreach($cartitem as $row){
                                    //query item
                                    $itemId = $row['itemId'];
                                $sqlitem = "SELECT * FROM items where itemId = '$itemId'";
                                $item = $conn->query($sqlitem)->fetchAll();
                                foreach($item as $itemrow){
                                ?>
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                        <img width="100px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($itemrow['image']); ?>" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6><?php echo $itemrow['item_name'];?></h6>
                                            <h5><?php echo number_format($itemrow['price'])." VND";?></h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2" >
                                                <input type="text" value="<?php echo $row['quantity']?>" id="<?php echo $itemrow["itemId"]?>" name="<?php echo $itemrow["price"]?>">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price" id="totalmoney<?php echo $itemrow['itemId']?>" value="<?php echo $itemrow['price']*$row['quantity'] ?>"><?php echo $itemrow['price']*$row['quantity'] ?> VND</td>
                                    <td  class="cart__close"><a href="deleteitemcart.php?itemId=<?php echo $itemrow['itemId']?>" id=""><i class="fa fa-close"></i></a></td>

                                <?php }} ?>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="shop.php">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li ><span id="cartTotal"><?php echo $_SESSION['cartTotal'];?> VND</span></li>
                        </ul>
                        <a href="./checkout.php" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
<?php 
include("./includes/footer.php");?>