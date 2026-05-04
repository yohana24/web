<?php
include '../db.php';
include '../auth_check.php';

$result = $conn->query("
    SELECT 
        orders.order_id,
        orders.order_number,
        orders.total_amount,
        orders.status,
        orders.created_at,
        users.name AS user_name,
        tables.table_number
    FROM orders
    LEFT JOIN users ON orders.user_id = users.user_id
    LEFT JOIN tables ON orders.table_id = tables.table_id
    ORDER BY orders.created_at DESC
");

$orders = [];

while($row = $result->fetch_assoc()){

    $items_result = $conn->query("
        SELECT p.name AS product_name, oi.quantity
        FROM order_items oi
        JOIN products p ON oi.product_id = p.product_id
        WHERE oi.order_id = ".$row['order_id']."
    ");

    $items = [];

    while($item = $items_result->fetch_assoc()){
        $items[] = $item;
    }

    $row['items'] = $items;
    $orders[] = $row;
}

echo json_encode($orders);
?>