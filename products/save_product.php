<?php
session_start();
include '../db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role']!=='admin'){
    echo json_encode(['success'=>false,'message'=>'Access denied']);
    exit;
}

$id = $_POST['product_id'] ?? '';
$name = $_POST['name'] ?? '';
$desc = $_POST['description'] ?? '';
$price = $_POST['price'] ?? 0;
$stock = $_POST['stock_quantity'] ?? 0;
$category = $_POST['category_id'] ?? '';

$imagePath = '';

if(isset($_FILES['image']) && $_FILES['image']['name']){
    $imageName = $_FILES['image']['name'];
    $imagePath = $imageName;
    move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$imageName);
}

if($id){ // تعديل
    if($imagePath){
        $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, stock_quantity=?, category_id=?, image=? WHERE product_id=?");
        $stmt->bind_param("ssdiisi",$name,$desc,$price,$stock,$category,$imagePath,$id);
    } else {
        $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, stock_quantity=?, category_id=? WHERE product_id=?");
        $stmt->bind_param("ssdiii",$name,$desc,$price,$stock,$category,$id);
    }
    $stmt->execute();
    echo json_encode(['success'=>true,'message'=>'Product updated successfully']);
} else { // إضافة
    $stmt = $conn->prepare("INSERT INTO products(name,description,price,stock_quantity,category_id,image) VALUES(?,?,?,?,?,?)");
    $stmt->bind_param("ssdiss",$name,$desc,$price,$stock,$category,$imagePath);
    $stmt->execute();
    echo json_encode(['success'=>true,'message'=>'Product added successfully']);
}