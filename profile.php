<?php
session_start();
require_once 'ProfileController.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$profileController = new ProfileController();

try {
    $user = $profileController->getProfile($_SESSION['user_id']);
} catch(Exception $e) {
    $error = $e->getMessage();
}
?>
