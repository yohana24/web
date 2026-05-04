const trans = {
    en: {
        no_orders: "No orders yet...",
        add_user: "Add User",
        edit_user: "Edit User",
        delete: "Delete",
        edit: "Edit",
        name: "Name",
        email: "Email",
        role: "Role",
        action: "Action",
        price: "Price",
        description: "Description",
        table_number: "Table Number",
        status: "Status",
        id: "ID",
        order_number: "Order #",
        user: "User",
        table: "Table",
        total: "Total",
        
        date: "Date",
        items: "Items",
id: "#",
        name: "Name",
        email: "Email",
        message: "Message",
        date: "Date",
        confirm_delete_user: "Are you sure to delete this user?",
        confirm_delete_table: "Are you sure to delete this table?",
        confirm_delete_product: "Are you sure to delete this product?",
pending: "Pending",
        completed: "Completed",
        cancelled: "Cancelled",
        add_table: "Add Table",
        edit_table: "Edit Table",

        add_product: "Add Product",
        edit_product: "Edit Product",

        no_messages: "No messages yet...",
        flavor: "Flavors"
    },

    ar: {
        no_orders: "لا توجد طلبات حتى الآن...",
        add_user: "إضافة مستخدم",
        edit_user: "تعديل مستخدم",
        delete: "حذف",
        edit: "تعديل",
        name: "الاسم",
        email: "الإيميل",
        role: "الدور",
        action: "الإجراء",
        price: "السعر",
        description: "الوصف",
        table_number: "رقم الطاولة",
        status: "الحالة",
id: "ID",
        order_number: "رقم الطلب",
        user: "المستخدم",
        table: "الطاولة",
        total: "الإجمالي",
        
        date: "التاريخ",
        items: "العناصر",
        confirm_delete_user: "هل أنت متأكد من حذف المستخدم؟",
        confirm_delete_table: "هل أنت متأكد من حذف الطاولة؟",
        confirm_delete_product: "هل أنت متأكد من حذف المنتج؟",
pending: "قيد الانتظار",
        completed: "مكتمل",
        cancelled: "ملغي",
        add_table: "إضافة طاولة",
        edit_table: "تعديل طاولة",

        add_product: "إضافة منتج",
        edit_product: "تعديل منتج",
id: "#",
        name: "الاسم",
        email: "الإيميل",
        message: "الرسالة",
        date: "التاريخ",
        no_messages: "لا توجد رسائل حتى الآن...",
        flavor: "النكهات"
    }
};
// ===== أول ما الصفحة تفتح =====
// بنشغل تحميل الأوردرات مباشرة



// ===== نظام التابات (Sidebar Navigation) =====
// الهدف: تغيير المحتوى حسب التاب اللي المستخدم يضغط عليه
document.querySelectorAll('.sidebar a').forEach(link => {
    link.addEventListener('click', function(e){
        e.preventDefault(); // منع إعادة تحميل الصفحة

        // نشيل active من كل التابات
        document.querySelectorAll('.sidebar a').forEach(l => l.classList.remove('active'));

        // نحط active على التاب الحالي
        this.classList.add('active');

        // نجيب اسم التاب اللي اتضغط عليه
        let tab = this.getAttribute('data-tab');

        // نخفي كل المحتوى ونظهر المحتوى المطلوب
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        document.getElementById(tab).classList.add('active');

        // نحدد أي دالة تتنفذ حسب التاب
        if(tab==='orders') loadOrders();
        else if(tab==='tables') loadTables();
        else if(tab==='products') loadProducts();
        else if(tab==='users') loadUsers();
        else if(tab==='reports') loadReports();
        else if(tab==='analytics') {
    // مفيش حاجة نعملها لأنه iframe جاهز
};
    });
});


