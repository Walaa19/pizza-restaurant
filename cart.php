<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <div class="cart-header">
        <h1>Your Cart</h1>
        <div class="user-info">
            <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="menu.php" class="back-button">Back to menu</a>
        </div>
    </div>

    <main>
        <div class="cart-summary">
            <section id="cartContainer">
                <!-- Items will be dynamically added here -->
            </section>
            <div class="cart-actions">
                <h2>Total Price: <span id="totalPrice">0 LE</span></h2>
                <button class="clear-cart-button" onclick="clearCart()">Clear Cart</button>
                <button class="checkout-button" onclick="checkoutCart()">Checkout</button>
            </div>
        </div>
    </main>

    <script src="cart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", displayCartItems);
    </script>
</body>
</html>