<?php
session_start(); // بدء الـ session علشان نقدر نمسحها

// تدمير كل بيانات المستخدم داخل الـ session (تسجيل خروج)
session_destroy();

// تحويل المستخدم لصفحة تسجيل الدخول بعد الخروج
header("Location: index.php");
exit; // إيقاف تنفيذ أي كود بعد التحويل
?>