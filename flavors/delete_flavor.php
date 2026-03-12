<?php
session_start();
include '../db.php';

$id = $_POST['flavor_id'];

$stmt = $conn->prepare("DELETE FROM flavors WHERE flavor_id=?");
$stmt->bind_param("i",$id);
$stmt->execute();

echo json_encode(['success'=>true]);