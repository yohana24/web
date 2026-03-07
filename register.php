<?php
session_start();
include 'db.php';

$name = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';

if(!$name || !$email || !$password || !$confirm){
    echo json_encode(['success'=>false, 'message'=>"Please fill all fields"]);
    exit();
}

if($password !== $confirm){
    echo json_encode(['success'=>false, 'message'=>"Passwords do not match"]);
    exit();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("SELECT user_id FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    echo json_encode(['success'=>false, 'message'=>"Email already registered"]);
    exit();
}

// role افتراضي customer
$role = 'customer';
$stmt2 = $conn->prepare("INSERT INTO users (name,email,password,role) VALUES (?,?,?,?)");
$stmt2->bind_param("ssss", $name, $email, $hashed_password, $role);

if($stmt2->execute()){
    $_SESSION['user_id'] = $stmt2->insert_id;
    $_SESSION['user_name'] = $name;
    $_SESSION['role'] = $role;

    echo json_encode(['success'=>true, 'role'=>$role]);
} else {
    echo json_encode(['success'=>false, 'message'=>$conn->error]);
}
?>
