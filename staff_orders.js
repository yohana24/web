
let isLoadingOrders = false;

// ======================
// تحميل الطلبات
// ======================
function loadOrders(){

    if(isLoadingOrders) return;
    isLoadingOrders = true;

    fetch('get_orders_staff.php')
    .then(res => res.json())
    .then(data => {

        const container = document.getElementById("ordersContainer");

        if(!data || data.length === 0){
            container.innerHTML = "<p class='text-center text-muted'>لا توجد طلبات بعد.</p>";
            return;
        }

        container.innerHTML = data.map(order => {

            const statusClass = "status-" + (order.status || "").toLowerCase();

            let itemsHTML = "";

            if(order.items && order.items.length > 0){
                itemsHTML = "<ul>";

                order.items.forEach(item => {

                    const subtotal = parseFloat(item.subtotal || (item.price * item.quantity));

                    itemsHTML += `
                        <li>
                            ${item.product_name} x ${item.quantity}
                            - ${subtotal.toFixed(2)} EGP

                            ${item.note ? `<div class="item-note">${item.note}</div>` : ""}
                        </li>
                    `;
                });

                itemsHTML += "</ul>";
            }

            // ======================
            // زر واحد (تأكيد + واتس)
            // ======================
            let actionButton = "";

            if(order.status !== "Completed"){

    actionButton = `
        <button class="action-btn"
            onclick='completeAndNotify(
                ${order.order_id},
                ${JSON.stringify(order.phone || "")},
                ${JSON.stringify(order.order_number)},
                ${JSON.stringify(order.customer_name || "")},
                ${JSON.stringify(order.items || [])}
            )'>
            ✔ تأكيد + واتس
        </button>
    `;
} else {
                actionButton = `<span class="order-status status-completed">✔ مكتمل</span>`;
            }

            return `
                <div class="order-card">

                    <div class="order-header">

                        <div>
                            <span class="order-number">طلب رقم #${order.order_number}</span>

                            <div class="customer-name">
                                ${order.table_number ? "طاولة رقم " + order.table_number : "سفري"}
                                - ${order.customer_name} قام بإنشاء هذا الطلب
                            </div>
                        </div>

                        <span class="order-status ${statusClass}">
                            ${order.status}
                        </span>

                    </div>

                    <div class="order-details">
                        ${itemsHTML}
                    </div>

                    <div class="total">
                        الإجمالي: ${parseFloat(order.total_amount || 0).toFixed(2)} EGP
                    </div>

                    ${actionButton}

                </div>
            `;
        }).join("");

    })
    .catch(err => console.error("خطأ في تحميل الطلبات:", err))

    .finally(() => {
        isLoadingOrders = false;
    });
}


// ======================
// تأكيد + واتساب
// ======================
function completeAndNotify(orderId, phone, orderNumber, customerName, items){

    fetch('update_order.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({order_id: orderId})
    })
    .then(res => res.json())
    .then(data => {

        if(data.success){

            let cleanPhone = (phone || "").replace(/\D/g, "");

            if(cleanPhone.startsWith("0")){
                cleanPhone = "20" + cleanPhone.substring(1);
            }

            // ===== بناء تفاصيل الطلب =====
            let orderItemsText = "";

            if(items && items.length > 0){
                orderItemsText = items
                    .map(item => `- ${item.product_name} x ${item.quantity}`)
                    .join("\n");
            } else {
                orderItemsText = "لا توجد تفاصيل";
            }

            // ===== الرسالة النهائية =====
            let msg = `أهلاً ${customerName}

رقم الطلب: ${orderNumber}

تفاصيل الطلب:
${orderItemsText}

الطلب جاهز للاستلام

شكراً لطلبك`;

            let url = `https://wa.me/${cleanPhone}?text=${encodeURIComponent(msg)}`;

            window.open(url, "_blank");

            loadOrders();

        } else {
            alert("خطأ في تحديث الطلب");
        }
    });
}

// ======================
// أول تحميل
// ======================
loadOrders();

setInterval(loadOrders, 8000);