<?php
header("Content-Type: application/json");
include '../../database/config.php';


$sql = "SELECT * FROM orders ";
$res = mysqli_query($db, $sql);
 $ordres = [];
while ($row = mysqli_fetch_assoc($res)) {
    $ordres[] = $row;
}

echo json_encode($ordres);
?>