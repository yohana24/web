<?php
// بنأكد إن الـ session مش شغالة قبل ما نبدأها
// عشان نتجنب خطأ إعادة تشغيل الـ session أكتر من مرة
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // بدء الـ session لو مش شغال
}
?>