<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit;
}

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
$user_id = $_SESSION['user_id'];
$item_name = $data['item_name'];
$item_price = $data['item_price'];

try {
    // Check if cart exists for user
    $stmt = $conn->prepare("SELECT id FROM cart WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $cart = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$cart) {
        // Create new cart
        $stmt = $conn->prepare("INSERT INTO cart (user_id) VALUES (:user_id)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $cart_id = $conn->lastInsertId();
    } else {
        $cart_id = $cart['id'];
    }
    
    // Check if item already exists in cart
    $stmt = $conn->prepare("SELECT * FROM cart_items WHERE cart_id = :cart_id AND item_name = :item_name");
    $stmt->bindParam(':cart_id', $cart_id);
    $stmt->bindParam(':item_name', $item_name);
    $stmt->execute();
    $existing_item = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($existing_item) {
        // Update quantity
        $stmt = $conn->prepare("UPDATE cart_items SET quantity = quantity + 1 WHERE id = :id");
        $stmt->bindParam(':id', $existing_item['id']);
        $stmt->execute();
    } else {
        // Add new item
        $stmt = $conn->prepare("INSERT INTO cart_items (cart_id, item_name, item_price, quantity) VALUES (:cart_id, :item_name, :item_price, 1)");
        $stmt->bindParam(':cart_id', $cart_id);
        $stmt->bindParam(':item_name', $item_name);
        $stmt->bindParam(':item_price', $item_price);
        $stmt->execute();
    }
    
    echo json_encode(['success' => true, 'message' => 'Item added to cart successfully']);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>