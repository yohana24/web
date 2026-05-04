<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

include 'db.php';
include 'auth_check.php';
include 'lang.php';

unset($_SESSION['table_id']);
?>

<!DOCTYPE html>
<html lang="<?= $_SESSION['lang'] ?? 'en' ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= t('admin_dashboard') ?></title>

<link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">
<link rel="stylesheet" href="admin_dashboard.css">
</head>

<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2><?= t('admin') ?></h2>

        <a href="#" class="active" data-tab="orders"><?= t('orders') ?></a>
        <a href="#" data-tab="tables"><?= t('tables') ?></a>
        <a href="#" data-tab="products"><?= t('products') ?></a>
        <a href="#" data-tab="users"><?= t('users') ?></a>
        <a href="#" data-tab="reports"><?= t('messages') ?></a>
        <a href="#" data-tab="analytics"><?= t('analytics') ?></a>
    </div>

    <!-- MAIN AREA -->
    <div class="main-area">

        <div class="topbar">
            <span><?= t('admin') ?>: <?= htmlspecialchars($_SESSION['user_name']) ?></span>
            <a href="welcome.php" class="logout-btn"><?= t('logout') ?></a>
        </div>

        <div class="main-content">

            <div id="orders" class="tab-content active"></div>
            <div id="tables" class="tab-content"></div>
            <div id="products" class="tab-content"></div>
            <div id="users" class="tab-content"></div>
            <div id="reports" class="tab-content"></div>

            <!-- ANALYTICS -->
            <div id="analytics" class="tab-content">

                <iframe 
                    src="https://app.powerbi.com/view?r=eyJrIjoiM2NkMTNjY2UtMzFlOC00YjYxLTliYzgtNWEzZDlkN2VmODU2IiwidCI6IjI1Y2UwMjYxLWJiZDYtNDljZC1hMWUyLTU0MjYwODg2ZDE1OSJ9"
                    width="100%"
                    height="600"
                    style="border:none;">
                </iframe>

                <div class="export-box">
                    <label><?= t('from') ?>:</label>
                    <input type="date" id="from_date">

                    <label><?= t('to') ?>:</label>
                    <input type="date" id="to_date">

                    <button onclick="exportExcel()"><?= t('export_excel') ?></button>
                    <button onclick="exportPDF()"><?= t('export_pdf') ?></button>
                </div>

                <div class="backup-box">
                    <h3><?= t('backup_system') ?></h3>

                    <button onclick="window.open('backup.php?type=daily')">
                        <?= t('daily_backup') ?>
                    </button>

                    <button onclick="window.open('backup.php?type=monthly')">
                        <?= t('monthly_backup') ?>
                    </button>

                    <button onclick="window.open('backup.php?type=yearly')">
                        <?= t('yearly_backup') ?>
                    </button>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- ================= MODALS ================= -->

<!-- USER MODAL -->
<div id="userModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeUserModal()">&times;</span>

    <h3 id="userModalTitle"><?= t('add_user') ?></h3>

    <form id="userForm">
      <input type="hidden" id="user_id" name="user_id">

      <label><?= t('name') ?></label>
      <input type="text" id="user_name" name="name" required>

      <label><?= t('email') ?></label>
      <input type="email" id="user_email" name="email" required>

      <label><?= t('password') ?></label>
      <input type="password" id="user_password" name="password">

      <label><?= t('role') ?></label>
      <select id="user_role" name="role">
        <option value="admin">Admin</option>
        <option value="staff">Staff</option>
        <option value="customer">Customer</option>
      </select>

      <button type="submit"><?= t('save') ?></button>
    </form>
  </div>
</div>

<!-- TABLE MODAL -->
<div id="tableModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeTableModal()">&times;</span>

<h3 id="tableModalTitle"><?= t('add_table') ?></h3>
    <form id="tableForm">
      <input type="hidden" id="table_id" name="table_id">

      <label><?= t('table_number') ?></label>
      <input type="number" id="table_number" name="table_number" required>

      <label><?= t('status') ?></label>
      <select id="table_status" name="status">
        <option value="available">Available</option>
        <option value="occupied">Occupied</option>
      </select>

      <button type="submit"><?= t('save') ?></button>
    </form>
  </div>
</div>

<!-- PRODUCT MODAL -->
<div id="productModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeProductModal()">&times;</span>

    <h3 id="productModalTitle"><?= t('add_product') ?></h3>

    <form id="productForm">
      <input type="hidden" id="product_id" name="product_id">

      <label><?= t('name') ?></label>
      <input type="text" id="product_name" name="name" required>

      <label><?= t('price') ?></label>
      <input type="number" id="product_price" name="price" required>

      <label>Description</label>
      <input type="text" id="product_description" name="description">

      <label>Stock</label>
      <input type="number" id="product_stock" name="stock_quantity">

      <label>Category</label>
      <input type="text" id="product_category" name="category_id">

      <button type="submit"><?= t('save') ?></button>
    </form>
  </div>
</div>

<!-- FLAVOR MODAL (ONE ONLY) -->
<div id="flavorModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeFlavorModal()">&times;</span>

    <h3 id="flavorModalTitle"><?= t('flavors') ?></h3>

    <input type="hidden" id="flavor_id" name="flavor_id">
<input type="hidden" id="flavor_product_id" name="product_id">

    <form id="flavorForm" enctype="multipart/form-data">

  <label><?= t('flavor_name') ?></label>
  <input type="text" id="flavor_name" name="flavor_name" required>

  <label><?= t('price') ?></label>
  <input type="number" id="flavor_price" name="flavor_price" required>

  <label><?= t('stock') ?></label>
  <input type="number" id="flavor_stock_quantity" name="flavor_stock_quantity" required>

  <label><?= t('image') ?></label>
  <input type="file" name="image">

  <button type="submit"><?= t('save') ?></button>
</form>

    <div id="flavorsList"></div>
    <div id="flavorDropdownContainer"></div>

  </div>
</div>

<!-- SCRIPTS -->
<script>
let LANG = "<?= $_SESSION['lang'] ?? 'en' ?>";
</script>

<script src="admin_dashboard.js"></script>

</body>
</html>