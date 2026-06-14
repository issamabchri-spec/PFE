const searchInput = document.getElementById("search-input");
const categoryButtons = document.querySelectorAll(".categories button");
const cards = document.querySelectorAll(".food-card");
const cartButtons = document.querySelectorAll(".add-to-cart");

let currentCategory = "all";

/* =======================
   FILTER + SEARCH SYSTEM
======================= */

function updateUI() {

    let searchValue = searchInput.value.toLowerCase().trim();

    cards.forEach(card => {

        let title = card.querySelector("h3").textContent.toLowerCase();

        let cardCategory =
            card.classList.contains("pizza") ? "pizza" :
            card.classList.contains("burger") ? "burger" :
            card.classList.contains("drink") ? "drink" :
            card.classList.contains("moroccan") ? "moroccan" :
            "";

        let matchSearch = title.includes(searchValue);
        let matchCategory = currentCategory === "all" || cardCategory === currentCategory;

        if (matchSearch && matchCategory) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
}

/* SEARCH */
searchInput.addEventListener("input", updateUI);

/* CATEGORY FILTER */
categoryButtons.forEach(button => {
    button.addEventListener("click", () => {

        categoryButtons.forEach(btn => btn.classList.remove("active"));
        button.classList.add("active");

        let cat = button.dataset.category;

        currentCategory = cat;

        updateUI();
    });
});






/* ==========================================================================
   👑 LIVE CART BADGE SYSTEM
   ========================================================================== */
function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    let totalItems = 0;
    cart.forEach(item => {
        totalItems += item.quantity ? Number(item.quantity) : 1;
    });
    const badge = document.getElementById("cart-badge");
    if (badge) {
        badge.textContent = totalItems;
    }
}
// 
document.addEventListener("DOMContentLoaded", updateCartBadge);

/* =======================
   CART SYSTEM
======================= */
cartButtons.forEach(button => {
    button.addEventListener("click", () => {

        const name = button.dataset.name;
        const price = Number(button.dataset.price);
        const image = button.dataset.image;

        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        let existingItem = cart.find(item => item.name === name);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                name,
                price,
                image,
                quantity: 1
            });
        }

        localStorage.setItem("cart", JSON.stringify(cart));

        // 🔥
        updateCartBadge();
    });
});