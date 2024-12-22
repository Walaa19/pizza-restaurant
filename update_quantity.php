<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$item_id = $data['item_id'];
$quantity = $data['quantity'];

if ($quantity < 1) {
    echo json_encode(['success' => false, 'message' => 'Quantity must be at least 1']);
    exit;
}

try {
    // Update quantity for item in user's cart
    $stmt = $conn->prepare("
        UPDATE cart_items ci 
        JOIN cart c ON ci.cart_id = c.id 
        SET ci.quantity = :quantity 
        WHERE ci.id = :item_id AND c.user_id = :user_id
    ");
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':item_id', $item_id);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    
    echo json_encode(['success' => true, 'message' => 'Quantity updated successfully']);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>