<?php
session_start();
include 'db.php';
header('Content-Type: application/json');
include 'auth_check.php';

// ===== جلب كل الأوردرات مع رقم الترابيزة واسم المستخدم =====
$sql = "
    SELECT o.order_id, o.order_number, o.status, o.total_amount, o.created_at,
           t.table_number, u.name AS customer_name
    FROM orders o
    JOIN tables t ON o.table_id = t.table_id
    JOIN users u ON o.user_id = u.user_id
    ORDER BY o.created_at DESC
";

$result = $conn->query($sql);
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
        JOIN products ON order_items.product_id = products.product_id
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