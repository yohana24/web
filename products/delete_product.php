<?php
session_start();
include '../db.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role']!=='admin'){
    echo json_encode(['success'=>false,'message'=>'Access denied']);
    exit;
}

$id = $_POST['product_id'] ?? '';
if($id){
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    echo json_encode(['success'=>true,'message'=>'Product deleted']);
} else {
    echo json_encode(['success'=>false,'message'=>'Invalid ID']);
}