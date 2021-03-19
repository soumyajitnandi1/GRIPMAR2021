<?php

$servaername="localhost";
$username="root";
$password="";
$database="bank";


//creating database connection
$conn=mysqli_connect($servaername,$username,$password,$database);
//cheak connection
if (!$conn) {
    die("failed to connect".mysqli_connect_error());
}
?>