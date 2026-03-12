document.addEventListener('DOMContentLoaded', () => {
    loadOrders(); // التحميل الأولي للطلبات
});

// ===== Tab Switching =====
document.querySelectorAll('.sidebar a').forEach(link => {
    link.addEventListener('click', function(e){
        e.preventDefault();
        document.querySelectorAll('.sidebar a').forEach(l => l.classList.remove('active'));
        this.classList.add('active');

        let tab = this.getAttribute('data-tab');
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        document.getElementById(tab).classList.add('active');

        if(tab==='orders') loadOrders();
        else if(tab==='tables') loadTables();
        else if(tab==='products') loadProducts();
        else if(tab==='users') loadUsers();
        else if(tab==='reports') loadReports();
    });
});

// ===== Load Orders =====
function loadOrders(){
    fetch('orders/orders.php')
    .then(res => res.json())
    .then(data => {
        if(data.length === 0){
            document.getElementById('orders').innerHTML = "<p>No orders yet...</p>";
            return;
        }
        let html = `
        <table>
        <tr>
            <th>ID</th>
            <th>Order Number</th>
            <th>User</th>
            <th>Table</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
            <th>Items</th>
        </tr>
        `;
        data.forEach(o => {
            html += `
            <tr>
                <td>${o.order_id}</td>
                <td>${o.order_number}</td>
                <td>${o.user_name}</td>
                <td>${o.table_number ? o.table_number : '-'}</td>
                <td>${o.total_amount}</td>
                <td>${o.status}</td>
                <td>${o.created_at}</td>
                <td class="items">${o.items.map(i => `${i.product_name} (${i.quantity})`).join(", ")}</td>
            </tr>
            `;
        });
        html += "</table>";
        document.getElementById('orders').innerHTML = html;
    });
}

// ===== Load Users =====
function loadUsers(){
    fetch('users/users.php')
    .then(res => res.json())
    .then(data => {
        let html = `<button class="btn btn-primary" onclick="openUserModal()">Add User</button>
        <table>
            <tr><th>#</th><th>Name</th><th>Email</th><th>Role</th><th>Action</th></tr>`;
        data.forEach(u => {
            html += `<tr>
                <td>${u.id}</td>
                <td>${u.name}</td>
                <td>${u.email}</td>
                <td>${u.role}</td>
                <td>
                    <button class="btn btn-primary" onclick="openUserModal(${u.id}, '${encodeURIComponent(u.name)}', '${encodeURIComponent(u.email)}', '${u.role}', '********')">Edit</button>
                    <button class="btn btn-danger" onclick="deleteUser(${u.id})">Delete</button>
                </td>
            </tr>`;
        });
        html += '</table>';
        document.getElementById('users').innerHTML = html;
    });
}

// ===== Users Modal =====
function openUserModal(id='', name='', email='', role='customer', password=''){
    document.getElementById('user_id').value = id;
    document.getElementById('user_name').value = decodeURIComponent(name);
    document.getElementById('user_email').value = decodeURIComponent(email);
    document.getElementById('user_password').value = password;
    document.getElementById('user_role').value = role;
    document.getElementById('userModalTitle').innerText = id ? 'Edit User' : 'Add User';
    openModal('userModal');   // <--- استخدم هنا openModal
}
function closeUserModal(){ 
    closeModal('userModal');  // <--- استخدم هنا closeModal
}

// ===== Users Form =====
document.getElementById('userForm').onsubmit = function(e){
    e.preventDefault();
    let formData = new FormData(this);
    fetch('users/save_user.php', {method:'POST', body:formData})
    .then(res => res.json())
    .then(data => {
        if(data.success){
            alert(data.message);
            closeUserModal();
            loadUsers();
        } else alert(data.message);
    });
}

// ===== Delete User =====
function deleteUser(id){
    if(confirm('Are you sure to delete this user?')){
        let formData = new FormData();
        formData.append('user_id', id);
        fetch('users/delete_user.php', {method:'POST', body:formData})
        .then(res => res.json())
        .then(data => {
            if(data.success) loadUsers();
            else alert(data.message);
        });
    }
}

