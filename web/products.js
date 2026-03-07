// ===== Scroll Progress =====
function calcScrollValue() {
    const scrollProgress = document.getElementById("progress");
    if (!scrollProgress) return;

    const pos = window.scrollY;
    const calcHeight = document.documentElement.scrollHeight - window.innerHeight;
    const scrollValue = Math.round((pos * 100) / calcHeight);

    scrollProgress.style.display = pos > 100 ? "grid" : "none";
    scrollProgress.style.background = `conic-gradient(#03A7E0 ${scrollValue}%, #d7d7d7 ${scrollValue}%)`;
}

const scrollBtn = document.getElementById("progress");
if (scrollBtn) {
    scrollBtn.addEventListener("click", () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
}

window.addEventListener("scroll", calcScrollValue, { passive: true });
window.addEventListener("load", calcScrollValue);

// ===== DOM Elements =====
const searchInput = document.querySelector(".search_input");
const cartCountEl = document.getElementById("cartCount");
const cartItemsEl = document.getElementById("cartItems");
const totalPriceEl = document.getElementById("totalPrice");
const cartPopup = document.getElementById("cartPopup");

// ===== Cart Array =====
let cart = [];

// ===== Search Functionality =====
if (searchInput) {
    const cards = document.querySelectorAll(".card-container"); // خزّن الكروت مرة واحدة
    searchInput.addEventListener("input", () => {
        const value = searchInput.value.toLowerCase();
        cards.forEach(card => {
            const name = card.dataset.name.toLowerCase();
            card.style.display = name.includes(value) ? "block" : "none";
        });
    });
}

// ===== Add To Cart =====
function addToCart(product_id, name, price, quantity = 1, flavor = "") {
    let existing = cart.find(item => item.product_id == product_id && item.flavor == flavor);
    if (existing) {
        existing.quantity += quantity;
    } else {
        cart.push({
            product_id,
            name,
            price: parseFloat(price),
            quantity,
            flavor,
            note: ""
        });
    }
    renderCart();
}

// ===== Render Cart =====
function renderCart() {
    if (!cartItemsEl || !totalPriceEl || !cartCountEl) return;

    cartItemsEl.innerHTML = "";
    let total = 0, count = 0;

    cart.forEach((item, index) => {
        let price = parseFloat(item.price) || 0;
        let quantity = parseInt(item.quantity) || 0;
        total += price * quantity;
        count += quantity;

        const li = document.createElement("li");
        li.innerHTML = `
            <span>${item.name}${item.flavor ? " - " + item.flavor : ""}</span>
            <div class="quantity-control">
                <button class="qty-btn" onclick="decreaseQty(${index})">-</button>
                <span class="qty-number">${quantity}</span>
                <button class="qty-btn" onclick="increaseQty(${index})">+</button>
            </div>
            <input type="text" class="note-input" placeholder="Special note (No ketchup...)" value="${item.note || ""}" oninput="updateNote(${index},this.value)">
            <span>${(price*quantity).toFixed(2)} EGP</span>
            <button class="remove-btn" onclick="removeItem(${index})">X</button>
        `;
        cartItemsEl.appendChild(li);
    });

    totalPriceEl.textContent = total.toFixed(2);
    cartCountEl.textContent = count;
}

// ===== Note Function =====
function updateNote(index, value) {
    cart[index].note = value;
}

// ===== Quantity Functions =====
function increaseQty(index) {
    cart[index].quantity++;
    renderCart();
}

function decreaseQty(index) {
    if(cart[index].quantity > 1) cart[index].quantity--;
    else cart.splice(index, 1);
    renderCart();
}

// ===== Remove Item =====
function removeItem(index) {
    cart.splice(index, 1);
    renderCart();
}

// ===== Clear Cart =====
function clearCart() {
    cart = [];
    renderCart();
}

// ===== Toggle Cart =====
function toggleCart() {
    if(!cartPopup) return;
    cartPopup.style.display = cartPopup.style.display === "block" ? "none" : "block";
}

function closeCart() {
    if(cartPopup) cartPopup.style.display = "none";
}

// ===== Confirm Order =====
function confirmOrder() {
    if(cart.length === 0) { alert("Your cart is empty!"); return; }
    fetch("save_order.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ cart: cart })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            alert("Order placed! Order Number: " + data.order_number);
            clearCart();
            closeCart();
        } else {
            alert("Error placing order: " + (data.message || "Unknown"));
        }
    })
    .catch(() => { alert("Server Error!"); });
}

// ===== Add To Cart Buttons & Flavor Handling =====
document.addEventListener("click", function(e){
    const button = e.target.closest(".add-to-cart");
    if(!button) return;

    const text = button.querySelector("span");
    const card = button.closest(".card-container");
    const selectFlavor = card.querySelector(".flavor-select");
    let flavor = "";

    if(selectFlavor && selectFlavor.value){
        flavor = selectFlavor.selectedOptions[0].dataset.name;
    }

    addToCart(button.dataset.id, button.dataset.name, button.dataset.price, 1, flavor);

    button.classList.add("clicked");
    if(text) text.textContent = "Done";

    setTimeout(()=>{
        button.classList.remove("clicked");
        if(text) text.textContent = "Add To Cart";
    },1000);
});

// ===== Flavor Change Function =====
function changeFlavorImage(img, newSrc){
    img.classList.add("flavor-change");
    setTimeout(()=>{
        img.src = newSrc;
        img.classList.remove("flavor-change");
        img.classList.add("flavor-show");
        setTimeout(()=>{ img.classList.remove("flavor-show"); }, 300);
    }, 200);
}

document.querySelectorAll(".flavor-select").forEach(select => {
    select.addEventListener("change", function() {
        const card = this.closest(".card-container");
        const img = card.querySelector("img");
        const title = card.querySelector("h2");
        const priceEl = card.querySelector("h6 span");
        const selectedOption = this.selectedOptions[0];

        if(selectedOption.value){
            let flavorName = selectedOption.dataset.name;
            changeFlavorImage(img, "images/" + selectedOption.dataset.image);
            priceEl.textContent = selectedOption.dataset.price + " EGP";
            title.textContent = title.dataset.originalName + " - " + flavorName;
        } else {
            changeFlavorImage(img, card.dataset.defaultImage);
            priceEl.textContent = card.dataset.defaultPrice + " EGP";
            title.textContent = title.dataset.originalName;
        }
    });
});

// ===== Navbar Scroll Effect =====
const nav = document.querySelector("header nav");
window.addEventListener("scroll", () => {
    if(window.scrollY > 50) nav.classList.add("scrolled");
    else nav.classList.remove("scrolled");
});