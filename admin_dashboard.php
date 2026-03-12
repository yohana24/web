<?php
session_start();
include 'db.php';
include 'auth_check.php';

unset($_SESSION['table_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">
<link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <h2>Admin</h2>
        <a href="#" class="active" data-tab="orders">Orders</a>
        <a href="#" data-tab="tables">Tables</a>
        <a href="#" data-tab="products">Products</a>
        <a href="#" data-tab="users">Users</a>
        <a href="#" data-tab="reports">Reports</a>
    </div>

    <div class="main-area">
        <div class="topbar">
            <span>Admin: <?php echo $_SESSION['user_name']; ?></span>
            <a href="index.php" class="logout-btn">Logout</a>
        </div>
        <div class="main-content">
            <div id="orders" class="tab-content active"></div>
            <div id="tables" class="tab-content"></div>
            <div id="products" class="tab-content"></div>
            <div id="users" class="tab-content"></div>
            <div id="reports" class="tab-content"></div>
        </div>
    </div>
</div>
<!-- مودال Flavors -->
<div id="flavorModal" style="display:none;">
  <form id="flavorForm" enctype="multipart/form-data">
    <input type="hidden" id="flavor_id" name="flavor_id">
    <input type="hidden" id="flavor_product_id" name="product_id">
    
    <label>Name</label>
    <input type="text" id="flavor_name" name="flavor_name" required>
    
    <label>Price</label>
    <input type="number" id="flavor_price" name="price" required>
    
    <label>Stock</label>
    <input type="number" id="flavor_stock_quantity" name="stock_quantity" required>
    
    <label>Image</label>
    <input type="file" name="image">
    
    <button type="submit">Save</button>
    <button type="button" onclick="closeFlavorModal()">Cancel</button>
  </form>
</div>

<!-- مكان جدول الـ Flavors -->
<div id="flavorsList"></div>

<!-- مكان Dropdown -->
<div id="flavorDropdownContainer"></div>
<?php include 'modals.php'; ?>
<script src="admin_dashboard.js"></script>
</body>
</html>