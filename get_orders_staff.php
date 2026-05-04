<?php
session_start();
include 'db.php';
header('Content-Type: application/json');

// ===== جلب كل الطلبات =====
$stmt = $conn->prepare("
SELECT 
    o.order_id,
    o.order_number,
    o.total_amount,
    o.status,
    o.created_at,
    o.table_id,
    u.name AS customer_name,
    u.phone AS phone,
    t.table_number
FROM orders o
JOIN users u ON o.user_id = u.user_id
LEFT JOIN tables t ON o.table_id = t.table_id
ORDER BY o.created_at DESC
");

$stmt->execute();
$result = $stmt->get_result();

$orders = [];

while($row = $result->fetch_assoc()){

    $order_id = $row['order_id'];

    // ===== إنشاء order =====
    if(!isset($orders[$order_id])){

        $orders[$order_id] = [
            "order_id" => $row['order_id'],
            "order_number" => $row['order_number'],
            "total_amount" => $row['total_amount'],
            "status" => $row['status'],
            "created_at" => $row['created_at'],
            "table_id" => $row['table_id'],
            "customer_name" => $row['customer_name'],
            "phone" => $row['phone'],
            "table_number" => $row['table_number'],
            "items" => []
        ];
    }

    // ===== جلب items الصح =====
    $itemsStmt = $conn->prepare("
        SELECT 
            p.name AS product_name,
            oi.quantity,
            oi.price,
            oi.subtotal,
            oi.note
        FROM order_items oi
        JOIN products p ON oi.product_id = p.product_id
        WHERE oi.order_id = ?
    ");

    $itemsStmt->bind_param("i", $order_id);
    $itemsStmt->execute();
    $itemsResult = $itemsStmt->get_result();

    while($item = $itemsResult->fetch_assoc()){
        $orders[$order_id]['items'][] = $item;
    }
}

// ===== output =====
echo json_encode(array_values($orders));
?>