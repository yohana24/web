<?php
session_start();
include 'db.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if(empty($email) || empty($password)){
    echo json_encode(['success'=>false, 'message'=>"Please fill all fields"]);
    exit;
}

// منع SQL Injection
$stmt = $conn->prepare("SELECT user_id, name, password, role FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 1){
    $user = $result->fetch_assoc();
    
    if(password_verify($password, $user['password'])){
        // حفظ بيانات الجلسة
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        // ارجع JSON مع النجاح والدور
        echo json_encode(['success'=>true, 'role'=>$user['role']]);
    } else {
        echo json_encode(['success'=>false, 'message'=>"Wrong password"]);
    }

} else {
    echo json_encode(['success'=>false, 'message'=>"Email not registered"]);
}
?>
