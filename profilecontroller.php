<?php
require_once 'user.php';
require_once 'validator.php';

class ProfileController {
    private $user;
    private $validator;

    public function __construct() {
        $this->user = new User();
        $this->validator = new Validator();
    }

    public function getProfile($userId) {
        try {
            return $this->user->getUserById($userId);
        } catch(Exception $e) {
            throw new Exception("Error retrieving profile: " . $e->getMessage());
        }
    }

    public function updateProfile($userId, $data) {
        try {
            // Validate input data
            $this->validator->validateProfileData($data);
            
            // Update profile
            return $this->user->updateProfile($userId, $data);
        } catch(Exception $e) {
            throw new Exception("Error updating profile: " . $e->getMessage());
        }
    }

    public function updatePassword($userId, $currentPassword, $newPassword) {
        try {
            // Validate password
            $this->validator->validatePassword($newPassword);
            
            // Verify current password
            if (!$this->user->verifyPassword($userId, $currentPassword)) {
                throw new Exception("Current password is incorrect");
            }
            
            // Update password
            return $this->user->updatePassword($userId, $newPassword);
        } catch(Exception $e) {
            throw new Exception("Error updating password: " . $e->getMessage());
        }
    }

    public function deleteAccount($userId, $password) {
        try {
            // Verify password before deletion
            if (!$this->user->verifyPassword($userId, $password)) {
                throw new Exception("Password is incorrect");
            }
            
            return $this->user->deleteAccount($userId);
        } catch(Exception $e) {
            throw new Exception("Error deleting account: " . $e->getMessage());
        }
    }
}