// =========================
//  تحميل الطلبات من السيرفر
// =========================
function loadOrders(){
    fetch('orders/orders.php')
    .then(res => res.json())
    .then(data => {

        if(data.length === 0){
            document.getElementById('orders').innerHTML = `<p>${t('no_orders')}</p>`;
            return;
        }

        let html = `
        <table>
        <tr>
            <th>${t('id','orders')}</th>
            <th>${t('order_number','orders')}</th>
            <th>${t('user','orders')}</th>
            <th>${t('table','orders')}</th>
            <th>${t('total','orders')}</th>
            <th>${t('status','orders')}</th>
            <th>${t('date','orders')}</th>
            <th>${t('items','orders')}</th>
        </tr>
        `;

        data.forEach(o => {
            html += `
            <tr>
                <td>${o.order_id}</td>
                <td>${o.order_number}</td>
                <td>${o.user_name}</td>
                <td>${o.table_number ?? '-'}</td>
                <td>${o.total_amount}</td>
                <td>${o.status}</td>
                <td>${o.created_at}</td>
                <td>
                    ${o.items.map(i => `${i.product_name} (${i.quantity})`).join(", ")}
                </td>
            </tr>
            `;
        });

        html += "</table>";

        document.getElementById('orders').innerHTML = html;
    });
}


// =========================
//  تحميل المستخدمين
// =========================
function loadUsers(){
    fetch('users/users.php')
    .then(res => res.json())
    .then(data => {

        let html = `
        <button class="btn btn-primary" onclick="openUserModal()">
            ${t('add_user')}
        </button>

        <table>
            <tr>
                <th>#</th>
                <th>${t('name')}</th>
                <th>${t('email')}</th>
                <th>${t('role')}</th>
                <th>${t('action')}</th>
            </tr>`;

        data.forEach(u => {
            html += `<tr>
                <td>${u.id}</td>
                <td>${u.name}</td>
                <td>${u.email}</td>
                <td>${u.role}</td>

                <td>
                    <button class="btn btn-primary"
                        onclick="openUserModal(${u.id}, '${encodeURIComponent(u.name)}', '${encodeURIComponent(u.email)}', '${u.role}', '********')">
                        ${t('edit')}
                    </button>

                    <button class="btn btn-danger" onclick="deleteUser(${u.id})">
                        ${t('delete')}
                    </button>
                </td>
            </tr>`;
        });

        html += '</table>';
        document.getElementById('users').innerHTML = html;
    });
}

// =========================
//  User Modal (فتح / إغلاق)
// =========================
function openUserModal(id='', name='', email='', role='customer', password=''){
    document.getElementById('user_id').value = id;
    document.getElementById('user_name').value = decodeURIComponent(name);
    document.getElementById('user_email').value = decodeURIComponent(email);
    document.getElementById('user_password').value = password;
    document.getElementById('user_role').value = role;

    // تغيير العنوان حسب Add / Edit
    document.getElementById('userModalTitle').innerText = id ? t('edit_user') : t('add_user');

    openModal('userModal');
}

function closeUserModal(){ 
    closeModal('userModal');
}


// =========================
//  حفظ المستخدم
// =========================
document.getElementById('userForm').onsubmit = function(e){
    e.preventDefault();

    let formData = new FormData(this);

    fetch('users/save_user.php', {method:'POST', body:formData})
    .then(res => res.json())
    .then(data => {
        if(data.success){
            alert(data.message);
            closeUserModal();
            loadUsers(); // إعادة تحميل البيانات بعد الحفظ
        } else alert(data.message);
    });
}


