<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Orders</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="my_orders.css">
</head>
<body>
<!-- SCROLL PROGRESS  -->
<div id="progress">
      <span id="progress-value">&#x1F815;</span>
</div>


<div>
    <a href="products.php" class="btn btn-success">&larr; Back to Menu</a>
</div>

<h2>🛒 My Orders</h2>

<div id="ordersContainer" class="container"></div>

<!-- Popup Notification -->
<div id="order-popup"></div>

<script defer src="my_orders.js"></script>

</body>
</html>