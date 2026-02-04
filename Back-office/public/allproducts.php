<?php
header("Content-Type: application/json");
include '../../database/config.php';


$sql = "SELECT products.*,categories.name as namecat FROM products,categories
WHERE categories.id=products.category_id
ORDER BY products.id DESC";
$result = mysqli_query($db, $sql);
 $products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

echo json_encode($products);
?>
