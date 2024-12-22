<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$item_id = $data['item_id'];

try {
    // Verify the item belongs to the user's cart
    $stmt = $conn->prepare("
        DELETE ci FROM cart_items ci 
        JOIN cart c ON ci.cart_id = c.id 
        WHERE ci.id = :item_id AND c.user_id = :user_id
    ");
    $stmt->bindParam(':item_id', $item_id);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    
    echo json_encode(['success' => true, 'message' => 'Item removed successfully']);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>