<?php
session_start();
include '../db.php';

include '../auth_check.php'; // لو موجودة في فولدر أعلى، عدّل المسار حسب مكان الملف


$product_id = $_GET['product_id'] ?? 0;

$result = $conn->query("SELECT * FROM product_flavors WHERE product_id=$product_id");

$data = [];
while($row = $result->fetch_assoc()){
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);