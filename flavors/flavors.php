<?php
session_start(); 
// تشغيل السيشن لو محتاجين نستخدم بيانات المستخدم

include '../db.php'; 
// الاتصال بقاعدة البيانات

include '../auth_check.php'; 
// التأكد إن المستخدم له صلاحية يدخل الصفحة

// جلب id بتاع المنتج من الرابط
$product_id = $_GET['product_id'] ?? 0;

// جلب كل الفلافورز الخاصة بالمنتج ده من الداتابيز
$result = $conn->query("SELECT * FROM product_flavors WHERE product_id=$product_id");

$data = [];

// تحويل النتائج لمصفوفة عشان نرجعها مرة واحدة
while($row = $result->fetch_assoc()){
    $data[] = $row;
}

// تحديد نوع البيانات راجع JSON
header('Content-Type: application/json');

// إرسال البيانات للواجهة
echo json_encode($data);
?>