<?php
header("Content-Type: application/json");
include '../../database/config.php';

$sql = "SELECT * FROM categories";
$result = mysqli_query($db, $sql);
 $products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cate[] = $row;
}

echo json_encode($cate);
?>