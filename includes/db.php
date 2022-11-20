<?php
try {
    $host = "localhost";   
    $dbname = "wedding_db"; 
    $username = "root";    
    $password = "";        
    $conn = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("error : " . $e->getMessage() ) ;  
}