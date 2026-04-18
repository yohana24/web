let isLoadingOrders = false;

// ===== متغير حماية =====
// الهدف منه منع تكرار طلبات الفتش لو فيه request شغال بالفعل
// (علشان مايحصلش ضغط على السيرفر أو تكرار البيانات)
function loadOrders(){

    // لو فيه تحميل شغال بالفعل، نوقف التنفيذ
    if(isLoadingOrders) return;

    // نعلم إن فيه عملية تحميل بدأت
    isLoadingOrders = true;

    // ===== جلب الطلبات من السيرفر (Backend API) =====
    fetch('get_orders_staff.php')
    .then(res => res.json())
    .then(data => {

        // ===== عنصر عرض الأوردرات في الصفحة =====
        const container = document.getElementById("ordersContainer");

        // لو مفيش بيانات من الداتا بيز
        if(!data || data.length === 0){
            container.innerHTML = "<p class='text-center text-muted'>No orders yet.</p>";
            return;
        }

        // ===== بناء HTML لكل الأوردرات =====
        container.innerHTML = data.map(order => {

            // إضافة كلاس حسب حالة الأوردر (pending / completed etc)
            const statusClass = "status-" + (order.status || "").toLowerCase();

            let itemsHTML = "";

            // ===== عرض عناصر كل أوردر (المنتجات) =====
            if(order.items && order.items.length > 0){

                itemsHTML = "<ul>";

                order.items.forEach(item => {

                    // حساب subtotal لكل منتج (price * quantity)
                    const subtotal = parseFloat(item.subtotal || (item.price * item.quantity));

                    itemsHTML += `
                        <li>
                            ${item.product_name} x ${item.quantity}
                            - ${subtotal.toFixed(2)} EGP

                            // ملاحظة لو فيه نوت للمستخدم على المنتج
                            ${item.note ? `<div class="item-note">${item.note}</div>` : ""}
                        </li>
                    `;
                });

                itemsHTML += "</ul>";
            }

            // ===== زرار تغيير حالة الأوردر =====
            let actionButton = "";

            // لو الأوردر مش مكتمل
            if(order.status !== "Completed"){
                actionButton = `<button class="action-btn" onclick="completeOrder(${order.order_id})">Mark Completed</button>`;
            } else {
                actionButton = `<span class="order-status status-completed">✔ Completed</span>`;
            }

            // ===== تصميم كارت الأوردر =====
            return `
                <div class="order-card">

                    <div class="order-header">

                        <div>
                            <span class="order-number">Order #${order.order_number}</span>

                            <!-- تحديد هل الأوردر على طاولة ولا Takeaway -->
                            <div class="customer-name">
                                ${order.table_number ? "Table #" + order.table_number : "Takeaway"}
                                - ${order.customer_name} placed this order
                            </div>
                        </div>

                        <!-- حالة الأوردر -->
                        <span class="order-status ${statusClass}">
                            ${order.status}
                        </span>

                    </div>

                    <!-- تفاصيل المنتجات -->
                    <div class="order-details">
                        ${itemsHTML}
                    </div>

                    <!-- إجمالي السعر -->
                    <div class="total">
                        Total: ${parseFloat(order.total_amount || 0).toFixed(2)} EGP
                    </div>

                    <!-- زر التحكم -->
                    ${actionButton}

                </div>
            `;
        }).join("");

    })
    .catch(err => console.error("Error loading orders:", err))

    // ===== إعادة فتح التحميل بعد ما العملية تخلص =====
    .finally(() => {
        isLoadingOrders = false;
    });
}


// ===== تغيير حالة الأوردر إلى Completed =====
function completeOrder(orderId){

    fetch('update_order.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({order_id: orderId})
    })
    .then(res => res.json())
    .then(data => {

        // لو التحديث نجح نعيد تحميل البيانات
        if(data.success){
            loadOrders();
        } else {
            alert("Error updating order");
        }
    });
}


// ===== أول تحميل للصفحة =====
loadOrders();

// ===== تحديث تلقائي كل 8 ثواني =====
setInterval(loadOrders, 8000);


// ===== Scroll Progress Indicator =====
let scrollProgress = document.getElementById("progress");

// دالة حساب نسبة السكرول في الصفحة
let calcScrollValue = () => {

    if(!scrollProgress) return;

    // مكان السكرول الحالي
    let pos = document.documentElement.scrollTop;

    // إجمالي طول الصفحة
    let calcHeight =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;

    // حساب نسبة السكرول %
    let scrollValue = Math.round((pos * 100) / calcHeight);

    // إظهار أو إخفاء زر الرجوع لأعلى
    if (pos > 100) {
        scrollProgress.style.display = "grid";
    } else {
        scrollProgress.style.display = "none";
    }

    // عند الضغط يرجع لأعلى الصفحة
    scrollProgress.onclick = () => {
        document.documentElement.scrollTop = 0;
    };

    // شكل الدايرة (progress circle)
    scrollProgress.style.background =
        `conic-gradient(#333 ${scrollValue}%, #d7d7d7 ${scrollValue}%)`;
};

// تشغيل السكرول
window.onscroll = calcScrollValue;
window.onload = calcScrollValue;