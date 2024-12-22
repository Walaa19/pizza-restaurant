<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $username = $_POST['username'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    // Validate inputs
    if (empty($username) || empty($address) || empty($phone_number) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }

    // Enforce password length rule (at least 8 characters)
    if (strlen($password) < 8) {
        echo json_encode(['success' => false, 'message' => 'Password must be at least 8 characters long.']);
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Insert user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, address, phone_number, password) VALUES (:username, :address, :phone_number, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Registration successful.']);
    } catch (PDOException $e) {
        // Handle duplicate username error
        if ($e->getCode() == 23000) {
            echo json_encode(['success' => false, 'message' => 'Username already exists.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Registration failed: ' . $e->getMessage()]);
        }
    }
}
?>
