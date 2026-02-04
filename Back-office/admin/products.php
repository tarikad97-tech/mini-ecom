<?php
header("Content-Type: application/json");
include '../../database/config.php';


$sql = "SELECT * FROM products ";
$res = mysqli_query($db, $sql);
 $products = [];
while ($row = mysqli_fetch_assoc($res)) {
    $products[] = $row;
}

echo json_encode($products);
?>