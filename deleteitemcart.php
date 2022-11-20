<?php 
session_start();
include("./includes/db.php");
$itemId=$_GET['itemId'];
$customerId = $_SESSION['customerId'];
$sql="DELETE FROM carts WHERE itemId='$itemId' AND customerId='$customerId'";
$delete=$conn->query($sql);
if($delete){
    echo "done";
}else echo "err";$totalmoney = 0;
$customerId = $_SESSION['customerId'];
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
//cart count  
$sqlcartcount="SELECT COUNT(*) FROM carts WHERE customerId='$customerId'";
$cartcount= $conn->query($sqlcartcount)->fetchColumn();
$_SESSION['cartCount'] = $cartcount;
$_SESSION['cartTotal'] = $totalmoney;
header("Location: ./shopping-cart.php");
?>