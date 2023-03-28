<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ishop";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Database error -". mysqli_connect_error());
   
}

?>