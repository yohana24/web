<?php
session_start();
include '../db.php';

// بيانات من الفورم
$product_id = $_POST['product_id'];
$name = $_POST['flavor_name'];
$price = $_POST['price'];
$stock = $_POST['stock_quantity'];

// رفع الصورة لو موجودة
$image = '';
if(isset($_FILES['image']) && $_FILES['image']['name']){
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$image);
}

// تعديل اسم الجدول لو فعليًا اسمه product_flavors
$stmt = $conn->prepare("INSERT INTO product_flavors (product_id, flavor_name, image, price, stock_quantity) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("issdi", $product_id, $name, $image, $price, $stock);

// تنفيذ وإرجاع نتيجة
if($stmt->execute()){
    echo json_encode(['success'=>true,'message'=>'Flavor saved successfully']);
} else {
    echo json_encode(['success'=>false,'message'=>$stmt->error]);
}