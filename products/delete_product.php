<?php
session_start(); 
// تشغيل السيشن عشان نقدر نعرف المستخدم الحالي وصلاحياته

include '../db.php'; 
// الاتصال بقاعدة البيانات

// ===== التأكد إن اللي داخل Admin بس =====
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    echo json_encode([
        'success'=>false,
        'message'=>'Access denied'
    ]);
    // لو مش admin بنمنع الدخول ونرجع رسالة
    exit;
}

// ===== جلب id المنتج المراد حذفه =====
$id = $_POST['product_id'] ?? '';

// ===== التأكد إن الـ ID موجود =====
if($id){

    // ===== حذف المنتج من قاعدة البيانات =====
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id=?");

    // ربط الـ ID في الاستعلام
    $stmt->bind_param("i", $id);

    // تنفيذ عملية الحذف
    $stmt->execute();

    // رجوع رسالة نجاح
    echo json_encode([
        'success'=>true,
        'message'=>'Product deleted'
    ]);

} else {

    // لو مفيش ID جاي من الفورم
    echo json_encode([
        'success'=>false,
        'message'=>'Invalid ID'
    ]);
}
?>