let isLoadingOrders = false;
let lastUpdate = null;
// ===== Load Orders =====
function loadOrders(){

    if(isLoadingOrders) return;
    isLoadingOrders = true;

    fetch('get_orders_staff.php')
    .then(res => res.json())
    .then(data => {

        const container = document.getElementById("ordersContainer");
        container.innerHTML = "";

        if(!data || data.length === 0){
            container.innerHTML = "<p class='text-center text-muted'>No orders yet.</p>";
            return;
        }

        data.forEach(order => {

            const statusClass = "status-" + (order.status || "").toLowerCase();

            let actionButton = "";

            if(order.status !== "Completed"){
                actionButton = `<button class="action-btn" onclick="completeOrder(${order.order_id})">Mark Completed</button>`;
            } else {
                actionButton = `<span class="order-status status-completed">✔ Completed</span>`;
            }

            let orderDetails = "";

            if(order.items && order.items.length > 0){
                orderDetails = "<ul>";

                order.items.forEach(item => {

                    const subtotal = parseFloat(item.subtotal || (item.price * item.quantity));

                    let noteHTML = "";

                    if(item.note && item.note.trim() !== ""){
                        noteHTML = `<div class="item-note">${item.note}</div>`;
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
            }

            container.innerHTML += `
                <div class="order-card">
                    <div class="order-header">

                        <div>
                            <span class="order-number">Order #${order.order_number}</span>
                            <div class="customer-name">
                                ${order.table_number ? "Table #" + order.table_number : "Takeaway"}
                                - ${order.customer_name} placed this order
                            </div>
                        </div>

                        <span class="order-status ${statusClass}">
                            ${order.status}
                        </span>

                    </div>

                    <div class="order-details">${orderDetails}</div>

                    <div class="total">
                        Total: ${parseFloat(order.total_amount || 0).toFixed(2)} EGP
                    </div>

                    ${actionButton}
                </div>
            `;
        });

    })
    .catch(err => console.error("Error loading orders:", err))
    .finally(() => {
        isLoadingOrders = false;
    });
}


// ===== Complete Order =====
function completeOrder(orderId){

    fetch('update_order.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({order_id: orderId})
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            loadOrders();
        } else {
            alert("Error updating order");
        }
    });

}
function checkForUpdates(){

    fetch('get_orders_staff.php?check=1')
    .then(res => res.json())
    .then(data => {

        if(lastUpdate !== data.last_update){
            lastUpdate = data.last_update;
            loadOrders(); // reload only when needed
        }

    });

}

// ===== Initial Load =====
loadOrders();
setInterval(loadOrders, 3000); // 
setInterval(checkForUpdates, 5000);

// ===== Scroll Progress Circle (FIXED) =====
let scrollProgress = document.getElementById("progress");

let calcScrollValue = () => {

    if(!scrollProgress) return;

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