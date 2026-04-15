<?php
session_start();
include 'db.php';
header('Content-Type: application/json');

$user_id = $_SESSION['user_id'] ?? null;

if(!$user_id){
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("
SELECT 
    o.order_id,
    o.order_number,
    o.total_amount,
    o.status,
    o.created_at,
    o.table_id,

    COALESCE(u.name, 'Unknown User') AS customer_name,
    COALESCE(t.table_number, 0) AS table_number,

    oi.order_item_id,
    oi.quantity,
    oi.price,
    oi.subtotal,
    oi.note,

    COALESCE(p.name, '') AS product_name

FROM orders o

LEFT JOIN users u ON o.user_id = u.user_id
LEFT JOIN tables t ON o.table_id = t.table_id
LEFT JOIN order_items oi ON o.order_id = oi.order_id
LEFT JOIN products p ON oi.product_id = p.product_id

WHERE o.user_id = ?

ORDER BY o.created_at DESC
");

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];

while($row = $result->fetch_assoc()){

    $order_id = $row['order_id'];

    if(!isset($orders[$order_id])){

        $orders[$order_id] = [
            "order_id" => $row['order_id'],
            "order_number" => $row['order_number'],
            "total_amount" => $row['total_amount'],
            "status" => $row['status'],
            "created_at" => $row['created_at'],
            "table_id" => $row['table_id'],
            "customer_name" => $row['customer_name'],
            "table_number" => $row['table_number'],
            "items" => []
        ];
    }

    // منع إضافة item فاضي
    if(!empty($row['product_name'])){

        $orders[$order_id]['items'][] = [
            "product_name" => $row['product_name'],
            "quantity" => $row['quantity'],
            "price" => $row['price'],
            "subtotal" => $row['subtotal'],
            "note" => $row['note']
        ];
    }
}

echo json_encode(array_values($orders));
?>