<?php
session_start();
include '../../database/config.php';


$sql = "SELECT * FROM products";
$res = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($res) 
?>