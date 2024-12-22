<?php
session_start();
require_once 'ProfileController.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit;
}

try {
    $profileController = new ProfileController();
    $data = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'address' => $_POST['address'],
        'phone_number' => $_POST['phone_number']
    ];
    
    // Update profile
    $profileController->updateProfile($_SESSION['user_id'], $data);
    
    // Update password if provided
    if (!empty($_POST['new_password'])) {
        $profileController->updatePassword(
            $_SESSION['user_id'],
            $_POST['current_password'],
            $_POST['new_password']
        );
    }
    
    echo json_encode([
        'success' => true,
        'message' => 'Profile updated successfully'
    ]);
} catch(Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}