<?php
session_start(); // تشغيل السيشن عشان لو فيه صلاحيات أو تسجيل دخول
include '../db.php'; // ربط بقاعدة البيانات

// ===== جلب id الخاص بالـ flavor اللي هيتحذف =====
$id = $_POST['flavor_id'];

// ===== تجهيز أمر الحذف من الداتابيز  =====
$stmt = $conn->prepare("DELETE FROM flavors WHERE flavor_id=?");

// ===== ربط قيمة الـ id بالمكان الفاضي في الاستعلام =====
$stmt->bind_param("i", $id);

// ===== تنفيذ أمر الحذف =====
$stmt->execute();

// ===== رجوع رد للـ frontend إن العملية نجحت =====
echo json_encode(['success'=>true]);
?>