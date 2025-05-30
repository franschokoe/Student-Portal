<?php

$dbservername="127.0.0.1:3306";
$dbusername="root";
$dbpassword="";
$dbName="studentportal";

if(!$con = mysqli_connect($dbservername,$dbusername,$dbpassword,$dbName)){
    die("Failed to Connect to Database");
}