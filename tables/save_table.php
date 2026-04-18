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
    // منع أي حد غير admin من تعديل أو إضافة طاولات
    exit;
}

// ===== جلب البيانات من الفورم =====
$id = $_POST['table_id'] ?? '';
$number = $_POST['table_number'] ?? '';
$status = $_POST['status'] ?? '';

// ===== التأكد إن البيانات الأساسية موجودة =====
if(!$number || !$status){
    echo json_encode([
        'success'=>false,
        'message'=>'Please fill all fields'
    ]);
    exit;
}

// ===== لو فيه ID → تعديل طاولة =====
if($id){

    $stmt = $conn->prepare("
        UPDATE tables 
        SET table_number=?, status=? 
        WHERE table_id=?
    ");

    $stmt->bind_param("isi",$number,$status,$id);

    $stmt->execute();

    echo json_encode([
        'success'=>true,
        'message'=>'Table updated'
    ]);

} else {

    // ===== إضافة طاولة جديدة =====
    $stmt = $conn->prepare("
        INSERT INTO tables(table_number,status) 
        VALUES(?,?)
    ");

    $stmt->bind_param("is",$number,$status);

    $stmt->execute();

    echo json_encode([
        'success'=>true,
        'message'=>'Table added'
    ]);
}
?>