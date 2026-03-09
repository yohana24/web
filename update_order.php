<?php
session_start();
include 'db.php';

// ===== تحديد نوع المحتوى للرد بالـ JSON =====
header('Content-Type: application/json');

// ===== جلب البيانات المرسلة من الـ JS =====
$data = json_decode(file_get_contents("php://input"), true);
$order_id = $data['order_id'] ?? null; // رقم الأوردر

// ===== لو مفيش order_id يبعت خطأ =====
if(!$order_id){
    echo json_encode(['success'=>false]);
    exit;
}

//  جلب بيانات الأوردر من جدول orders
$getOrder = $conn->prepare("SELECT user_id, order_number, status FROM orders WHERE order_id=?");
$getOrder->bind_param("i", $order_id);
$getOrder->execute();
$result = $getOrder->get_result();
$order = $result->fetch_assoc();

// ===== لو الأوردر مش موجود =====
if(!$order){
    echo json_encode(['success'=>false]);
    exit;
}

// ===== لو الأوردر تم بالفعل إتمامه (Completed) ما نعملش أي حاجة =====
if($order['status'] === "Completed"){
    echo json_encode(['success'=>true]);
    exit;
}

//  تحديث حالة الأوردر في جدول orders إلى Completed
$stmt = $conn->prepare("UPDATE orders SET status='Completed' WHERE order_id=?");
$stmt->bind_param("i", $order_id);
$stmt->execute();

//  إنشاء Notification للمستخدم
$message = "Order placed! Order Number: " . $order['order_number'];

// إدخال إشعار في جدول notifications
$notif = $conn->prepare("
    INSERT INTO notifications (user_id, order_id, message, is_read, created_at)
    VALUES (?, ?, ?, 0, NOW())
");
$notif->bind_param("iis", $order['user_id'], $order_id, $message);
$notif->execute();

// ===== الرد النهائي للـ JS =====
echo json_encode(['success'=>true]);
?>