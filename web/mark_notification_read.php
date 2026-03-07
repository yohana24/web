<?php
session_start();
include 'db.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$id = $input['id'] ?? null;

if($id){
    $stmt = $conn->prepare("UPDATE notifications SET is_read=1 WHERE notification_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

echo json_encode(['success'=>true]);
?>