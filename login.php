<?php
// Start the session to handle user login status
session_start();

// Include the database connection
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate inputs
    if (empty($username) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in both fields.']);
        exit;
    }

    try {
        // Check if the user exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // If user does not exist
        if (!$user) {
            echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
            exit;
        }

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Login successful: store session data
            $_SESSION['user_id'] = $user['id'];
            // Respond with success (the frontend will handle redirection)
            echo json_encode(['success' => true, 'message' => 'Login successful']);
            exit;
        } else {
            // Incorrect password
            echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
            exit;
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        exit;
    }
}
?>
