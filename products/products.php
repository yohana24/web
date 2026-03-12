<?php
session_start();
include '../auth_check.php';
include '../db.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role']!=='admin'){
    http_response_code(403);
    echo json_encode(['error'=>'Access denied']);
    exit;
}
header('Content-Type: application/json');

$result = $conn->query("SELECT product_id AS id, name, description, price, stock_quantity, category_id, image FROM products ORDER BY product_id DESC");
$products = [];
while($row = $result->fetch_assoc()){
    $products[] = $row;
}
echo json_encode($products);