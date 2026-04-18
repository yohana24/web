<?php
session_start(); 
// تشغيل السيشن عشان نستخدم بيانات المستخدم وصلاحياته

include '../db.php'; 
// الاتصال بقاعدة البيانات

// ===== التأكد إن المستخدم Admin فقط =====
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    echo json_encode([
        'success'=>false,
        'message'=>'Access denied'
    ]);
    // منع أي حد غير admin من تنفيذ الإضافة أو التعديل
    exit;
}

// ===== جلب بيانات المنتج من الفورم =====
$id = $_POST['product_id'] ?? '';
$name = $_POST['name'] ?? '';
$desc = $_POST['description'] ?? '';
$price = $_POST['price'] ?? 0;
$stock = $_POST['stock_quantity'] ?? 0;
$category = $_POST['category_id'] ?? '';

// ===== تجهيز متغير الصورة =====
$imagePath = '';

// ===== لو فيه صورة جديدة اتبعتت =====
if(isset($_FILES['image']) && $_FILES['image']['name']){

    $imageName = $_FILES['image']['name'];
    // اسم الصورة

    $imagePath = $imageName;

    // رفع الصورة على السيرفر داخل فولدر uploads
    move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$imageName);
}

// ===== لو فيه ID → يبقى تعديل منتج =====
if($id){

    // ===== لو فيه صورة جديدة =====
    if($imagePath){

        $stmt = $conn->prepare("
            UPDATE products 
            SET name=?, description=?, price=?, stock_quantity=?, category_id=?, image=? 
            WHERE product_id=?
        ");

        $stmt->bind_param("ssdiisi",$name,$desc,$price,$stock,$category,$imagePath,$id);

    } else {

        // ===== تعديل بدون تغيير الصورة =====
        $stmt = $conn->prepare("
            UPDATE products 
            SET name=?, description=?, price=?, stock_quantity=?, category_id=? 
            WHERE product_id=?
        ");

        $stmt->bind_param("ssdiii",$name,$desc,$price,$stock,$category,$id);
    }

    $stmt->execute();

    echo json_encode([
        'success'=>true,
        'message'=>'Product updated successfully'
    ]);

} else {

    // ===== إضافة منتج جديد =====
    $stmt = $conn->prepare("
        INSERT INTO products(name,description,price,stock_quantity,category_id,image) 
        VALUES(?,?,?,?,?,?)
    ");

    $stmt->bind_param("ssdiss",$name,$desc,$price,$stock,$category,$imagePath);

    $stmt->execute();

    echo json_encode([
        'success'=>true,
        'message'=>'Product added successfully'
    ]);
}
?>