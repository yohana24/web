<?php
// ===== معلومات الاتصال بقاعدة البيانات =====
$host = "localhost";   // اسم السيرفر
$user = "root";        // اسم المستخدم
$password = "";        // الباس (لو موجود)
$dbname = "cafeteria"; // اسم قاعدة البيانات بتاعتنا

// =====  اتصال بقاعدة البيانات =====
$conn = new mysqli($host, $user, $password, $dbname);

// =====  لو حصل خطأ في الاتصال  بس احنا مبنغلطش XD=====
if($conn->connect_error){
    // هنا بيوقف السكريبت ويطبع رسالة الخطأ
    die("Connection failed: " . $conn->connect_error);
}

// دلوقتي $conn ده هيتستخدم في أي صفحة محتاجة تتعامل مع قاعدة البيانات
?>