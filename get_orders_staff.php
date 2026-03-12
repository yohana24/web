<?php
session_start();
include 'db.php';
header('Content-Type: application/json');

$result = $conn->query("
    SELECT 
        orders.order_id,
        orders.order_number,
        orders.total_amount,
        orders.status,
        orders.created_at,
        users.name AS customer_name,
        tables.table_number
    FROM orders
    JOIN users ON orders.user_id = users.user_id
    JOIN tables ON orders.table_id = tables.table_id
    ORDER BY orders.created_at DESC
");

$orders = [];

while($row = $result->fetch_assoc()){
    // جلب تفاصيل المنتجات لكل أوردر مع الـ Note
    $items_res = $conn->query("
        SELECT 
            products.name AS product_name, 
            order_items.quantity, 
            order_items.price, 
            order_items.subtotal,
            order_items.note
        FROM order_items
        JOIN products ON order_items.product_id = products.product_id
        WHERE order_items.order_id = " . $row['order_id']
    );

    $items = [];
    while($item = $items_res->fetch_assoc()){
        $items[] = $item;
    }

    $row['items'] = $items;
    $orders[] = $row;
}

echo json_encode($orders);
?>