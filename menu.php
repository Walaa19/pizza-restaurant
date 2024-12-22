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
    <title>Baba Johns Menu</title>
    <link rel="stylesheet" href="menu.css">
</head>
<body>
    <header>
        <h1>Menu</h1>
        <div class="custom-dropdown">
            <button class="dropdown-button" onclick="toggleDropdown()">All menu</button>
            <ul class="dropdown-list">
                <li onclick="selectOption('all')">All</li>
                <li onclick="selectOption('pizza')">Pizza</li>
                <li onclick="selectOption('dessert')">Dessert</li>
                <li onclick="selectOption('cold-drinks')">Cold Drinks</li>
                <li onclick="selectOption('hot-drinks')">Hot Drinks</li>
            </ul>
        </div>
        <div class="user-section">
            <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="logout.php">Logout</a>
            <img src="cart4.jpg" alt="View Cart" class="cart-img" onclick="location.href='cart.php'">
        </div>
    </header>

    <main>
        <section id="menu">
            <!-- Pizza Section -->
            <div class="section pizza">
                <h2>Pizza</h2>
                <!-- Your existing pizza items -->
            </div>

            <!-- Dessert Section -->
            <div class="section dessert">
                <h2>Desserts</h2>
                <!-- Your existing dessert items -->
            </div>

            <!-- Cold Drinks Section -->
            <div class="section cold-drinks">
                <h2>Cold Drinks</h2>
                <!-- Your existing cold drinks items -->
            </div>

            <!-- Hot Drinks Section -->
            <div class="section hot-drinks">
                <h2>Hot Drinks</h2>
                <!-- Your existing hot drinks items -->
            </div>
        </section>
    </main>

    <script src="cart.js"></script>
    <script src="menu.js"></script>
</body>
</html>