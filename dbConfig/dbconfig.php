<?php
$dbhost="localhost:3308";
$username="root";
$password="";
$dbname="wl";


$con= new mysqli($dbhost,$username,$password,$dbname);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>