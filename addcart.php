<?php
include("./carttotal.php");
$msg='';
  if(isset($_POST['itemId'])){
  $customerId=$_SESSION['customerId'];
  $itemId = $_POST['itemId'];
  //check item exit in carts
  $sqlCheckCart = " SELECT COUNT(*) FROM carts WHERE itemId='$itemId' AND customerId = '$customerId' ";
  $checkResult = $conn->query($sqlCheckCart)->fetchColumn();
  //insert to carts
  if($checkResult<1){
  $sql="INSERT into carts (customerId, itemId) VALUES ('$customerId','$itemId')";
  $insert= $conn->query($sql);
  if($insert){
    $msg="Add to cart!";
  } else $msg= "add fail!";
  //cart count  
  $sqlcartcount="SELECT COUNT(*) FROM carts WHERE customerId='$customerId'";
  $cartcount= $conn->query($sqlcartcount)->fetchColumn();
  $_SESSION['cartCount'] = $cartcount;
  } else {$msg= "already added to cart";}  
  echo json_encode(array($msg,$_SESSION['cartCount'],$_SESSION['cartTotal']));
}
  
?>