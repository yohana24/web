<?php
session_start(); 
// تشغيل السيشن عشان نعرف المستخدم الحالي وصلاحياته

include '../auth_check.php'; 
include '../db.php'; 
// ربط بقاعدة البيانات + التحقق من الصلاحيات

// ===== التأكد إن المستخدم Admin فقط =====
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    http_response_code(403);
    // إرسال كود 403 يعني ممنوع الوصول

    echo json_encode(['error'=>'Access denied']);
    // منع غير الـ admin من الوصول للبيانات

    exit;
}

// ===== تحديد نوع الرد JSON =====
header('Content-Type: application/json');

// ===== جلب كل المستخدمين من قاعدة البيانات =====
$result = $conn->query("
    SELECT 
        user_id AS id,
        name,
        email,
        role
    FROM users
    ORDER BY user_id DESC
");

// مصفوفة لتجميع المستخدمين
$users = [];

// ===== تحويل البيانات لمصفوفة =====
while($row = $result->fetch_assoc()){
    $users[] = $row;
}

// ===== إرسال البيانات للواجهة =====
echo json_encode($users);
?>