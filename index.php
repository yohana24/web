<?php
// ===== نبدأ الجلسة =====
session_start();
if(isset($_GET['table_id'])){
    $_SESSION['table_id'] = intval($_GET['table_id']);
}
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
                    <input type="email" placeholder="Email" name="email" required>
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
                    <input type="email" name="email" placeholder="Email" required>
                    <!--  الباس -->
                    <input type="password" name="password" placeholder="Password" required>
                    <!-- تأكيد  الباس -->
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    <select name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <input type="number" name="age" placeholder="Age" required>
                    <select name="institute" id="institute" required>
                        <option value="commerce">Commerce</option>
                        <option value="engineering">Engineering</option>
                    </select>
                    <select name="department" id="department">
                        <option value="electronics">Electronics</option>
                        <option value="architecture">Architecture</option>
                        <option value="civil">Civil</option>
                    </select>
                    <!-- زرار التسجيل -->
                    <input type="submit" value="Sign Up">
                </form>
                <!-- رسالة لو فى غلط ربنا ميجبش غلط :) -->
                <div id="signupError" class="error"></div>
            </div>

        </div>
    </div>

    <!-- ===== جافاسكربت ===== -->
         <script>
<?php if(isset($_SESSION['table_id'])): ?>
    sessionStorage.setItem('table_id', "<?php echo $_SESSION['table_id']; ?>");
<?php endif; ?>
</script>
    <script src="login.js"></script>

</body>
</html>