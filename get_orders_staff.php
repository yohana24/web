<?php
session_start();
include 'db.php';
header('Content-Type: application/json');

$user_id = $_SESSION['user_id'] ?? null;
if(!$user_id){
    echo json_encode([]);
    exit;
}

// ===== جلب الأوردرات + LEFT JOIN للطاولات عشان Takeaway يظهر =====
$stmt = $conn->prepare("
    SELECT 
        orders.order_id,
        orders.order_number,
        orders.total_amount,
        orders.status,
        orders.created_at,
        orders.table_id,
        users.name AS customer_name,
        tables.table_number
    FROM orders
    JOIN users ON orders.user_id = users.user_id
    LEFT JOIN tables ON orders.table_id = tables.table_id
    WHERE orders.user_id=?
    ORDER BY orders.created_at DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];

while($row = $result->fetch_assoc()){
    // جلب المنتجات لكل أوردر
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

    // لو table_id = 0 نعتبره Takeaway
    $row['display_table'] = $row['table_id'] == 0 ? 'Takeaway' : 'Table #' . $row['table_number'];

    $orders[] = $row;
}

echo json_encode($orders);
?>