<?php
// ===== نبدأ الجلسة =====
session_start();

// ===== علشان نوصل لقاعدة البيانات  =====
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول / تسجيل حساب جديد</title>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="stylee.css">

    <!-- ===== Google Fonts ===== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Noto+Serif+Makasar&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">

        <!-- ===== الصندوق اللي حواه تسجيل الدخول ===== -->
        <div class="box signin">
            <h2>Already Have an Account?</h2>
            <button class="signinBtn">Sign in</button>
        </div>

        <div class="box signup">
            <h2>Don't Have an Account?</h2>
            <button class="signupBtn">Sign up</button>
        </div>

        <div class="formBx">

            <!-- ===== فورم تسجيل الدخول ===== -->
            <div class="form signinform">
                <form id="loginForm">
                    <h3>Sign In</h3>
                    <!-- الإميل -->
                    <input type="text" placeholder="Email" name="email" required>
                    <!-- الباس-->
                    <input type="password" placeholder="Password" name="password" required>
                    <!-- زرار تسجل الدخول -->
                    <input type="submit" value="Login">
                </form>
                <!-- رسالة لو فى غلط ربنا ميجبش غلط :) -->
                <div id="loginError" class="error"></div>
            </div>

            <!-- ===== فورم تسجيل حساب جديد ===== -->
            <div class="form signupform">
                <form id="signupForm">
                    <h3>Sign Up</h3>
                    <!-- اليوزر -->
                    <input type="text" name="username" placeholder="Username" required>
                    <!-- الإيميل -->
                    <input type="text" name="email" placeholder="Email" required>
                    <!--  الباس -->
                    <input type="password" name="password" placeholder="Password" required>
                    <!-- تأكيد  الباس -->
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    <!-- زرار التسجيل -->
                    <input type="submit" value="Sign Up">
                </form>
                <!-- رسالة لو فى غلط ربنا ميجبش غلط :) -->
                <div id="signupError" class="error"></div>
            </div>

        </div>
    </div>

    <!-- ===== جافاسكربت ===== -->
    <script src="login.js"></script>
</body>
</html>