// ===== Load Tables =====
function loadTables(){
    fetch('tables/tables.php')
    .then(res => res.json())
    .then(data => {
        let html = `<button class="btn btn-primary" onclick="openTableModal()">Add Table</button>
        <table>
            <tr><th>#</th><th>Number</th><th>Status</th><th>Action</th></tr>`;
        data.forEach(t => {
            html += `<tr>
                <td>${t.id}</td>
                <td>${t.table_number}</td>
                <td>${t.status}</td>
                <td>
                    <button class="btn btn-primary" onclick="openTableModal(${t.id},${t.table_number},'${t.status}')">Edit</button>
                    <button class="btn btn-danger" onclick="deleteTable(${t.id})">Delete</button>
                </td>
            </tr>`;
        });
        html += '</table>';
        document.getElementById('tables').innerHTML = html;
    });
}

// ===== Tables Modal =====
function openTableModal(id='', number='', status='available'){
    document.getElementById('table_id').value = id;
    document.getElementById('table_number').value = number;
    document.getElementById('table_status').value = status;
    document.getElementById('tableModalTitle').innerText = id ? 'Edit Table' : 'Add Table';
    openModal('tableModal');
}
function closeTableModal(){ 
    closeModal('tableModal');
}

// ===== Tables Form =====
document.getElementById('tableForm').onsubmit = function(e){
    e.preventDefault();
    let formData = new FormData(this);
    fetch('tables/save_table.php',{method:'POST', body:formData})
    .then(res => res.json())
    .then(data => {
        if(data.success){
            alert(data.message);
            closeTableModal();
            loadTables();
        } else alert(data.message);
    });
}

// ===== Delete Table =====
function deleteTable(id){
    if(confirm('Are you sure to delete this table?')){
        let formData = new FormData();
        formData.append('table_id', id);
        fetch('tables/delete_table.php',{method:'POST', body:formData})
        .then(res => res.json())
        .then(data => {
            if(data.success) loadTables();
            else alert(data.message);
        });
    }
}

// ===== Load Products =====
function loadProducts(){
    fetch('products/products.php')
    .then(res => res.json())
    .then(data => {
        let html = `<button class="btn btn-primary" onclick="openProductModal()">Add Product</button>
        <table>
            <tr><th>#</th><th>Name</th><th>Price</th><th>Description</th><th>Action</th></tr>`;
        data.forEach(p => {
            html += `<tr>
                <td>${p.id}</td>
                <td>${p.name}</td>
                <td>${p.price}</td>
                <td>${p.description}</td>
                <td>
                    <button class="btn btn-primary" onclick="openProductModal(${p.id},'${p.name}',${p.price},'${p.description}',${p.stock_quantity},${p.category_id})">Edit</button>
                    <button class="btn btn-danger" onclick="deleteProduct(${p.id})">Delete</button>
                    <button class="btn btn-primary" onclick="openFlavors(${p.id})">Flavors</button>
                </td>
            </tr>`;
        });
        html += '</table>';
        document.getElementById('products').innerHTML = html;
    });
}

// ===== Products Modal =====
function openProductModal(id='', name='', price='', description='', stock='', category=''){
    document.getElementById('product_id').value = id;
    document.getElementById('product_name').value = name || '';
    document.getElementById('product_price').value = price || 0;
    document.getElementById('product_description').value = description || '';
    document.getElementById('product_stock').value = stock || 0;
    document.getElementById('product_category').value = category || '';
    document.getElementById('productModalTitle').innerText = id ? 'Edit Product' : 'Add Product';
    openModal('productModal');
}
function closeProductModal(){ 
    closeModal('productModal');
}

// ===== Products Form =====
document.getElementById('productForm').onsubmit = function(e){
    e.preventDefault();
    let formData = new FormData(this);
    fetch('products/save_product.php',{method:'POST', body:formData})
    .then(res => res.json())
    .then(data => {
        if(data.success){
            alert(data.message || "Product saved successfully");
            closeProductModal();
            loadProducts();
        } else {
            alert(data.message);
        }
    });
}

// ===== Delete Product =====
function deleteProduct(id){
    if(confirm('Are you sure to delete this product?')){
        let formData = new FormData();
        formData.append('product_id',id);
        fetch('products/delete_product.php',{method:'POST', body:formData})
        .then(res => res.json())
        .then(data => {
            if(data.success) loadProducts();
            else alert(data.message);
        });
    }
}

