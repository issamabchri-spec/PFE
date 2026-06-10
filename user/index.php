
<?php
//Had star kayjib lmassar l7a9i9i dial project
$base_url = "http://" . $_SERVER['HTTP_HOST'] . "/PFE/";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <h2>MyRestaurant 🍽️</h2>

   <div class="nav-links">
    <a href="<?php echo $base_url; ?>user/index.php#home">Home</a>
    <a href="<?php echo $base_url; ?>user/index.php#menu">Menu</a>
    <a href="<?php echo $base_url; ?>user/cart.php">Cart 🛒 <span id="cart-badge" style="background: red; color: white; border-radius: 50%; padding: 2px 7px; font-size: 12px; font-weight: bold;">0</span></a>
    <a href="<?php echo $base_url; ?>auth/login.php">Login</a>
</div>
</div>

<!-- HOME SECTION -->
<section id="home" class="hero">
    <h1>🍽️ Welcome to MyRestaurant</h1>
    <p>Best food experience in Morocco 🇲🇦</p>
    <a href="#menu" class="btn">Order Now 🍕</a>
</section>

<!-- MENU SECTION START -->
<div id="menu">

<!-- TITLE -->
<h1 class="title">🍽️ Our Menu</h1>

<!-- SEARCH BAR -->
<div class="search-box">
    <input type="text" id="search-input" placeholder="Search food... 🔍">
</div>

<!-- CATEGORIES -->
<div class="categories">
    <button data-category="all">All</button>
    <button data-category="pizza">🍕 Pizza</button>
    <button data-category="burger">🍔 Burgers</button>
    <button data-category="moroccan">🇲🇦 Moroccan Food</button>
    <button data-category="drink">🥤 Drinks</button>
</div>

<!-- PIZZA -->
<div class="menu-container">

    <div class="food-card pizza">
        <img src="../assets/images/pizza.jfif">
        <h3>Pizza</h3>
        <span class="badge">Popular 🔥</span>
        <p class="price">50 MAD</p>

        <button class="add-to-cart"
        data-name="Pizza"
        data-price="50"
        data-image="../assets/images/pizza.jfif">
        Add to Cart
        </button>
    </div>

    <div class="food-card pizza">
        <img src="../assets/images/New York">
        <h3>New York Pizza</h3>
        <span class="badge">Big Slice 🍕</span>
        <p class="price">60 MAD</p>

        <button class="add-to-cart"
        data-name="New York Pizza"
        data-price="60"
        data-image="../assets/images/New York">
        Add to Cart
        </button>
    </div>

    <div class="food-card pizza">
        <img src="../assets/images/margharita">
        <h3>Margherita</h3>
        <span class="badge">Classic 🌿</span>
        <p class="price">50 MAD</p>

        <button class="add-to-cart"
        data-name="Margherita"
        data-price="50"
        data-image="../assets/images/margharita">
        Add to Cart
        </button>
    </div>

    <div class="food-card pizza">
        <img src="../assets/images/Neapolitan">
        <h3>Napolitana</h3>
        <span class="badge">Italian 🇮🇹</span>
        <p class="price">65 MAD</p>

        <button class="add-to-cart"
        data-name="Napolitana"
        data-price="65"
        data-image="../assets/images/Neapolitan">
        Add to Cart
        </button>
    </div>

    <div class="food-card pizza">
        <img src="../assets/images/Pepperoni">
        <h3>Pepperoni</h3>
        <span class="badge">Spicy 🔥</span>
        <p class="price">70 MAD</p>

        <button class="add-to-cart"
        data-name="Pepperoni"
        data-price="70"
        data-image="../assets/images/Pepperoni">
        Add to Cart
        </button>
    </div>
</div>

<div class="menu-container">

    <div class="food-card burger">
        <img src="../assets/images/burger.jfif">
        <h3>Burger</h3>
        <span class="badge">New ⭐</span>
        <p class="price">40 MAD</p>

        <button class="add-to-cart"
        data-name="Burger"
        data-price="40"
        data-image="../assets/images/burger.jfif">
        Add to Cart
        </button>
    </div>

    <div class="food-card burger">
        <img src="../assets/images/cheese burger.jfif">
        <h3>Cheese Burger</h3>
        <span class="badge">Cheesy 🧀</span>
        <p class="price">45 MAD</p>

        <button class="add-to-cart"
        data-name="Cheese Burger"
        data-price="45"
        data-image="../assets/images/cheese burger.jfif">
        Add to Cart
        </button>
    </div>

    <div class="food-card burger">
        <img src="../assets/images/Hamburger.jfif">
        <h3>Hamburger</h3>
        <span class="badge">Classic 🍔</span>
        <p class="price">40 MAD</p>

        <button class="add-to-cart"
        data-name="Hamburger"
        data-price="40"
        data-image="../assets/images/Hamburger.jfif">
        Add to Cart
        </button>
    </div>

    <div class="food-card burger">
        <img src="../assets/images/Bacon burger.jfif">
        <h3>Bacon Burger</h3>
        <span class="badge">Smoky 🥓</span>
        <p class="price">55 MAD</p>

        <button class="add-to-cart"
        data-name="Bacon Burger"
        data-price="55"
        data-image="../assets/images/Bacon burger.jfif">
        Add to Cart
        </button>
    </div>

    <div class="food-card burger">
        <img src="../assets/images/Smash burger.jfif">
        <h3>Smash Burger</h3>
        <span class="badge">Juicy 🔥</span>
        <p class="price">60 MAD</p>

        <button class="add-to-cart"
        data-name="Smash Burger"
        data-price="60"
        data-image="../assets/images/Smash burger.jfif">
        Add to Cart
        </button>
    </div>

