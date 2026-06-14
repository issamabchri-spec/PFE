<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="navbar">
    <h2>MyRestaurant</h2>

    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="index.html#menu">Menu</a>
        <a href="cart.php">Cart</a>
       <!-- <a href="../auth/login.php">Login</a> -->
    </div>
</div>

<h1 class="title">Checkout</h1>

<main class="checkout-layout">
    <section class="checkout-panel">
        <h2>Customer Details</h2>

        <form id="checkout-form">
            <label for="customer-name">Full Name</label>
            <input type="text" id="customer-name" required>

            <label for="customer-phone">Phone Number</label>
            <input type="tel" id="customer-phone" required>

            <label for="customer-address">Delivery Address</label>
            <textarea id="customer-address" rows="4" required></textarea>

            <label for="customer-note">Order Note</label>
            <textarea id="customer-note" rows="3" placeholder="Optional"></textarea>

            <button type="submit" class="checkout-btn">Confirm Order</button>
        </form>
    </section>

    <section class="checkout-panel">
        <h2>Order Summary</h2>
        <div id="checkout-summary"></div>
        <h3 id="checkout-total"></h3>
    </section>
</main>

<script src="../assets/js/checkout.js"></script>

</body>
</html>
