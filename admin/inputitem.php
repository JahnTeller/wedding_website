<html lang="eng">
  <?php
include("./includes/db.php");
?>
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Wedding Fashion">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Item input</title>

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
      <h2 class="active">Item input</h2>

      <!-- SignUp Form -->
      <form method="post"  enctype="multipart/form-data">
        <input type="text" id="name" class="fadeIn second" name="name" placeholder="Name" required>
        <input type="text" id="price" class="fadeIn second" name="price" placeholder="Price" required>
        <input type="file" id="image" class="fadeIn second" name="image" placeholder="Image" required>
        <select name="category" required>
            <?php 
            $sql = "Select * from categories";
            foreach($conn->query($sql) as $row){
            echo '<option value='.$row['categoryId'].'>'.$row['category_name'].'</option>';
            }
            ?>
        </select>
        <input type="submit" class="fadeIn fourth" value="Add">
      </form>
  <!-- partial -->

</body>

<?php
function alert($msg)
{
  echo "<script type='text/javascript'>alert('$msg');</script>";
}
$status = $statusMsg = ''; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Include file which makes the
  // Database Connection.  

  $name = $_POST["name"];
  $price = $_POST["price"];
  $categoryId = $_POST["category"];

  //--upload--//
  if(!empty($_FILES["image"]["name"])) { 
    $image = $_FILES['image']['tmp_name']; 
    $imgContent = addslashes(file_get_contents($image)); 
        // Insert data content into database
        $sql="INSERT into items (item_name,image,categoryId,price) VALUES ('$name','$imgContent','$categoryId','$price')"; 
        $insert = $conn->query($sql);
        if($insert){ 
            $status = 'success'; 
            $statusMsg = "uploaded successfully."; 
        }else{ 
            $statusMsg = $conn->errorInfo(); 
        }  
    }  
    print_r($statusMsg);
  }
//--image upload end--//
?>

<!-- End Alert message-->

</html>