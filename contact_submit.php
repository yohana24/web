<?php
session_start();
include 'db.php'; // تأكد من مسار db.php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $first = $_POST['firstName'] ?? '';
    $last = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    $stmt = $conn->prepare("INSERT INTO contact_messages (first_name, last_name, email, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first, $last, $email, $message);
    $stmt->execute();

    echo json_encode(['success' => true]);
}
?>