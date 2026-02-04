
<?php

session_start();
require_once '../../database/config.php';


$id = $_GET['id'] ?? 0;

$sql = "SELECT * FROM products WHERE id = $id";
$res = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($res);

if(!$row){
    echo "Product not found";
    exit;
}
?>