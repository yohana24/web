<?php
session_start();
include '../db.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role']!=='admin'){
    echo json_encode(['success'=>false,'message'=>'Access denied']);
    exit;
}

$user_id = $_POST['user_id'] ?? '';
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

if(!$name || !$email || !$role){
    echo json_encode(['success'=>false,'message'=>'Please fill all fields']);
    exit;
}

if($user_id){ // تعديل
    if($password){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET name=?, email=?, role=?, password=? WHERE user_id=?");
        $stmt->bind_param("ssssi", $name, $email, $role, $hash, $user_id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET name=?, email=?, role=? WHERE user_id=?");
        $stmt->bind_param("sssi", $name, $email, $role, $user_id);
    }
    $stmt->execute();
    echo json_encode(['success'=>true,'message'=>'User updated']);
} else { // إضافة
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,?)");
    $stmt->bind_param("ssss",$name,$email,$hash,$role);
    $stmt->execute();
    echo json_encode(['success'=>true,'message'=>'User added']);
}