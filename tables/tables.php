<?php
session_start(); 
// تشغيل السيشن عشان نعرف المستخدم الحالي وصلاحياته

include '../auth_check.php'; 
include '../db.php'; 
// ربط بقاعدة البيانات + التأكد من الصلاحيات

// ===== التأكد إن المستخدم Admin فقط =====
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    http_response_code(403);
    // إرسال كود خطأ 403 يعني ممنوع الدخول

    echo json_encode(['error'=>'Access denied']);
    // منع الوصول وإرجاع رسالة خطأ

    exit;
}

// ===== تحديد نوع الرد JSON =====
header('Content-Type: application/json');

// ===== جلب كل الطاولات من قاعدة البيانات =====
$result = $conn->query("
    SELECT 
        table_id AS id,
        table_number,
        status 
    FROM tables 
    ORDER BY table_id DESC
");

// مصفوفة لتجميع النتائج
$tables = [];

// ===== تحويل البيانات لمصفوفة =====
while($row = $result->fetch_assoc()){
    $tables[] = $row;
}

// ===== إرسال البيانات للواجهة =====
echo json_encode($tables);
?>