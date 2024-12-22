<?php
require_once 'database.php';

class User {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();
    }

    public function getUserById($userId) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            throw new Exception("Error fetching user: " . $e->getMessage());
        }
    }

    public function updateProfile($userId, $data) {
        try {
            $sql = "UPDATE users SET 
                    username = :username,
                    email = :email,
                    address = :address,
                    phone_number = :phone_number
                    WHERE id = :id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $data['username']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':address', $data['address']);
            $stmt->bindParam(':phone_number', $data['phone_number']);
            $stmt->bindParam(':id', $userId);
            
            return $stmt->execute();
        } catch(PDOException $e) {
            throw new Exception("Error updating profile: " . $e->getMessage());
        }
    }

    public function updatePassword($userId, $newPassword) {
        try {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("UPDATE users SET password = :password WHERE id = :id");
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':id', $userId);
            return $stmt->execute();
        } catch(PDOException $e) {
            throw new Exception("Error updating password: " . $e->getMessage());
        }
    }

    public function verifyPassword($userId, $currentPassword) {
        try {
            $stmt = $this->conn->prepare("SELECT password FROM users WHERE id = :id");
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return password_verify($currentPassword, $user['password']);
        } catch(PDOException $e) {
            throw new Exception("Error verifying password: " . $e->getMessage());
        }
    }

    public function deleteAccount($userId) {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        // Update the user record to mark it as deleted
        $stmt = $conn->prepare("UPDATE users SET is_deleted = 1 WHERE id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
    }
}