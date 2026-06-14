const cartContainer = document.getElementById("cart-container");
const totalEl = document.getElementById("total");
const checkoutLink = document.getElementById("checkout-link");

let cart = getCart();

function getCart() {
    try {
        return JSON.parse(localStorage.getItem("cart")) || [];
    } catch (error) {
        localStorage.removeItem("cart");
        return [];
    }
}

function renderCart() {
    cartContainer.innerHTML = "";

    if (cart.length === 0) {
        cartContainer.innerHTML = `
            <div class="empty-cart">
                <h2>Your cart is empty</h2>
                <a href="index.html#menu" class="checkout-btn">Browse Menu</a>
            </div>
        `;
        totalEl.innerText = "";
        checkoutLink.classList.add("disabled-link");
        return;
    }

    checkoutLink.classList.remove("disabled-link");

    let total = 0;

    cart.forEach((item, index) => {
        const itemName = escapeHTML(item.name);
        const itemImage = escapeHTML(item.image);
        const itemPrice = Number(item.price);
        const itemQuantity = Number(item.quantity);

        total += itemPrice * itemQuantity;

        cartContainer.innerHTML += `
            <div class="cart-item">
                <img src="${itemImage}" width="80" alt="${itemName}">

                <div>
                    <h3>${itemName}</h3>
                    <p>${itemPrice} MAD</p>
                </div>

                <div class="quantity-controls">
                    <button onclick="decreaseQty(${index})" aria-label="Decrease quantity">-</button>
                    <span>${itemQuantity}</span>
                    <button onclick="increaseQty(${index})" aria-label="Increase quantity">+</button>
                </div>

                <button onclick="removeItem(${index})">Remove</button>
            </div>
        `;
    });

    totalEl.innerText = "Total: " + total + " MAD";
}

function increaseQty(index) {
    if (!cart[index]) return;
    cart[index].quantity++;
    saveCart();
}

function decreaseQty(index) {
    if (!cart[index]) return;

    cart[index].quantity--;

    if (cart[index].quantity <= 0) {
        cart.splice(index, 1);
    }

    saveCart();
}

function removeItem(index) {
    if (!cart[index]) return;
    cart.splice(index, 1);
    saveCart();
}

function clearCart() {
    if (cart.length === 0) return;

    const confirmClear = confirm("Clear all items from your cart?");
    if (!confirmClear) return;

    cart = [];
    saveCart();
}

// 👑 الفانكشن الجديدة لي كتقرا الكاش وتصيفط الحساب للـ Navbar
function updateCartBadge() {
    const currentCart = JSON.parse(localStorage.getItem("cart")) || [];
    const totalItems = currentCart.reduce((total, item) => total + item.quantity, 0);
    const badge = document.getElementById("cart-badge");
    if (badge) {
        badge.textContent = totalItems;
    }
}
//
function saveCart() {
    localStorage.setItem("cart", JSON.stringify(cart));
    renderCart();
    updateCartBadge(); // 🔥 Update the badge live as soon as the client reduces or deletes an item
}

function escapeHTML(value) {
    return String(value)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

// Run Render and Badge immediately as soon as the cart page opens
renderCart();
updateCartBadge();
