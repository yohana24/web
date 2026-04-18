<?php
session_start(); 
// تشغيل السيشن لو محتاجين نستخدم بيانات المستخدم أو الصلاحيات

include '../db.php'; 
// الاتصال بقاعدة البيانات

// ===== استلام البيانات اللي جاية من الفورم =====
$product_id = $_POST['product_id'];
// رقم المنتج اللي هيتضاف له الفلافور

$name = $_POST['flavor_name'];
// اسم النكهة

$price = $_POST['price'];
// سعر النكهة

$stock = $_POST['stock_quantity'];
// كمية المخزون المتاحة

// ===== رفع صورة النكهة لو موجودة =====
$image = '';
if(isset($_FILES['image']) && $_FILES['image']['name']){

    $image = $_FILES['image']['name'];
    // اسم الصورة

    move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$image);
    // نقل الصورة لمجلد uploads عشان تتخزن على السيرفر
}

// ===== إدخال البيانات في قاعدة البيانات =====
$stmt = $conn->prepare("
    INSERT INTO product_flavors 
    (product_id, flavor_name, image, price, stock_quantity) 
    VALUES (?, ?, ?, ?, ?)
");

// ربط القيم بالـ query
$stmt->bind_param("issdi", $product_id, $name, $image, $price, $stock);

// ===== تنفيذ عملية الإضافة =====
if($stmt->execute()){
    echo json_encode([
        'success'=>true,
        'message'=>'Flavor saved successfully'
    ]);
    // لو العملية نجحت بنرجع رسالة نجاح
} else {
    echo json_encode([
        'success'=>false,
        'message'=>$stmt->error
    ]);
    // لو حصل خطأ بنرجع سبب المشكلة
}
?>