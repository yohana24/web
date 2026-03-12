<?php
session_start();
include '../db.php';
include '../auth_check.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role']!=='admin'){
    echo json_encode([]);
    exit;
}

$result = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");

$data = [];
while($row = $result->fetch_assoc()){
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>