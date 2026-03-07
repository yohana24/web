<?php
session_start();
include 'db.php';
header('Content-Type: application/json');

$user_id = $_SESSION['user_id'] ?? null;
if(!$user_id){
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("
    SELECT * FROM notifications
    WHERE user_id=? AND is_read=0
    ORDER BY created_at DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
$notifications = [];

while($row = $result->fetch_assoc()){
    $notifications[] = $row;
}

echo json_encode($notifications);
?>