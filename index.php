<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login / Sign Up</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Noto+Serif+Makasar&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="box signin">
            <h2>Already Have an Account?</h2>
            <button class="signinBtn">Sign in</button>
        </div>
        <div class="box signup">
            <h2>Don't Have an Account?</h2>
            <button class="signupBtn">Sign up</button>
        </div>

        <div class="formBx">
            <!-- Sign In Form -->
            <div class="form signinform">
                <form id="loginForm">
                    <h3>Sign In</h3>
                    <input type="text" placeholder="Email" name="email" required>
                    <input type="password" placeholder="Password" name="password" required>
                    <input type="submit" value="Login">
                </form>
                <div id="loginError" class="error"></div>
            </div>

            <!-- Sign Up Form -->
            <div class="form signupform">
                <form id="signupForm">
                    <h3>Sign Up</h3>
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="text" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    <input type="submit" value="Sign Up">
                </form>
                <div id="signupError" class="error"></div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="login.js"></script>
</body>
</html>
