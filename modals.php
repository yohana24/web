<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- ================= USERS MODAL ================= -->
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


<!-- ================= TABLE MODAL ================= -->
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
        <option value="available"><?= t('available') ?? 'Available' ?></option>
        <option value="occupied"><?= t('occupied') ?? 'Occupied' ?></option>
      </select>

      <button type="submit"><?= t('save') ?></button>
    </form>

  </div>
</div>


<!-- ================= PRODUCT MODAL ================= -->
<div id="productModal" class="modal">
  <div class="modal-content">

    <span class="close" onclick="closeProductModal()">&times;</span>

    <h3 id="productModalTitle"><?= t('add_product') ?></h3>

    <form id="productForm" enctype="multipart/form-data">
      <input type="hidden" id="product_id" name="product_id">

      <label><?= t('name') ?></label>
      <input type="text" id="product_name" name="name" required>

      <label><?= t('price') ?></label>
      <input type="number" id="product_price" name="price" required>

      <label><?= t('description') ?></label>
      <input type="text" id="product_description" name="description">

      <button type="submit"><?= t('save') ?></button>
    </form>

  </div>
</div>


<!-- ================= FLAVOR MODAL (FIXED - ONE VERSION ONLY) ================= -->
<div id="flavorModal" class="modal">
  <div class="modal-content">

    <span class="close" onclick="closeFlavorModal()">&times;</span>

    <h3 id="flavorModalTitle"><?= t('flavors') ?></h3>

    <form id="flavorForm" enctype="multipart/form-data">

      <input type="hidden" id="flavor_id" name="flavor_id">
      <input type="hidden" id="flavor_product_id" name="product_id">

      <label><?= t('flavor_name') ?></label>
      <input type="text" id="flavor_name" name="flavor_name" required>

      <label><?= t('price') ?></label>
      <input type="number" id="flavor_price" name="price" required>

      <label><?= t('stock') ?></label>
      <input type="number" id="flavor_stock_quantity" name="stock_quantity" required>

      <label><?= t('image') ?></label>
      <input type="file" name="image">

      <button type="submit"><?= t('save') ?></button>
    </form>

    <!-- مهم: دول جوه المودال -->
    <div id="flavorsList"></div>
    <div id="flavorDropdownContainer"></div>

  </div>
</div>