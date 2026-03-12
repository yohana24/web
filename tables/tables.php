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

$result = $conn->query("SELECT table_id AS id, table_number, status FROM tables ORDER BY table_id DESC");
$tables = [];
while($row = $result->fetch_assoc()){
    $tables[] = $row;
}
echo json_encode($tables);