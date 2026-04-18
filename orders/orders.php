<?php
include '../db.php'; 
// الاتصال بقاعدة البيانات

include '../auth_check.php'; 
// التأكد إن المستخدم عنده صلاحية يدخل الصفحة

// ===== جلب كل الأوردرات من الداتابيز =====
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

// مصفوفة لتجميع كل الأوردرات
$orders = [];

while($row = $result->fetch_assoc()){

    // ===== جلب المنتجات الخاصة بكل أوردر =====
    $items_result = $conn->query("
        SELECT p.name AS product_name, oi.quantity
        FROM order_items oi
        JOIN products p ON oi.product_id = p.product_id
        WHERE oi.order_id = ".$row['order_id']."
    ");

    $items = [];

    // تحويل المنتجات لمصفوفة
    while($item = $items_result->fetch_assoc()){
        $items[] = $item;
    }

    // إضافة المنتجات داخل الأوردر نفسه
    $row['items'] = $items;

    // إضافة الأوردر للقائمة النهائية
    $orders[] = $row;
}

// إرسال كل الأوردرات للـ frontend في شكل JSON
echo json_encode($orders);
?>