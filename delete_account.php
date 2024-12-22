<?php
session_start();
require_once 'ProfileController.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit;
}

try {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['password'])) {
        throw new Exception('Password is required');
    }
    
    $profileController = new ProfileController();
    $profileController->deleteAccount($_SESSION['user_id'], $data['password']);
    
    // Clear session
    session_destroy();
    
    echo json_encode([
        'success' => true,
        'message' => 'Account deleted successfully'
    ]);
} catch(Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}