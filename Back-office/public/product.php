
<?php

session_start();
require_once '../../database/config.php';

if (!isset($_GET['id'])) {
header('Location: products.php');
exit;
}else {
$id = (int)$_GET['id'] ;

$sql = "SELECT * FROM products WHERE id = $id";
$res = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($res);

if(!$row){
    echo "Product not found";
    exit;
}
}

?>