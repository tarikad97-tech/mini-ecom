<?php
header("Content-Type: application/json");
include '../../database/config.php';


$sql = "SELECT * FROM categories";
$result = mysqli_query($db, $sql);
 $categorie = [];
while ($row = mysqli_fetch_assoc($result)) {
    $categorie[] = $row;
}

echo json_encode($categorie);
?>
