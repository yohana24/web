<!DOCTYPE html>
<html lang="en">
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

    <!-- title-->
        <title>Neon Cafeteria</title>
</head>
<body>
<section class="all">
    <header>
        <div class="container">
            <nav>
                    <!-- ===== navbar ===== -->
                <div class="logo">Everything Under Control</div>
                    <ul class="nav-links">
                        <li><a href="home.php">Home</a></li>
                        <li><a href="products.php">Menu</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="Contact Us.php">Contact</a></li>
                        <li><a href="my_orders.php">My Orders</a></li>
                        <!-- ===== logout ===== -->
                        <li class="li"><a href="index.php">LOGOUT</a></li>
                    </ul>
                    <!-- ===== search ===== -->
                <div class="search">
                    <div class="search_icon"><i class="ri-search-line"></i></div>
                    <input type="text" class="search_input" placeholder="Search">
                </div>
                <!-- ===== cart ===== -->
                <div class="cart" onclick="toggleCart()">
                    <i class="ri-shopping-basket-2-line"></i>
                    <span id="cartCount">0</span>
                </div>
            </nav>
        </div>
    </header>
    <!-- ===== text neon left side===== -->
    <div class="left">
        <h1 class="title">THE NAME</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum eos inventore earum qui, animi ipsum ipsa esse laudantium possimus molestias quos natus? Corporis vitae cumque modi impedit. Eum, magnam natus.</p>
        <!-- ===== button Order now neon ===== -->
        <div class="under">
            <a href="products.php" class="neon">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Order Now
            </a>
        </div>
    </div>
    <!-- ===== images neon right side ===== -->
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
<!-- ===== javascript ===== -->
<script defer src="home.js"></script>
</body>
</html>