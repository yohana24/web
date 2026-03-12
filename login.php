<?php
ini_set('session.gc_maxlifetime', 86400); // 24 ساعة
session_set_cookie_params(86400);
session_start();
include 'auth_check.php';

include 'db.php';
// ==== QR scan فقط ====
if(isset($_GET['table_id']) && empty($_POST)){
    $_SESSION['table_id'] = $_GET['table_id'];
    // Redirect مباشرة لصفحة تسجيل الدخول
    header("Location: index.php"); // صفحة الفورم
    exit;
}

// ===== نجيب البيانات اللي المستخدم دخلها من الفورم =====
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// ===== لو أي حقل فاضي نرجع رسالة خطأ ونوقف الكود =====
if(empty($email) || empty($password)){
    echo json_encode(['success'=>false, 'message'=>"Please fill all fields"]);
    exit;
}

// =====  SQL Injection =====   //ده طريقة اختراق انه ممكن يكتب oR,1=1,-- الحاجات ده تبقى اوامر sql و يخش منغير باسس او ايميل
//  بنجهز الاستعلام  اللي هى ؟ ونخلي مكان الايميل فاضي
$stmt = $conn->prepare("SELECT user_id, name, password, role FROM users WHERE email=?");
// وبنربط الايميل اللي المستخدم دخله بالمكان الفاضي s:string 
$stmt->bind_param("s", $email);
// ننفذ الاستعلام
$stmt->execute();
// نجيب النتيجة من قاعدة البيانات
$result = $stmt->get_result();

// ===== لو الايميل موجود في قاعدة البيانات =====
if($result->num_rows == 1){
    // نجيب بيانات المستخدم كلها
    $user = $result->fetch_assoc();
    
    // ===== نتحقق من الباسورد =====
    if(password_verify($password, $user['password'])){
        // لو صح، نخزن بيانات الجلسة عشان نعرف المستخدم مين
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        // نرجع JSON للـ JS فيه نجاح ودور المستخدم
        echo json_encode(['success'=>true, 'role'=>$user['role']]);
    } else {
        // لو الباسورد غلط
        echo json_encode(['success'=>false, 'message'=>"Wrong password"]);
    }

} else {
    // لو الايميل مش موجود أصلاً
    echo json_encode(['success'=>false, 'message'=>"Email not registered"]);
}
?>