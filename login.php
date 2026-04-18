<?php
ini_set('session.gc_maxlifetime', 86400); // 24 ساعة
session_set_cookie_params(86400);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'auth_check.php';
include 'db.php';

// ==== QR scan فقط ====
if(isset($_GET['table_id']) && empty($_POST)){
    $_SESSION['table_id'] = intval($_GET['table_id']);
    header("Location: index.php");
    exit;
}

// ===== نجيب البيانات =====
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// ===== لو فاضي =====
if(empty($email) || empty($password)){
    echo json_encode(['success'=>false, 'message'=>"Please fill all fields"]);
    exit;
}

// ===== SQL =====
$stmt = $conn->prepare("SELECT user_id, name, password, role FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// ===== لو لقى المستخدم =====
if($result->num_rows == 1){

    $user = $result->fetch_assoc();

    // ===== تحقق الباسورد =====
    if(password_verify($password, $user['password'])){

        // ===== هنا التعديل المهم فقط =====
        $role = strtolower(trim($user['role']));

        // 🔥 تحويل customer إلى user عشان النظام كله يفهمه
        if($role === 'customer'){
            $role = 'user';
        }

        // حفظ السيشن
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $role;

        echo json_encode([
            'success' => true,
            'role' => $role
        ]);

    } else {
        echo json_encode(['success'=>false, 'message'=>"Wrong password"]);
    }

} else {
    echo json_encode(['success'=>false, 'message'=>"Email not registered"]);
}
?>