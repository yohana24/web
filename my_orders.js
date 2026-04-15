let isLoadingOrders = false;
let isLoadingNotifications = false;

// ===== Load Orders =====
function loadMyOrders() {

    if (isLoadingOrders) return;
    isLoadingOrders = true;

    fetch('get_my_orders.php')
        .then(res => res.json())
        .then(data => {

            const container = document.getElementById("ordersContainer");
            container.innerHTML = "";

            if (!data || data.length === 0) {
                container.innerHTML = "<p class='text-center text-muted'>You have no orders yet.</p>";
                return;
            }

            data.forEach(order => {

                const statusClass = "status-" + (order.status || "").toLowerCase();

                let orderDetails = "";

                if (order.items && order.items.length > 0) {
                    orderDetails = "<ul>";

                    order.items.forEach(item => {

                        const subtotal = parseFloat(item.subtotal || (item.price * item.quantity));

                        let noteHTML = "";
                        if (item.note && item.note.trim() !== "") {
                            noteHTML = `<span class="item-note">${item.note}</span>`;
                        }

                        orderDetails += `
                            <li>
                                ${item.product_name} x ${item.quantity}
                                - ${subtotal.toFixed(2)} EGP
                                ${noteHTML}
                            </li>
                        `;
                    });

                    orderDetails += "</ul>";
                } else {
                    orderDetails = "<p>No product details</p>";
                }

                container.innerHTML += `
                    <div class="order-card">
                        <div class="order-header">
                            <span class="order-number">Order #${order.order_number}</span>
                            <span class="order-table">${order.display_table || ""}</span>
                            <span class="order-status ${statusClass}">${order.status}</span>
                        </div>

                        <div class="order-details">${orderDetails}</div>

                        <div class="total">
                            Total: ${parseFloat(order.total_amount || 0).toFixed(2)} EGP
                        </div>

                        <button class="action-btn" onclick="reorder(${order.order_id})">
                            Order Again
                        </button>
                    </div>
                `;
            });

        })
        .catch(err => {
            console.error("Error loading orders:", err);
        })
        .finally(() => {
            isLoadingOrders = false;
        });
}


// ===== Notifications =====
function checkNotifications() {

    if (isLoadingNotifications) return;
    isLoadingNotifications = true;

    fetch('get_notifications.php')
        .then(res => res.json())
        .then(data => {

            if (!data || data.length === 0) return;

            const popup = document.getElementById("order-popup");

            data.forEach(notification => {

                popup.innerHTML = notification.message;
                popup.style.display = "block";

                setTimeout(() => {
                    popup.style.display = "none";
                }, 4000);

                fetch('mark_notification_read.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: notification.notification_id })
                });
            });

        })
        .catch(err => console.error(err))
        .finally(() => {
            isLoadingNotifications = false;
        });
}


// ===== Reorder =====
function reorder(orderId) {

    if (!confirm("Do you want to order the same items again?")) return;

    fetch("reorder.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            order_id: orderId
        })
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
        .catch(err => console.error(err));
}


// ===== Initial Load =====
loadMyOrders();
checkNotifications();

setInterval(loadMyOrders, 3000);
setInterval(checkNotifications, 3000);


// ===== Scroll Progress Circle =====
let calcScrollValue = () => {

    let scrollProgress = document.getElementById("progress");

    let pos = document.documentElement.scrollTop;

    let calcHeight =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;

    let scrollValue = Math.round((pos * 100) / calcHeight);

    if (pos > 100) {
        scrollProgress.style.display = "grid";
    } else {
        scrollProgress.style.display = "none";
    }

    scrollProgress.onclick = () => {
        document.documentElement.scrollTop = 0;
    };

    scrollProgress.style.background =
        `conic-gradient(#333 ${scrollValue}%, #d7d7d7 ${scrollValue}%)`;
};


window.onscroll = calcScrollValue;
window.onload = calcScrollValue;