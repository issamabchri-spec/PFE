const summaryEl = document.getElementById("checkout-summary");
const totalEl = document.getElementById("checkout-total");
const checkoutForm = document.getElementById("checkout-form");

let cart = getCart();

function getCart() {
    try {
        return JSON.parse(localStorage.getItem("cart")) || [];
    } catch (error) {
        localStorage.removeItem("cart");
        return [];
    }
}

function renderSummary() {
    if (cart.length === 0) {
        summaryEl.innerHTML = `
            <div class="empty-cart">
                <h2>No items to checkout</h2>
                <a href="index.html#menu" class="checkout-btn">Browse Menu</a>
            </div>
        `;
        totalEl.innerText = "";
        checkoutForm.querySelector("button").disabled = true;
        return;
    }

    let total = 0;
    summaryEl.innerHTML = "";

    cart.forEach(item => {
        const price = Number(item.price);
        const quantity = Number(item.quantity);
        total += price * quantity;

        summaryEl.innerHTML += `
            <div class="summary-item">
                <span>${escapeHTML(item.name)} x ${quantity}</span>
                <strong>${price * quantity} MAD</strong>
            </div>
        `;
    });

    totalEl.innerText = `Total: ${total} MAD`;
}

checkoutForm.addEventListener("submit", event => {
    event.preventDefault();

    if (cart.length === 0) return;

    const order = {
        id: Date.now(),
        customerName: document.getElementById("customer-name").value.trim(),
        customerPhone: document.getElementById("customer-phone").value.trim(),
        customerAddress: document.getElementById("customer-address").value.trim(),
        customerNote: document.getElementById("customer-note").value.trim(),
        items: cart,
        total: cart.reduce((sum, item) => sum + Number(item.price) * Number(item.quantity), 0),
        status: "pending"
    };

    const orders = getOrders();
    orders.push(order);

    localStorage.setItem("orders", JSON.stringify(orders));
    localStorage.removeItem("cart");

    alert("Order confirmed. Backend saving will be connected later.");
    window.location.href = "index.html";
});

function getOrders() {
    try {
        return JSON.parse(localStorage.getItem("orders")) || [];
    } catch (error) {
        localStorage.removeItem("orders");
        return [];
    }
}

function escapeHTML(value) {
    return String(value)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

renderSummary();
