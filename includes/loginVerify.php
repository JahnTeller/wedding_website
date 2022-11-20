<?php
if (!isset($_SESSION['isLogged'])) {
    header("Location: ./signin.php");
}

?>