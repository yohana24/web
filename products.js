// ===== Scroll Progress =====
// دالة لحساب نسبة التمرير وعرض الدائرة التي تعكس تقدم التمرير
function calcScrollValue() {
    const scrollProgress = document.getElementById("progress"); // العنصر الدائري
    if (!scrollProgress) return; // لو العنصر مش موجود نرجع

    const pos = window.scrollY; // المسافة المقطوعة من أعلى الصفحة
    const calcHeight = document.documentElement.scrollHeight - window.innerHeight; // الطول الكلي للصفحة - ارتفاع الشاشة
    const scrollValue = Math.round((pos * 100) / calcHeight); // نسبة التمرير %

    // اظهار العنصر بعد التمرير أكثر من 100 بكسل
    scrollProgress.style.display = pos > 100 ? "grid" : "none";
    // رسم النسبة داخل العنصر باستخدام conic-gradient
    scrollProgress.style.background = `conic-gradient(#03A7E0 ${scrollValue}%, #d7d7d7 ${scrollValue}%)`;
}

// ===== Scroll To Top Button =====
// الضغط على الدائرة يرجع الصفحة للأعلى smoothly
const scrollBtn = document.getElementById("progress");
if (scrollBtn) {
    scrollBtn.addEventListener("click", () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
}

// تحديث التقدم عند التمرير والتحميل
window.addEventListener("scroll", calcScrollValue, { passive: true });
window.addEventListener("load", calcScrollValue);


// العناصر الرئيسية من الصفحة متغيرات
const searchInput = document.querySelector(".search_input");
const cartCountEl = document.getElementById("cartCount");
const cartItemsEl = document.getElementById("cartItems");
const totalPriceEl = document.getElementById("totalPrice");
const cartPopup = document.getElementById("cartPopup");

//  تخزين العناصر المضافة للسلة
let cart = [];

// البحث جوا المنتجات وعرض الكروت 
if (searchInput) {
    const cards = document.querySelectorAll(".card-container"); // كل كروت المنتجات
    searchInput.addEventListener("input", () => {
        const value = searchInput.value.toLowerCase();
        cards.forEach(card => {
            const name = card.dataset.name.toLowerCase();
            card.style.display = name.includes(value) ? "block" : "none"; // إظهار أو اخفاء الكارت
        });
    });
}

//  اضافة منتج للسلة
function addToCart(product_id, name, price, quantity = 1, flavor = "") {
    let existing = cart.find(item => item.product_id == product_id && item.flavor == flavor);
    if (existing) {
        existing.quantity += quantity; // لو موجود نزود الكمية
    } else {
        cart.push({
            product_id,
            name,
            price: parseFloat(price),
            quantity,
            flavor,
            note: "" // ملاحظات المستخدم
        });
    }
    renderCart(); // تحديث عرض السلة
}

// تحديث محتوى السلة على الصفحة
function renderCart() {
    if (!cartItemsEl || !totalPriceEl || !cartCountEl) return;

    cartItemsEl.innerHTML = ""; // مسح العناصر القديمة
    let total = 0, count = 0;

    cart.forEach((item, index) => {
        let price = parseFloat(item.price) || 0;
        let quantity = parseInt(item.quantity) || 0;
        total += price * quantity;
        count += quantity;

        const li = document.createElement("li");
        li.innerHTML = `
            <!-- اسم المنتج، ولو فيه نكهة نضيفها -->
            <span>${item.name}${item.flavor ? " - " + item.flavor : ""}</span>

            <!-- تحكم بالكمية: زر لزيادة ونقصان الكمية -->
            <div class="quantity-control">
                <button class="qty-btn" onclick="decreaseQty(${index})">-</button>
                <span class="qty-number">${quantity}</span>
                <button class="qty-btn" onclick="increaseQty(${index})">+</button>
            </div>
                <!-- حقل لإضافة ملاحظات -->
            <input type="text" class="note-input" placeholder="Special note (write any note)" value="${item.note || ""}" oninput="updateNote(${index},this.value)">
            <!-- السعر الإجمالي لهذا المنتج (السعر × الكمية) -->
            <span>${(price*quantity).toFixed(2)} EGP</span>
            <!-- زر إزالة المنتج من السلة -->
            <button class="remove-btn" onclick="removeItem(${index})">X</button>
        `;
        cartItemsEl.appendChild(li);
    });

    totalPriceEl.textContent = total.toFixed(2); // إجمالي السعر
    cartCountEl.textContent = count; // عدد العناصر
}

// تحديث الملاحظة الخاصة بكل منتج
function updateNote(index, value) {
    cart[index].note = value;
}

// زيادة الكمية
function increaseQty(index) {
    cart[index].quantity++;
    renderCart();
}

// تقليل الكمية أو إزالة العنصر لو وصل للصفر
function decreaseQty(index) {
    if(cart[index].quantity > 1) cart[index].quantity--;
    else cart.splice(index, 1);
    renderCart();
}

// إزالة منتج من السلة
function removeItem(index) {
    cart.splice(index, 1);
    renderCart();
}

// مسح جميع العناصر
function clearCart() {
    cart = [];
    renderCart();
}

// فتح وغلق نافذة السلة
function toggleCart() {
    if(!cartPopup) return;
    cartPopup.style.display = cartPopup.style.display === "block" ? "none" : "block";
}

// غلق السلة
function closeCart() {
    if(cartPopup) cartPopup.style.display = "none";
}

// إرسال الطلب للسيرفر
function confirmOrder() {
                                //  لو السلة فاضية، نعرض رسالة ونوقف تنفيذ الدالة
    if(cart.length === 0) { alert("Your cart is empty!"); return; }
                                 //  إرسال البيانات للسيرفر عبر Fetch API
    fetch("save_order.php", {   // ملف PHP اللي هيحفظ الطلب
        method: "POST",         // نوع الطلب: POST
        headers: { "Content-Type": "application/json" },// نوع البيانات اللي هنرسلها: JSON
        body: JSON.stringify({ cart: cart }) // تحويل السلة (array) إلى JSON
    })
     //  قراءة الرد من السيرفر وتحويله إلى JSON
    .then(res => res.json())
    .then(data => {
        if(data.success) {//  لو السيرفر رجع نجاح
            alert("Order placed! Order Number: " + data.order_number);
            clearCart();    // نفّس السلة بعد تأكيد الطلب
            closeCart();    // نفّس السلة بعد تأكيد الطلب
        } else {            // لو فيه خطأ من السيرفر

            alert("Error placing order: " + (data.message || "Unknown"));
        }
    })  // 6️⃣ لو فيه خطأ في الاتصال بالسيرفر
    .catch(() => { alert("Server Error!"); });
}

// التعامل مع زر الإضافة للسلة واختيار النكهات
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

// تغيير صورة المنتج عند اختيار نكهة
function changeFlavorImage(img, newSrc){
    img.classList.add("flavor-change");
    setTimeout(()=>{
        img.src = newSrc;
        img.classList.remove("flavor-change");
        img.classList.add("flavor-show");
        setTimeout(()=>{ img.classList.remove("flavor-show"); }, 300);
    }, 200);
}

// حدث تغيير النكهة
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

// تغيير شكل الـ navbar عند التمرير
const nav = document.querySelector("header nav");
window.addEventListener("scroll", () => {
    if(window.scrollY > 50) nav.classList.add("scrolled");
    else nav.classList.remove("scrolled");
});