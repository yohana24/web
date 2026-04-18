<?php
session_start();
include 'db.php';

// تحديد نوع الرد إنه JSON عشان يتقري من JavaScript
header('Content-Type: application/json');

// جلب user_id من السيشن (المستخدم الحالي)
$user_id = $_SESSION['user_id'] ?? null;

// لو مفيش مستخدم عامل login نرجع array فاضي ونوقف
if(!$user_id){
    echo json_encode([]);
    exit;
}

// جلب الإشعارات غير المقروءة للمستخدم الحالي فقط
$stmt = $conn->prepare("
    SELECT * FROM notifications
    WHERE user_id=? AND is_read=0
    ORDER BY created_at DESC
");

// ربط user_id بالاستعلام
$stmt->bind_param("i", $user_id);

// تنفيذ الاستعلام
$stmt->execute();

// الحصول على النتائج
$result = $stmt->get_result();

$notifications = [];

// تحويل النتائج لمصفوفة عشان نقدر نرجعها JSON
while($row = $result->fetch_assoc()){
    $notifications[] = $row;
}

// إرسال البيانات للـ frontend
echo json_encode($notifications);
?>