<?php
session_start(); 
// تشغيل السيشن عشان نعرف المستخدم الحالي وصلاحياته

include '../db.php'; 
include '../auth_check.php'; 
// الاتصال بقاعدة البيانات + التأكد من الصلاحيات

// ===== التأكد إن المستخدم Admin فقط =====
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    echo json_encode([]);
    // لو مش admin نرجع array فاضي ونمنع الوصول
    exit;
}

// ===== جلب كل رسائل التواصل من الداتابيز =====
$result = $conn->query("
    SELECT * 
    FROM contact_messages 
    ORDER BY created_at DESC
");

// مصفوفة لتجميع الرسائل
$data = [];

// ===== تحويل النتائج لمصفوفة =====
while($row = $result->fetch_assoc()){
    $data[] = $row;
}

// ===== تحديد نوع الرد JSON =====
header('Content-Type: application/json');

// ===== إرسال الرسائل للواجهة =====
echo json_encode($data);
?>