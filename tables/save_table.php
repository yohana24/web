<?php
session_start();
include '../db.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role']!=='admin'){
    echo json_encode(['success'=>false,'message'=>'Access denied']);
    exit;
}

$id = $_POST['table_id'] ?? '';
$number = $_POST['table_number'] ?? '';
$status = $_POST['status'] ?? '';

if(!$number || !$status){
    echo json_encode(['success'=>false,'message'=>'Please fill all fields']);
    exit;
}

if($id){
    $stmt = $conn->prepare("UPDATE tables SET table_number=?, status=? WHERE table_id=?");
    $stmt->bind_param("isi",$number,$status,$id);
    $stmt->execute();
    echo json_encode(['success'=>true,'message'=>'Table updated']);
} else {
    $stmt = $conn->prepare("INSERT INTO tables(table_number,status) VALUES(?,?)");
    $stmt->bind_param("is",$number,$status);
    $stmt->execute();
    echo json_encode(['success'=>true,'message'=>'Table added']);
}