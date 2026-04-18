<?php
session_start();
include 'db.php'; // الاتصال بقاعدة البيانات

// التأكد إن الطلب جاي بطريقة POST (يعني من الفورم)
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    // استقبال البيانات من الفورم
    $first = $_POST['firstName'] ?? '';
    $last = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    // تجهيز الاستعلام لحماية قاعدة البيانات من SQL Injection
    $stmt = $conn->prepare("
        INSERT INTO contact_messages (first_name, last_name, email, message) 
        VALUES (?, ?, ?, ?)
    ");

    // ربط القيم بالاستعلام
    $stmt->bind_param("ssss", $first, $last, $email, $message);

    // تنفيذ الحفظ في قاعدة البيانات
    $stmt->execute();

    // إرسال رد للـ JavaScript إن العملية نجحت
    echo json_encode(['success' => true]);
}
?>