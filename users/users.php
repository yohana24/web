<?php
session_start();
include '../auth_check.php';
include '../db.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role']!=='admin'){
    http_response_code(403);
    echo json_encode(['error'=>'Access denied']);
    exit;
}
header('Content-Type: application/json');

$result = $conn->query("SELECT user_id AS id, name, email, role FROM users ORDER BY user_id DESC");
$users = [];
while($row = $result->fetch_assoc()){
    $users[] = $row;
}
echo json_encode($users);