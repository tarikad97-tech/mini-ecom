<?php
include '../../database/config.php';

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
}

$cartItems = [];
$total = 0;

foreach($_SESSION['cart'] as $id => $qty){
    $res = mysqli_query($db,"SELECT * FROM products WHERE id=$id");
    $p = mysqli_fetch_assoc($res);
    $p['qty'] = $qty;
    $p['subtotal'] = $qty * $p['price'];
    $total += $p['subtotal'];
    $cartItems[] = $p;
}
?>