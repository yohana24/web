<?php
session_start();
include 'lang.php';

// هل المستخدم مسجل ولا لا
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.1/fonts/remixicon.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="home.css">

    <title><?php echo t('title'); ?></title>
</head>

<body>

<section class="all">

    <!-- ===== الجزء الشمال ===== -->
    <div class="left">

        <h1 class="title"><?php echo t('title'); ?></h1>

        <p class="desc">
            <?php echo t('desc'); ?>
        </p>

        <!-- ===== زرار order ===== -->
        <div class="under">
            <a href="index.php" onclick="checkLogin('menu')" class="neon">

                <span></span>
                <span></span>
                <span></span>
                <span></span>

                <?php echo t('login'); ?>

            </a>
        </div>

    </div>

    <!-- ===== الجزء اليمين ===== -->
    <div class="right">

        <div class="neon-frame">

            <img src="burger.png" class="food active" alt="burger">
            <img src="juice.png" class="food" alt="juice">
            <img src="pizza.png" class="food" alt="pizza">
            <img src="potato.png" class="food" alt="potato">
            <img src="coffee.png" class="food" alt="coffee">

        </div>

    </div>

</section>

<!-- JS -->
<script defer src="home.js"></script>

</body>
</html>