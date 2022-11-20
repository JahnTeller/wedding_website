<!DOCTYPE html>
<html lang="en">
<?php 
include("./includes/header.php");   
include("includes/db.php");
unset($_SESSION['page']);
$_SESSION['page'] = "shop";
?>
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
<?php include('./includes/loginVerify.php')?>

function addCart(itemId){
    $.ajax({
        type:'POST',
        url:'addcart.php',
        data:{"itemId":itemId},
        success:function(response) { 
            res=JSON.parse(response);
            console.log(res);
            alert(res[0]);
            $(document).find('#carttotalheader').text(res[2]+"VND");
            $(document).find('#cartNumber').text(res[1]);
            
        },
    // Alert status code and error if fail
    error: function (xhr, ajaxOptions, thrownError){
        alert(xhr.status);
        alert(thrownError);
    }
      });
}
</script>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
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

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.php">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->



    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row" >
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <?php 
                                                    $sql="SELECT category_name,categoryId FROM categories";
                                                    $result=$conn->query($sql);
                                                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                                        $categoryId = $row['categoryId'];
                                                        echo '<li><a href="?categoryId='.$categoryId.'">' .$row["category_name"]. '</a></li>';
                                                    }?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Showing 1–12 of 126 results</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sort by Price:</p>
                                    <select>
                                        <option value="">Low To High</option>
                                        <option value="">$0 - $55</option>
                                        <option value="">$55 - $100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        if(!isset($_GET['categoryId'])){                         
                        $sql="SELECT * FROM items";} else {
                            $categoryId = $_GET['categoryId'];
                            $sql="SELECT * FROM items WHERE categoryId='$categoryId'";}
                        $result = $conn->query($sql)->fetchAll();
                        foreach ($result as $row){ ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>">
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                        <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                                        </li>
                                        <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">                                    
                                    <h6><?php echo $row['item_name'];?></h6>                                    
                                    <a href="javascript:addCart(<?php echo $row['itemId']; ?>)" class="add-cart">+ Add To Cart</a>
                                    <h5><?php echo number_format($row['price']);?> VND</h5>    
                                    
                                </div>
                            </div>
                        </div>
                        <?php } ?>                            
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
    

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
<?php include("./includes/footer.php");
?>