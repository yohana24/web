<?php
session_start();        

include 'db.php';   

// ============================
// بنجيب البيانات من الفورم
// ============================
$name  = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm  = $_POST['confirm_password'] ?? '';
$gender     = $_POST['gender'] ?? '';
$age        = $_POST['age'] ?? '';
$institute  = $_POST['institute'] ?? '';
$department = $_POST['department'] ?? '';

// ============================
// التأكد إن الخانات مش فاضية 
// ============================
if (!$name || !$email || !$password || !$confirm || !$gender || !$age || !$institute) {
    echo json_encode(['success'=>false, 'message'=>"Please fill all fields"]);
    exit();
}

// ============================
// التأكد إن الباس متطابق
// ============================
if ($password !== $confirm) {
    echo json_encode(['success'=>false, 'message'=>"Passwords do not match"]);
    exit();
}

// ============================
//  تشفير الباس قبل التخزين
// ============================
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// ============================
// التأكد إن الايميل مش مسجل قبل كده
// ============================
$stmt = $conn->prepare("SELECT user_id FROM users WHERE email=?");
$stmt->bind_param("s", $email); // بنحط الايميل بدل الـ ?
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(['success'=>false, 'message'=>"Email already registered"]);
    exit();
}

// ============================
// لو كل حاجة تمام، نسجل المستخدم
// ============================

// role افتراضي customer
$role = 'customer';
if($institute !== "engineering"){
    $department = NULL;
}
$stmt2 = $conn->prepare("INSERT INTO users (name,email,password,gender,age,institute,department,role)
VALUES (?,?,?,?,?,?,?,?)"); //بنجهز أمر SQL عشان ندخل بيانات مستخدم جديد في جدول users
$stmt2->bind_param("ssssisss",
$name,
$email,
$hashed_password,
$gender,
$age,
$institute,
$department,
$role
);          //هنا بنربط الـ placeholders اللي في الاستعلام بالمتغيرات الحقيقية.

if ($stmt2->execute()) {
    // بنخزن بيانات المستخدم فى الجلسة
    $_SESSION['user_id']   = $stmt2->insert_id;
    $_SESSION['user_name'] = $name;
    $_SESSION['role']      = $role;

    // بنرجع رسالة نجاح
    echo json_encode(['success'=>true, 'role'=>$role]);
} else {
    // لو فى مشكلة فى تسجيل المستخدم
    echo json_encode(['success'=>false, 'message'=>$conn->error]);
}
?>