<?php
session_start();
include 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$order_id = $data['order_id'] ?? null;

if(!$order_id){
    echo json_encode(['success'=>false]);
    exit;
}

// 1️⃣ هات بيانات الأوردر الأول
$getOrder = $conn->prepare("SELECT user_id, order_number, status FROM orders WHERE order_id=?");
$getOrder->bind_param("i", $order_id);
$getOrder->execute();
$result = $getOrder->get_result();
$order = $result->fetch_assoc();

if(!$order){
    echo json_encode(['success'=>false]);
    exit;
}

// لو هو بالفعل Completed ما نعملش حاجة
if($order['status'] === "Completed"){
    echo json_encode(['success'=>true]);
    exit;
}

// 2️⃣ تحديث الحالة
$stmt = $conn->prepare("UPDATE orders SET status='Completed' WHERE order_id=?");
$stmt->bind_param("i", $order_id);
$stmt->execute();

// 3️⃣ إنشاء Notification
$message = "Order placed! Order Number: " . $order['order_number'];

$notif = $conn->prepare("
    INSERT INTO notifications (user_id, order_id, message, is_read, created_at)
    VALUES (?, ?, ?, 0, NOW())
");
$notif->bind_param("iis", $order['user_id'], $order_id, $message);
$notif->execute();

echo json_encode(['success'=>true]);
?>