<?php
session_start();
include 'db.php';

// تحديد نوع الرد JSON عشان JavaScript يفهمه
header('Content-Type: application/json');

// قراءة البيانات القادمة من الـ frontend (JSON body)
$input = json_decode(file_get_contents('php://input'), true);

// استخراج id الإشعار
$id = $input['id'] ?? null;

// لو فيه id، نعمل تحديث للإشعار ونخليه مقروء
if($id){
    $stmt = $conn->prepare("
        UPDATE notifications 
        SET is_read = 1 
        WHERE notification_id = ?
    ");

    // ربط الـ id بالاستعلام
    $stmt->bind_param("i", $id);

    // تنفيذ التحديث
    $stmt->execute();
}

// إرسال رد نجاح للـ frontend
echo json_encode(['success' => true]);
?>