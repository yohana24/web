<?php
session_start();
include 'db.php';
include 'auth_check.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Staff Orders</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
<link rel = "stylesheet" href="staff_orders.css">
</head>
<body>

<!-- SCROLL PROGRESS  -->
<div id="progress">
      <span id="progress-value">&#x1F815;</span>
</div>


<h2>📋 Staff Orders Panel</h2>
<div id="ordersContainer"></div>

<script defer src="staff_orders.js"></script>



</body>
</html>