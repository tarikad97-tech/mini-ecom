<?php
include '../../database/config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    $total = 0;
    foreach($_SESSION['cart'] as $id => $qty){
        $p = mysqli_fetch_assoc(mysqli_query($conn,"SELECT price FROM products WHERE id=$id"));
        $total += $p['price'] * $qty;
    }

    mysqli_query($db,"INSERT INTO orders(customer_name,phone,address,city,total)
    VALUES('$name','$phone','$address','$city','$total')");

    $order_id = mysqli_insert_id($db);

    foreach($_SESSION['cart'] as $id => $qty){
        $p = mysqli_fetch_assoc(mysqli_query($db,"SELECT price FROM products WHERE id=$id"));
        $sub = $p['price'] * $qty;

        mysqli_query($db,"INSERT INTO order_items(order_id,product_id,quantity,unit_price,subtotal)
        VALUES('$order_id','$id','$qty','".$p['price']."','$sub')");
    }

    unset($_SESSION['cart']);
    echo "Order saved";
}
?>