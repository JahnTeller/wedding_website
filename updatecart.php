<?php
include("./includes/db.php");
if(isset($_POST['itemId'])){
$itemId=$_POST['itemId'];
$quantity=$_POST['quantity'];
$sql="UPDATE carts set quantity = '$quantity' WHERE itemId='$itemId'";
$update = $conn->query($sql);
}
session_start();
//cart total money;
$totalmoney = 0;
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
$_SESSION['cartTotal'] = $totalmoney;
echo $totalmoney;

?>