<?php
session_start();
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$order_id = $data['order_id'];
$user_id = $_SESSION['user_id'];

// جلب بيانات الاوردر القديم
$order = $conn->query("SELECT * FROM orders WHERE order_id=$order_id")->fetch_assoc();

$new_order_number = "ORD" . time();
$total = $order['total_amount'];

// إنشاء اوردر جديد
$conn->query("
INSERT INTO orders (user_id, order_number, total_amount, status, created_at)
VALUES ($user_id,'$new_order_number',$total,'Pending',NOW())
");

$new_order_id = $conn->insert_id;

// جلب المنتجات القديمة
$items = $conn->query("SELECT * FROM order_items WHERE order_id=$order_id");

while($item = $items->fetch_assoc()){

    $product_id = $item['product_id'];
    $quantity = $item['quantity'];
    $price = $item['price'];
    $note = $conn->real_escape_string($item['note']);

    $conn->query("
    INSERT INTO order_items (order_id, product_id, quantity, price, note)
    VALUES ($new_order_id,$product_id,$quantity,$price,'$note')
    ");
}

echo json_encode(["success"=>true]);