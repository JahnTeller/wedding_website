<html lang="eng">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Wedding Fashion">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sign In</title>

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
  <link rel="stylesheet" href="css/login-style.css" type="text/css">

</head>

<body>
  <!-- partial:index.partial.php -->
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->
      <h2 class="active"> Sign In </h2>
      <h2><a class="inactive underlineHover" href="./signup.php">Sign Up</a></h2>

      <!-- Icon -->
      <div class="fadeIn first">
        <img src="./img/icon/user.png" id="icon" alt="User Icon" />
      </div>

      <!-- Login Form -->
      <form method="post">
        <input type="text" id="email" class="fadeIn second" name="email" placeholder="Email" required>
        <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password" required>
        <input type="submit" class="fadeIn fourth" value="Log In">
      </form>

      <!-- Remind Passowrd -->
      <div id="formFooter">
        <a class="underlineHover" href="#">Forgot Password?</a>
      </div>

    </div>
  </div>
  <!-- partial -->

</body>

<?php
session_start();
include("./includes/db.php");
function alert($msg){
  echo "<script type='text/javascript'>alert('$msg');</script>";
}
if (isset($_SESSION['isLogged'])) {
  header("Location: ./index.php");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
$Lemail = $_POST["email"];
$Lpassword = $_POST["password"];

$sql = "SELECT * FROM customers WHERE email='$Lemail'";
$row=$conn->query($sql)->fetch(PDO::FETCH_ASSOC);
$num = $conn->query($sql)->rowCount();

if (($num == 1) && (password_verify($Lpassword, $row['password']))) {
  $_SESSION['isLogged'] = true;
  $_SESSION['customerId'] = $row['customerId'];
  $_SESSION['phone'] = $row['phone'];
  $_SESSION['email'] = $row['email'];
  $_SESSION['address'] = $row['address'];
  $_SESSION['customer_name'] = $row['customer_name'];
  $customerId = $row['customerId'];
  //CART COUNT
  $sqlcartcount="SELECT COUNT(*) FROM carts WHERE customerId='$customerId'";
  $cartcount= $conn->query($sqlcartcount)->fetchColumn();
  $_SESSION['cartCount'] = $cartcount;
  //cart total money;
  $totalmoney = 0;
  $sql="SELECT itemId,quantity FROM carts WHERE customerId='$customerId'";
  $cartItem= $conn->query($sql)->fetchAll();
  foreach($cartItem as $row){
    $itemId=$row['itemId'];
    $quantity=$row['quantity'];
    $sqlitem = "SELECT price FROM items WHERE itemId='$itemId'";
    $item= $conn->query($sqlitem)->fetchAll();
    foreach($item as $itemrow){
    $totalmoney += $quantity*$itemrow['price'];
    //echo $totalmoney;
  }
  }
  $_SESSION['cartTotal'] = $totalmoney;
  header("Location: ./index.php");
  //echo $_SESSION['cartTotal'];
} else
  alert("Incorrect email or password");
}
?>

</html>