<?php
session_start();
include '../db.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role']!=='admin'){
    echo json_encode(['success'=>false,'message'=>'Access denied']);
    exit;
}

$id = $_POST['table_id'] ?? '';
if($id){
    $stmt = $conn->prepare("DELETE FROM tables WHERE table_id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    echo json_encode(['success'=>true,'message'=>'Table deleted']);
} else {
    echo json_encode(['success'=>false,'message'=>'Invalid ID']);
}