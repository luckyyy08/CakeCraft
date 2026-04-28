<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "cakecraft";

$conn = mysqli_connect($host,$user,$password,$database);

if(!$conn){
    die("Connection Failed");
}

?>