// =========================
//  حذف مستخدم
// =========================
function deleteUser(id){
    if(confirm(t('confirm_delete_user'))){

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


// =========================
//  تحميل الطاولات
// =========================
function loadTables(){
    fetch('tables/tables.php')
    .then(res => res.json())
    .then(data => {

        let html = `
        <button class="btn btn-primary" onclick="openTableModal()">
            ${t('add_table')}
        </button>

        <table>
            <tr>
                <th>#</th>
                <th>${t('table_number')}</th>
                <th>${t('status')}</th>
                <th>${t('action')}</th>
            </tr>`;

        data.forEach(ti => {
            html += `<tr>
                <td>${ti.id}</td>
                <td>${ti.table_number}</td>
                <td>${ti.status}</td>

                <td>
                    <button class="btn btn-primary"
                        onclick="openTableModal(${ti.id},${ti.table_number},'${ti.status}')">
                        ${t('edit')}
                    </button>

                    <button class="btn btn-danger" onclick="deleteTable(${ti.id})">
                        ${t('delete')}
                    </button>
                </td>
            </tr>`;
        });

        html += '</table>';
        document.getElementById('tables').innerHTML = html;
    });
}


// =========================
//  Table Modal
// =========================
function openTableModal(id='', number='', status='available') {

    document.getElementById('table_id').value = id || '';
    document.getElementById('table_number').value = number || '';
    document.getElementById('table_status').value = status || 'available';

    const title = document.getElementById('tableModalTitle');
    if (title) {
        title.innerText = id ? t('edit_table') : t('add_table');
    }

    openModal('tableModal');
}

function closeTableModal(){ 
    closeModal('tableModal');
}


// =========================
//  حفظ الطاولة
// =========================
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


// =========================
//  حذف طاولة
// =========================
function deleteTable(id){
    if(confirm(t('confirm_delete_table'))){
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


// =========================
//  تحميل المنتجات
// =========================
function loadProducts(){
    fetch('products/products.php')
    .then(res => res.json())
    .then(data => {

        let html = `
        <button class="btn btn-primary" onclick="openProductModal()">
            ${t('add_product')}
        </button>

        <table>
            <tr>
                <th>#</th>
                <th>${t('name')}</th>
                <th>${t('price')}</th>
                <th>${t('description')}</th>
                <th>${t('action')}</th>
            </tr>`;

        data.forEach(p => {
            html += `<tr>
                <td>${p.id}</td>
                <td>${p.name}</td>
                <td>${p.price}</td>
                <td>${p.description}</td>

                <td>
                    <button class="btn btn-primary"
                        onclick="openProductModal(${p.id},'${p.name}',${p.price},'${p.description}',${p.stock_quantity},${p.category_id})">
                        ${t('edit')}
                    </button>

                    <button class="btn btn-danger" onclick="deleteProduct(${p.id})">
                        ${t('delete')}
                    </button>

                    <button class="btn btn-primary" onclick="openFlavors(${p.id})">
                        ${t('flavor')}
                    </button>
                </td>
            </tr>`;
        });

        html += '</table>';
        document.getElementById('products').innerHTML = html;
    });
}


// =========================
//  Product Modal
// =========================
function openProductModal(id='', name='', price='', description='', stock='', category=''){
    document.getElementById('product_id').value = id || '';
    document.getElementById('product_name').value = name || '';
    document.getElementById('product_price').value = price || '';
    
    const desc = document.getElementById('product_description');
    if(desc) desc.value = description || '';

    const st = document.getElementById('product_stock');
    if(st) st.value = stock || '';

    const cat = document.getElementById('product_category');
    if(cat) cat.value = category || '';

    document.getElementById('productModalTitle').innerText =
        id ? t('edit_product') : t('add_product');

    openModal('productModal');
}

function closeProductModal(){ 
    closeModal('productModal');
}


// =========================
//  حفظ المنتج
// =========================
document.getElementById('productForm').onsubmit = function(e){
    e.preventDefault();

    let formData = new FormData(this);

    fetch('products/save_product.php',{method:'POST', body:formData})
    .then(async res => {
    const text = await res.text();
    console.log(text); // 👈 ده هيكشف المشكلة الحقيقية
    return JSON.parse(text);
})
    .then(data => {
        if(data.success){
            alert(data.message || "تم حفظ المنتج بنجاح");
            closeProductModal();
            loadProducts();
        } else {
            alert(data.message);
        }
    });
}


// =========================
//  حذف منتج
// =========================
function deleteProduct(id){
    if(confirm(t('confirm_delete_product'))){

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


// =========================
//  التقارير
// =========================
function loadReports(){
    fetch('reports/get_reports.php')
    .then(res => res.json())
    .then(data => {

        if(data.length === 0){
            document.getElementById('reports').innerHTML = '<p>لا توجد رسائل حتى الآن...</p>';
            return;
        }

        let html = `
<table>
<tr>
    <th>${t('id','messages')}</th>
    <th>${t('name','messages')}</th>
    <th>${t('email','messages')}</th>
    <th>${t('message','messages')}</th>
    <th>${t('date','messages')}</th>
</tr>
`;

        data.forEach(r => {
            html += `<tr>
<td>${r.id}</td>
<td>${r.name ?? (r.first_name + " " + r.last_name)}</td>
<td>${r.email}</td>
<td>${r.message}</td>
<td>${r.created_at}</td>
</tr>`;
        });

        html += '</table>';
        document.getElementById('reports').innerHTML = html;
    });
}


// =========================
//  تحديث تلقائي للبيانات
// =========================
setInterval(() => {

    let activeLink = document.querySelector('.sidebar a.active');
    if(!activeLink) return;

    let tab = activeLink.dataset.tab;

    if(tab === 'orders') loadOrders();
    else if(tab === 'users') loadUsers();
    else if(tab === 'tables') loadTables();

    // ❌ بلاش products auto refresh
    // لأنها فيها flavors و heavy

}, 10000);


// =========================
//  Flavors System
// =========================
let modalBusy = false;

function openFlavors(product_id){
    document.getElementById("flavor_product_id").value = product_id;
    openModal('flavorModal');
    loadFlavors(product_id);
}

let flavorLoading = false;

function loadFlavors(product_id){

    if(flavorLoading) return;
    flavorLoading = true;

    fetch("flavors/flavors.php?product_id=" + product_id)
    .then(async res => {
    const text = await res.text();
    console.log(text); // 👈 ده هيكشف المشكلة الحقيقية
    return JSON.parse(text);
})
    .then(data => {

        const list = document.getElementById("flavorsList");
        if(!list) return;

        let html = `
        <table>
            <tr>
                <th>ID</th>
                <th>الاسم</th>
                <th>السعر</th>
                <th>المخزون</th>
                <th>الإجراء</th>
            </tr>
        `;

        data.forEach(f => {
    html += `
    <tr>
        <td>${f.flavor_id}</td>
        <td>${f.flavor_name}</td>
        <td>${f.price}</td>
        <td>${f.stock_quantity}</td>
        <td>
            <button 
                onclick="openFlavorModal(
                    ${f.flavor_id},
                    '${f.flavor_name.replace(/'/g, "\\'")}',
                    ${f.price},
                    ${f.stock_quantity}
                )">
                Edit
            </button>

            <button onclick="deleteFlavor(${f.flavor_id})">
                Delete
            </button>
        </td>
    </tr>
    `;
});

        html += `</table>`;
        list.innerHTML = html;
    })
    .finally(() => {
        flavorLoading = false;
    });
}


// =========================
//  حفظ الفلايفر
// =========================
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
            alert(data.message || "تم حفظ النكهة بنجاح");
            let product_id = document.getElementById("flavor_product_id").value;
            loadFlavors(product_id);
            closeFlavorModal();
        } else {
            alert(data.message);
        }
    });
}


// =========================
//  حذف flavor
// =========================
function deleteFlavor(id){

    if(confirm(t('confirm_delete_product'))){

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


// =========================
// فتح / تعديل flavor
// =========================
function openFlavorModal(id='', name='', price='', stock=''){

    const set = (id, val) => {
        const el = document.getElementById(id);
        if(el) el.value = val ?? '';
    };

    set('flavor_id', id);
    set('flavor_name', name);
    set('flavor_price', price);
    set('flavor_stock_quantity', stock);

    document.getElementById('flavorModalTitle').innerText =
        id ? 'تعديل نكهة' : 'إضافة نكهة';

    openModal('flavorModal');
}


// =========================
//  إغلاق flavor modal
// =========================
function closeFlavorModal(){ 
    closeModal('flavorModal');

    document.getElementById("flavorsList").innerHTML = '';
    document.getElementById("flavorDropdownContainer").innerHTML = '';
}


// =========================
//  فتح modal عام
// =========================
function openModal(modalId){
    let modal = document.getElementById(modalId);
    modal.classList.add('show');
    modal.style.display = 'flex';
}


// =========================
//  قفل modal عام
// =========================
function closeModal(modalId){
    let modal = document.getElementById(modalId);
    modal.classList.remove('show');

    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
}
function t(key){
    return trans[LANG]?.[key] ?? key;
}
function exportExcel(){
    let from = document.getElementById("from_date").value;
    let to = document.getElementById("to_date").value;

    window.open(`export_orders.php?from=${from}&to=${to}`);
}

function exportPDF(){
    let from = document.getElementById("from_date").value;
    let to = document.getElementById("to_date").value;

    window.open(`export_orders_pdf.php?from=${from}&to=${to}`);
}
document.addEventListener('click', function(e){
    const btn = e.target.closest('.edit-flavor');
    if(!btn) return;

    openFlavorModal(
        btn.dataset.id,
        btn.dataset.name,
        btn.dataset.price,
        btn.dataset.stock
    );
});