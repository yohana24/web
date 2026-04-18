<?php
session_start(); 
// تشغيل السيشن عشان نعرف المستخدم وصلاحياته

include '../db.php'; 
// الاتصال بقاعدة البيانات

// ===== التأكد إن المستخدم Admin فقط =====
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    echo json_encode([
        'success'=>false,
        'message'=>'Access denied'
    ]);
    // منع أي حد غير admin من تنفيذ الحذف
    exit;
}

// ===== جلب id الخاص بالطاولة المراد حذفها =====
$id = $_POST['table_id'] ?? '';

// ===== التأكد إن الـ ID موجود =====
if($id){

    // ===== حذف الطاولة من قاعدة البيانات =====
    $stmt = $conn->prepare("DELETE FROM tables WHERE table_id=?");

    // ربط الـ id بالاستعلام
    $stmt->bind_param("i", $id);

    // تنفيذ عملية الحذف
    $stmt->execute();

    // رد نجاح العملية
    echo json_encode([
        'success'=>true,
        'message'=>'Table deleted'
    ]);

} else {

    // لو مفيش ID جاي
    echo json_encode([
        'success'=>false,
        'message'=>'Invalid ID'
    ]);
}
?>