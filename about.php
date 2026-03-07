<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About Us</title>

<link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">
<link rel="stylesheet" href="about.css">

</head>
<body>

<!-- SCROLL PROGRESS  -->
<div id="progress">
      <span id="progress-value">&#x1F815;</span>
</div>


<div class="container">
    <div class="about-card">

        <h1>About Us</h1>

        <h3>Who We Are</h3>

        <p>
            Welcome to our cafeteria system.  
            This platform was designed to provide a simple, fast, and smooth ordering experience.
        </p>

        <p>
            Our goal is to create a modern environment where customers can easily place orders
            and staff can efficiently manage them.
        </p>

        <h3>Our Vision</h3>

        <p>
            To build a smart and organized ordering system that improves workflow
            and enhances customer satisfaction.
        </p>

        <!-- ===== Team Section ===== -->

        <h3>Our Team</h3>

        <p>
            This project was developed by a team of eight students as part of our academic coursework.  
            Each member contributed to the design, implementation, and testing of the system, reflecting a collaborative effort and shared learning experience.  
            We are proud to present this project as a product of our teamwork and creativity.
        </p>

        <div class="team-list">
            <span>Abdelrhman Fawzy</span>
            <span>Ahmed Mohamed Krawyia</span>
            <span>Mohamed Alaa</span>
            <span>Omar Sherif El-Tabarany</span>
            <span>Rana Seddawy</span>
            <span>Salma Salama</span>
            <span>Yehia Mohamed Atout</span>
            <span>Yohana Ashraf Fayez</span>
        </div>

        <a href="products.php" class="btn">Back Menu</a>

    </div>
</div>

<script>
    let calcScrollValue = () => {
        let scrollProgress = document.getElementById("progress");
        let progressValue = document.getElementById("progress-value");
        let pos = document.documentElement.scrollTop;
        let calcHeight =
            document.documentElement.scrollHeight -
            document.documentElement.clientHeight;
        let scrollValue = Math.round((pos * 100) / calcHeight);
        if (pos > 100) {
            scrollProgress.style.display = "grid";
        } else {
            scrollProgress.style.display = "none";
        }
        scrollProgress.addEventListener("click", () => {
            document.documentElement.scrollTop = 0;
        });
        scrollProgress.style.background = `conic-gradient(#333 ${scrollValue}%, #d7d7d7 ${scrollValue}%)`;
};

window.onscroll = calcScrollValue;
window.onload = calcScrollValue;
</script>
</body>
</html>