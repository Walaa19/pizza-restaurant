<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit;
}

try {
    // Get cart ID
    $stmt = $conn->prepare("SELECT id FROM cart WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $cart = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($cart) {
        // Delete all items from cart
        $stmt = $conn->prepare("DELETE FROM cart_items WHERE cart_id = :cart_id");
        $stmt->bindParam(':cart_id', $cart['id']);
        $stmt->execute();
        
        echo json_encode(['success' => true, 'message' => 'Cart cleared successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Cart not found']);
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>