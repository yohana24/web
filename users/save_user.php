<?php
session_start(); 
// تشغيل السيشن عشان نعرف المستخدم الحالي وصلاحياته

include '../db.php'; 
// الاتصال بقاعدة البيانات

// ===== التأكد إن المستخدم Admin فقط =====
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    echo json_encode([
        'success'=>false,
        'message'=>'Access denied'
    ]);
    // منع أي حد غير admin من إضافة أو تعديل المستخدمين
    exit;
}

// ===== جلب البيانات من الفورم =====
$user_id = $_POST['user_id'] ?? '';
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

// ===== التأكد إن البيانات الأساسية موجودة =====
if(!$name || !$email || !$role){
    echo json_encode([
        'success'=>false,
        'message'=>'Please fill all fields'
    ]);
    exit;
}

// ===== لو فيه user_id → تعديل مستخدم =====
if($user_id){

    // ===== لو فيه باسورد جديد =====
    if($password){

        // تشفير الباسورد قبل التخزين
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("
            UPDATE users 
            SET name=?, email=?, role=?, password=? 
            WHERE user_id=?
        ");

        $stmt->bind_param("ssssi", $name, $email, $role, $hash, $user_id);

    } else {

        // ===== تعديل بدون تغيير الباسورد =====
        $stmt = $conn->prepare("
            UPDATE users 
            SET name=?, email=?, role=? 
            WHERE user_id=?
        ");

        $stmt->bind_param("sssi", $name, $email, $role, $user_id);
    }

    $stmt->execute();

    echo json_encode([
        'success'=>true,
        'message'=>'User updated'
    ]);

} else {

    // ===== إضافة مستخدم جديد =====

    // تشفير الباسورد
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("
        INSERT INTO users(name,email,password,role) 
        VALUES(?,?,?,?)
    ");

    $stmt->bind_param("ssss", $name, $email, $hash, $role);

    $stmt->execute();

    echo json_encode([
        'success'=>true,
        'message'=>'User added'
    ]);
}
?>