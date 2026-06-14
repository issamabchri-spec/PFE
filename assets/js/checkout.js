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

    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    // hma3 data dial form
    const formData = {
        customerName: document.getElementById("customer-name").value.trim(),
        customerPhone: document.getElementById("customer-phone").value.trim(),
        customerAddress: document.getElementById("customer-address").value.trim(),
        customerNote: document.getElementById("customer-note").value.trim(),
        items: cart //
    };

    // Fetch api
    fetch("place_order.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Order placed successfully! 🎉 Your order number is: " + data.order_id);
            localStorage.removeItem("cart"); // Clear the cart once the mission is successful
            window.location.href = "index.php"; // Redirect back to the menu
        } else {
            alert("error accured: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred while connecting to the server!");
    });
});

