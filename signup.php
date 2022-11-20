<html lang="eng">

<?php
include("./includes/db.php")
  ?>

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Wedding Fashion">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sign up</title>

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
      <h2> <a class="inactive underlineHover" href="./signin.php">Sign In</a></h2>
      <h2 class="active">Sign Up </h2>

      <!-- Icon -->
      <div class="fadeIn first">
        <img src="./img/icon/user.png" id="icon" alt="User Icon" />
      </div>

      <!-- SignUp Form -->
      <form method="post">
        <input type="text" id="name" class="fadeIn second" name="name" placeholder="Enter Name" required>
        <input type="text" id="address" class="fadeIn second" name="address" placeholder="Enter Address" required>
        <input type="email" id="email" class="fadeIn second" name="email" placeholder="Enter Email abc@xyz" required>
        <input type="tel" pattern="0[0-9]{9}" class="fadeIn second" id="phone" name="phone"
          placeholder="Enter Phone 0xxxxxxxxxx" required />
        <input type="password" id="password" class="fadeIn third" name="password" placeholder="Enter Password"
          pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
          oninvalid="this.setCustomValidity('At least 1 upper and lower case letter, 1 digit, minimun 8 in length')"
          required>
        <input type="password" id="cpassword" class="fadeIn third" name="cpassword" placeholder="Comfirm Password"
          required>
        <input type="submit" class="fadeIn fourth" value="Sign Up">
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

$showAlert = false;
$showError = false;
$exists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Include file which makes the
  // Database Connection.
  $name = $_POST["name"];
  $address = $_POST["address"];
  $phone = $_POST["phone"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];


  $sql = "SELECT * from customers where email='$email'";
  $num = $conn->query($sql)->rowCount();

  // This sql query is use to check if
  // the email is already present 
  // or not in our Database
  if ($num == 0) {
    if (($password == $cpassword) && $exists == false) {

      $hash = password_hash(
        $password,
        PASSWORD_DEFAULT
      );
      $data = [
        'customer_name' => $name,
      'address' => $address,
        'phone'=> $phone,
        'email'=>$email, 
        'password'=> $hash,
      ];
      // Password Hashing is used here. 
      $sql = "INSERT INTO customers ( `customer_name`,`address`,`phone`,`email`, 
      `password`) VALUES (:customer_name,:address,:phone,:email, 
      :password)";

  $result=$conn->prepare($sql)->execute($data);
      if ($result) {
        $showAlert = true;
      }
    } else {
      $showError = "Passwords do not match";
    }
  } // end if 

  if ($num > 0) {
    $exists = "Email not available";
  }

} //end if   

?>
<script src="
https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="
sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>

<script src="
https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>

<script src="
https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
  integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
  </script>

<!-- Alert message-->
<?php
function alert($msg)
{
  echo "<script type='text/javascript'>alert('$msg');</script>";
}

if ($showAlert) {
  alert("Account created");
}

if ($showError) {
  alert($showError);
}

if ($exists) {
  alert($exists);
}

?>
<!-- End Alert message-->

</html>