// ===== Reports =====
function loadReports(){
    fetch('reports/get_reports.php')
    .then(res => res.json())
    .then(data => {
        if(data.length === 0){
            document.getElementById('reports').innerHTML = '<p>No messages yet...</p>';
            return;
        }
        let html = `<table>
<tr><th>#</th><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr>`;
        data.forEach(r => {
            html += `<tr>
<td>${r.id}</td>
<td>${r.first_name} ${r.last_name}</td>
<td>${r.email}</td>
<td>${r.message}</td>
<td>${r.created_at}</td>
</tr>`;
        });
        html += '</table>';
        document.getElementById('reports').innerHTML = html;
    });
}

// ===== Auto Refresh =====
setInterval(() => {
    let activeTab = document.querySelector('.sidebar a.active').getAttribute('data-tab');
    if(activeTab === 'users') loadUsers();
    else if(activeTab === 'products') loadProducts();
    else if(activeTab === 'tables') loadTables();
    else if(activeTab === 'orders') loadOrders();
}, 7000);

// ===== Flavors =====
function openFlavors(product_id){
    document.getElementById("flavor_product_id").value = product_id;
    document.getElementById("flavorModal").style.display = "grid";
    loadFlavors(product_id);
}

function loadFlavors(product_id){
    if(document.getElementById("flavorModal").style.display === "none") return;

    fetch("flavors/flavors.php?product_id="+product_id)
    .then(res => res.json())
    .then(data => {
        let html = `<table>
<tr><th>ID</th><th>Name</th><th>Price</th><th>Stock</th><th>Action</th></tr>`;
        data.forEach(f=>{
            html += `<tr>
<td>${f.flavor_id}</td>
<td>${f.flavor_name}</td>
<td>${f.price}</td>
<td>${f.stock_quantity}</td>
<td>
<button onclick="openFlavorModal(${f.flavor_id},'${f.flavor_name}','${f.price}','${f.stock_quantity}','${f.image}')">Edit</button>
<button onclick="deleteFlavor(${f.flavor_id})">Delete</button>
</td>
</tr>`;
        });
        html += "</table>";
        document.getElementById("flavorsList").innerHTML = html;

        let dropdown = `<select id="flavor_select_${product_id}">`;
        data.forEach(f=>{
            dropdown += `<option value="${f.flavor_id}">${f.flavor_name} - $${f.price}</option>`;
        });
        dropdown += `</select>`;
        document.getElementById("flavorDropdownContainer").innerHTML = dropdown;
    });
}

document.getElementById("flavorForm").onsubmit = function(e){
    e.preventDefault();
    let formData = new FormData(this);
    fetch("flavors/save_flavor.php", {
        method:"POST",
        body:formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            alert(data.message || "Flavor saved successfully");
            let product_id = document.getElementById("flavor_product_id").value;
            loadFlavors(product_id);
            closeFlavorModal();
        } else {
            alert(data.message);
        }
    });
}

function deleteFlavor(id){
    if(confirm("Delete this flavor?")){
        let formData = new FormData();
        formData.append("flavor_id",id);
        fetch("flavors/delete_flavor.php", {
            method:"POST",
            body:formData
        })
        .then(res=>res.json())
        .then(data=>{
            if(data.success){
                let product_id = document.getElementById("flavor_product_id").value;
                loadFlavors(product_id);
            }
        })
    }
}

function openFlavorModal(id='', name='', price='', stock='', image=''){
    document.getElementById('flavor_id').value = id;
    document.getElementById('flavor_name').value = name || '';
    document.getElementById('flavor_price').value = price || 0;
    document.getElementById('flavor_stock_quantity').value = stock || 0;
    document.getElementById('flavorModalTitle').innerText = id ? 'Edit Flavor' : 'Add Flavor';
    openModal('flavorModal');
}
function closeFlavorModal(){ 
    closeModal('flavorModal');
    document.getElementById("flavorsList").innerHTML = '';
    document.getElementById("flavorDropdownContainer").innerHTML = '';
}
// ===== Generic Open/Close Modal =====
function openModal(modalId){
    let modal = document.getElementById(modalId);
    modal.classList.add('show');
    modal.style.display = 'flex';
}

function closeModal(modalId){
    let modal = document.getElementById(modalId);
    modal.classList.remove('show');
    setTimeout(() => { modal.style.display = 'none'; }, 300);
}