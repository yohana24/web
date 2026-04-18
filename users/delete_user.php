<?php
session_start(); 
// تشغيل السيشن عشان نعرف المستخدم الحالي وصلاحياته

include '../db.php'; 
// الاتصال بقاعدة البيانات

// ===== التأكد إن المستخدم Admin فقط =====
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    echo json_encode([
        'success'=>false,
        'message'=>'Access denied'
    ]);
    // منع أي حد غير admin من حذف المستخدمين
    exit;
}

// ===== جلب id المستخدم المراد حذفه =====
$id = $_POST['user_id'] ?? '';

// ===== التأكد إن الـ ID موجود =====
if($id){

    // ===== حذف المستخدم من قاعدة البيانات =====
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id=?");

    // ربط الـ ID بالاستعلام
    $stmt->bind_param("i", $id);

    // تنفيذ الحذف
    $stmt->execute();

    // رد نجاح العملية
    echo json_encode([
        'success'=>true,
        'message'=>'User deleted'
    ]);

} else {

    // لو مفيش ID جاي
    echo json_encode([
        'success'=>false,
        'message'=>'Invalid ID'
    ]);
}
?>