</div>

<!-- DRINK -->
<div class="menu-container">

    <div class="food-card drink">
        <img src="../assets/images/drink.jfif">
        <h3>Drink</h3>
        <span class="badge">Hot 🔥</span>
        <p class="price">15 MAD</p>

        <button class="add-to-cart"
        data-name="Drink"
        data-price="15"
        data-image="../assets/images/drink.jfif">
        Add to Cart
        </button>
    </div>

    <div class="food-card drink">
        <img src="../assets/images/Coca Cola.jfif">
        <h3>Coca Cola</h3>
        <span class="badge">Cold 🧊</span>
        <p class="price">10 MAD</p>

        <button class="add-to-cart"
        data-name="Coca Cola"
        data-price="10"
        data-image="../assets/images/Coca Cola.jfif">
        Add to Cart
        </button>
    </div>

    <div class="food-card drink">
        <img src="../assets/images/ice coffee.jfif">
        <h3>Ice Coffee</h3>
        <span class="badge">Fresh ☕</span>
        <p class="price">20 MAD</p>

        <button class="add-to-cart"
        data-name="Ice Coffee"
        data-price="20"
        data-image="../assets/images/ice coffee.jfif">
        Add to Cart
        </button>
    </div>

    <div class="food-card drink">
        <img src="../assets/images/mojito.jfif">
        <h3>Mojito</h3>
        <span class="badge">Mint 🍃</span>
        <p class="price">25 MAD</p>

        <button class="add-to-cart"
        data-name="Mojito"
        data-price="25"
        data-image="../assets/images/mojito.jfif">
        Add to Cart
        </button>
    </div>

    <div class="food-card drink">
        <img src="../assets/images/cocktail.jfif">
        <h3>Cocktail</h3>
        <span class="badge">Mix 🍹</span>
        <p class="price">30 MAD</p>

        <button class="add-to-cart"
        data-name="Cocktail"
        data-price="30"
        data-image="../assets/images/cocktail.jfif">
        Add to Cart
        </button>
    </div>
</div>

<!-- MOROCCAN -->
<div class="menu-container">

    <div class="food-card moroccan">
        <img src="../assets/images/tagine.jfif">
        <h3>tagine 🇲🇦</h3>
        <span class="badge">Traditional ⭐</span>
        <p class="price">60 MAD</p>

        <button class="add-to-cart"
        data-name="Tagine"
        data-price="60"
        data-image="../assets/images/tagine.jfif">
        Add to Cart
        </button>
    </div>

    <div class="food-card moroccan">
        <img src="../assets/images/rfissa.jfif">
        <h3>rfissa</h3>
        <span class="badge">Traditional ⭐</span>
        <p class="price">60 MAD</p>

        <button class="add-to-cart"
        data-name="Rfissa"
        data-price="60"
        data-image="../assets/images/rfissa.jfif">
        Add to Cart
        </button>
    </div>

    <div class="food-card moroccan">
        <img src="../assets/images/tanjiya.jfif">
        <h3>tanjiya</h3>
        <span class="badge">Traditional ⭐</span>
        <p class="price">60 MAD</p>

        <button class="add-to-cart"
        data-name="Tanjiya"
        data-price="60"
        data-image="../assets/images/tanjiya.jfif">
        Add to Cart
        </button>
    </div>

    <div class="food-card moroccan">
        <img src="../assets/images/Pastilla.jfif">
        <h3>pastila</h3>
        <span class="badge">Traditional ⭐</span>
        <p class="price">260 MAD</p>

        <button class="add-to-cart"
        data-name="Pastilla"
        data-price="260"
        data-image="../assets/images/Pastilla.jfif">
        Add to Cart
        </button>
    </div>
</div>
<!-- MENU SECTION END -->

<script src="../assets/js/script.js"></script>

</body>
</html>