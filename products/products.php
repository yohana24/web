<?php
session_start(); 
// تشغيل السيشن عشان نستخدم بيانات المستخدم وصلاحياته

include '../auth_check.php'; 
include '../db.php'; 
// ربط بقاعدة البيانات + التأكد من الصلاحيات (لو موجود auth_check)

// ===== التأكد إن المستخدم Admin فقط =====
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    http_response_code(403); 
    // إرسال كود خطأ 403 بمعنى Forbidden

    echo json_encode(['error'=>'Access denied']);
    // منع الوصول لو مش Admin

    exit;
}

// ===== تحديد نوع الرد JSON =====
header('Content-Type: application/json');

// ===== جلب كل المنتجات من قاعدة البيانات =====
$result = $conn->query("
    SELECT 
        product_id AS id,
        name,
        description,
        price,
        stock_quantity,
        category_id,
        image
    FROM products
    ORDER BY product_id DESC
");

// مصفوفة لتجميع المنتجات
$products = [];

// ===== تحويل نتائج الداتابيز لمصفوفة =====
while($row = $result->fetch_assoc()){
    $products[] = $row;
}

// ===== إرسال البيانات للـ frontend =====
echo json_encode($products);
?>