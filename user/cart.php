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
    <a href="index.php#home">Home</a>
    <a href="index.php#menu">Menu</a>
    <a href="cart.php">Cart 🛒 <span id="cart-badge" style="background: red; color: white; border-radius: 50%; padding: 2px 7px; font-size: 12px; font-weight: bold;">0</span></a>
   <!-- <a href="../auth/login.php">Login</a> -->
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
