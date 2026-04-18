let isLoadingOrders = false;
let isLoadingNotifications = false;

// لتجنب إعادة رسم نفس الطلبات لو مفيش تغيير
let lastOrdersHTML = "";

// =========================
// 📦 LOAD USER ORDERS
// =========================
function loadMyOrders() {

    // منع تكرار الفetch لو لسه في طلب شغال
    if (isLoadingOrders) return;
    isLoadingOrders = true;

    fetch('get_my_orders.php')
        .then(res => res.json())
        .then(data => {

            const container = document.getElementById("ordersContainer");
            if (!container) return;

            // لو مفيش أوردرات
            if (!data || data.length === 0) {
                container.innerHTML = "<p class='text-center text-muted'>You have no orders yet.</p>";
                lastOrdersHTML = "";
                return;
            }

            let html = "";

            // بناء شكل كل order
            data.forEach(order => {

                const statusClass = "status-" + (order.status || "").toLowerCase();

                let orderDetails = "<p>No product details</p>";

                // عرض المنتجات داخل الطلب
                if (order.items && order.items.length > 0) {

                    orderDetails = "<ul>";

                    order.items.forEach(item => {

                        const subtotal = Number(item.subtotal || (item.price * item.quantity));

                        const note = item.note && item.note.trim()
                            ? `<span class="item-note">${item.note}</span>`
                            : "";

                        orderDetails += `
                            <li>
                                ${item.product_name} x ${item.quantity}
                                - ${subtotal.toFixed(2)} EGP
                                ${note}
                            </li>
                        `;
                    });

                    orderDetails += "</ul>";
                }

                // كارت العرض النهائي للطلب
                html += `
                    <div class="order-card">

                        <div class="order-header">

                            <span class="order-number">Order #${order.order_number}</span>

                            <span class="order-table">
                                ${order.display_table || ""}
                            </span>

                            <span class="order-status ${statusClass}">
                                ${order.status}
                            </span>

                        </div>

                        <div class="order-details">
                            ${orderDetails}
                        </div>

                        <div class="total">
                            Total: ${Number(order.total_amount || 0).toFixed(2)} EGP
                        </div>

                        <button class="action-btn" onclick="reorder(${order.order_id})">
                            Order Again
                        </button>

                    </div>
                `;
            });

            // تحديث الصفحة فقط لو فيه تغيير
            if (html !== lastOrdersHTML) {
                container.innerHTML = html;
                lastOrdersHTML = html;
            }

        })
        .catch(err => console.error("Orders Error:", err))
        .finally(() => {
            isLoadingOrders = false;
        });
}


// =========================
// 🔔 NOTIFICATIONS SYSTEM
// =========================
function checkNotifications() {

    if (isLoadingNotifications) return;
    isLoadingNotifications = true;

    fetch('get_notifications.php')
        .then(res => res.json())
        .then(data => {

            const popup = document.getElementById("order-popup");
            if (!popup) return;

            // لو مفيش إشعارات
            if (!data || data.length === 0) return;

            const latest = data[0];

            // عرض أحدث notification فقط
            if (latest && latest.message) {

                popup.innerHTML = latest.message;
                popup.style.display = "block";

                // إخفاء بعد 3 ثواني
                setTimeout(() => {
                    popup.style.display = "none";
                }, 3000);

                // تعليم الإشعار إنه اتقري
                fetch('mark_notification_read.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: latest.notification_id })
                });
            }

        })
        .catch(err => console.error("Notifications Error:", err))
        .finally(() => {
            isLoadingNotifications = false;
        });
}


// =========================
// 🔁 REORDER FUNCTION
// =========================
function reorder(orderId) {

    if (!confirm("Do you want to order the same items again?")) return;

    fetch("reorder.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ order_id: orderId })
    })
        .then(res => res.json())
        .then(data => {

            if (data.success) {
                alert("Order placed successfully!");
                loadMyOrders();
            } else {
                alert("Failed to reorder");
            }

        })
        .catch(err => console.error("Reorder Error:", err));
}


// =========================
// 🚀 SAFE POLLING SYSTEM
// =========================

// أول تحميل مباشر
loadMyOrders();
checkNotifications();

// polling بدون تداخل requests
function startPolling() {

    setTimeout(function ordersLoop() {
        loadMyOrders();
        setTimeout(ordersLoop, 8000);
    }, 8000);

    setTimeout(function notifLoop() {
        checkNotifications();
        setTimeout(notifLoop, 3000);
    }, 3000);
}

startPolling();


// =========================
// 📊 SCROLL PROGRESS BUTTON
// =========================
let scrollProgress = document.getElementById("progress");

function calcScrollValue() {

    if (!scrollProgress) return;

    let pos = document.documentElement.scrollTop || document.body.scrollTop;

    let height =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;

    let scrollValue = height ? Math.round((pos * 100) / height) : 0;

    // إظهار الزر بعد scroll معين
    if (pos > 100) {
        scrollProgress.style.display = "grid";
    } else {
        scrollProgress.style.display = "none";
    }

    // الرجوع للأعلى بسلاسة
    scrollProgress.onclick = () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
    };

    // شكل الـ progress الدائري
    scrollProgress.style.background =
        `conic-gradient(#333 ${scrollValue}%, #d7d7d7 ${scrollValue}%)`;
}

window.addEventListener("scroll", calcScrollValue);
window.addEventListener("load", calcScrollValue);