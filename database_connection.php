<?php 
// file to connect to database
$db_host = "localhost"; //can be "localhost" for local development
$db_username = "root";
$db_password = "";
$db_name = "ics499";
$conn = new mysqli($db_host,$db_username,$db_password,$db_name) or die(mysqli_error());
?>