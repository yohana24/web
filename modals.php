<!-- Users Modal -->
<div id="userModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeUserModal()">&times;</span>
    <h3 id="userModalTitle">Add User</h3>
    <form id="userForm">
      <input type="hidden" id="user_id" name="user_id">
      <label>Name:</label><input type="text" id="user_name" name="name" required>
      <label>Email:</label><input type="email" id="user_email" name="email" required>
      <label>Password:</label><input type="password" id="user_password" name="password">
      <label>Role:</label>
      <select id="user_role" name="role">
        <option value="admin">Admin</option>
        <option value="staff">Staff</option>
        <option value="customer">Customer</option>
      </select>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
</div>

<!-- Tables Modal -->
<div id="tableModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeTableModal()">&times;</span>
    <h3 id="tableModalTitle">Add Table</h3>
    <form id="tableForm">
      <input type="hidden" id="table_id" name="table_id">
      <label>Table Number:</label><input type="number" id="table_number" name="table_number" required>
      <label>Status:</label>
      <select id="table_status" name="status">
        <option value="available">Available</option>
        <option value="occupied">Occupied</option>
      </select>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
</div>

<!-- Products Modal -->
<div id="productModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeProductModal()">&times;</span>
    <h3 id="productModalTitle">Add Product</h3>
    <form id="productForm" enctype="multipart/form-data">
      <input type="hidden" id="product_id" name="product_id">
      <label>Name:</label><input type="text" id="product_name" name="name" required>
      <label>Description:</label><input type="text" id="product_description" name="description" required>
      <label>Price:</label><input type="number" id="product_price" name="price" step="0.01" required>
      <label>Stock Quantity:</label><input type="number" id="product_stock" name="stock_quantity" required>
      <label>Category ID:</label><input type="number" id="product_category" name="category_id" required>
      <label>Image:</label><input type="file" id="product_image" name="image">
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
</div>
<!-- Flavors Modal -->

<div id="flavorModal" class="modal">

<div class="modal-content">

<span class="close" onclick="closeFlavorModal()">&times;</span>

<h3>Manage Flavors</h3>

<input type="hidden" id="flavor_product_id" name="product_id">

<form id="flavorForm" enctype="multipart/form-data">

<label>Flavor Name</label>
<input type="text" name="flavor_name" required>

<label>Price</label>
<input type="number" name="price" step="0.01" required>

<label>Stock</label>
<input type="number" name="stock_quantity" required>

<label>Image</label>
<input type="file" name="image">

<button type="submit" class="btn btn-primary">
Add Flavor
</button>

</form>

<div id="flavorsList"></div>

</div>

</div>
<style>
.modal { display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); place-items:center; z-index:1000; }
.modal-content { background:#222; padding:20px; border-radius:10px; width:400px; display:flex; flex-direction:column; gap:10px; color:#fff; }
.modal-content input, .modal-content select { width:100%; padding:8px; border-radius:5px; border:none; }
.modal-content label { font-weight:600; margin-top:5px; }
.modal-content .close { align-self:flex-end; cursor:pointer; font-size:20px; }
</style>