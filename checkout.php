<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    // Get cart ID
    $stmt = $conn->prepare("SELECT id FROM cart WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $cart = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($cart) {
        // Start transaction
        $conn->beginTransaction();
        
        try {
            // Delete all items from cart
            $stmt = $conn->prepare("DELETE FROM cart_items WHERE cart_id = :cart_id");
            $stmt->bindParam(':cart_id', $cart['id']);
            $stmt->execute();
            
            // Delete the cart itself
            $stmt = $conn->prepare("DELETE FROM cart WHERE id = :cart_id");
            $stmt->bindParam(':cart_id', $cart['id']);
            $stmt->execute();
            
            // Commit transaction
            $conn->commit();
            
            echo json_encode(['success' => true, 'message' => 'Order completed successfully']);
        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollBack();
            throw $e;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Cart not found']);
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>