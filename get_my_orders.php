<?php
session_start();
include 'db.php';
header('Content-Type: application/json');

$user_id = $_SESSION['user_id'];

// جلب كل الأوردرات للمستخدم
$stmt = $conn->prepare("
    SELECT order_id, order_number, status, total_amount, created_at
    FROM orders 
    WHERE user_id=? 
    ORDER BY created_at DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];

while($row = $result->fetch_assoc()){
    // جلب تفاصيل المنتجات لكل أوردر
    $items_res = $conn->query("
SELECT 
products.name AS product_name,
order_items.quantity,
order_items.price,
order_items.subtotal,
order_items.note
FROM order_items
JOIN products 
ON order_items.product_id = products.product_id
WHERE order_items.order_id = ".$row['order_id']."
");

    $items = [];
    while($item = $items_res->fetch_assoc()){
        $items[] = $item;
    }

    $row['items'] = $items; // مصفوفة المنتجات داخل الأوردر
    $orders[] = $row;
}

echo json_encode($orders);
?>
