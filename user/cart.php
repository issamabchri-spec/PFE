<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="navbar">
    <h2>MyRestaurant</h2>

    <div class="nav-links">
        <a href="index.html">Home</a>
        <a href="index.html#menu">Menu</a>
        <a href="cart.php">Cart</a>
        <a href="../auth/login.php">Login</a>
    </div>
</div>

<h1 class="title">Your Cart</h1>

<div id="cart-container"></div>

<h2 id="total" style="text-align:center; margin-top:20px;"></h2>

<div class="cart-actions">
    <button onclick="clearCart()" class="secondary-btn">Clear Cart</button>
    <a href="checkout.php" class="checkout-btn" id="checkout-link">Checkout</a>
</div>

<script src="../assets/js/cart.js"></script>

</body>
</html>
