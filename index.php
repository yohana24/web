<?php
session_start();
include 'lang.php';

if(isset($_GET['table_id'])){
    $_SESSION['table_id'] = intval($_GET['table_id']);
}

include 'db.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo t('login_title'); ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="stylee.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Noto+Serif+Makasar&display=swap" rel="stylesheet">
</head>

<body>

<div class="container">

    <!-- ===== box login ===== -->
    <div class="box signin">
        <h2><?php echo t('signin_text'); ?></h2>
        <button class="signinBtn"><?php echo t('signin_btn'); ?></button>
    </div>

    <!-- ===== box signup ===== -->
    <div class="box signup">
        <h2><?php echo t('signup_text'); ?></h2>
        <button class="signupBtn"><?php echo t('signup_btn'); ?></button>
    </div>

    <div class="formBx">

        <!-- ===== LOGIN ===== -->
        <div class="form signinform">
            <form id="loginForm">
                <h3><?php echo t('signin_header'); ?></h3>

                <input type="email" placeholder="<?php echo t('email'); ?>" name="email" required>
                <input type="password" placeholder="<?php echo t('password'); ?>" name="password" required>

                <input type="submit" value="<?php echo t('login_btn'); ?>">
            </form>

            <div id="loginError" class="error"></div>
        </div>

        <!-- ===== SIGNUP ===== -->
        <div class="form signupform">
            <form id="signupForm">
                <h3><?php echo t('signup_header'); ?></h3>

                <input type="text" name="username" placeholder="<?php echo t('username'); ?>" required>
                <input type="email" name="email" placeholder="<?php echo t('email'); ?>" required>
                <input type="password" name="password" placeholder="<?php echo t('password'); ?>" required>
                <input type="password" name="confirm_password" placeholder="<?php echo t('confirm_password'); ?>" required>
                <input type="text" name="phone" placeholder="<?php echo t('phone'); ?>" required>
                <select name="gender" required>
                    <option value="male"><?php echo t('male'); ?></option>
                    <option value="female"><?php echo t('female'); ?></option>
                </select>

                <input type="number" name="age" placeholder="<?php echo t('age'); ?>" required>

                <select name="institute" required>
                    <option value="commerce">Commerce</option>
                    <option value="engineering">Engineering</option>
                </select>

                <select name="department">
                    <option value="electronics">Electronics</option>
                    <option value="architecture">Architecture</option>
                    <option value="civil">Civil</option>
                </select>

                <input type="submit" value="<?php echo t('signup_btn_submit'); ?>">
            </form>

            <div id="signupError" class="error"></div>
        </div>

    </div>

</div>

<!-- حفظ table -->
<script>
<?php if(isset($_SESSION['table_id'])): ?>
    sessionStorage.setItem('table_id', "<?php echo $_SESSION['table_id']; ?>");
<?php endif; ?>
</script>

<script src="login.js"></script>

</body>
</html>