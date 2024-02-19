<?php

$serverName = "localhost";
$DBusername="root";
$DBpassword="1234";
$DBname="php_assignment";

$conn=mysqli_connect($serverName,$DBusername,$DBpassword,$DBname);
 if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
 }
?>