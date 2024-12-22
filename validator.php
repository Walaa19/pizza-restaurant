<?php
class Validator {
    public function validateProfileData($data) {
        if (empty($data['username'])) {
            throw new Exception("Username is required");
        }
        
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Valid email is required");
        }
        
        if (empty($data['phone_number']) || !preg_match("/^[0-9]{11}$/", $data['phone_number'])) {
            throw new Exception("Valid phone number is required (11 digits)");
        }
        
        return true;
    }

    public function validatePassword($password) {
        if (strlen($password) < 8) {
            throw new Exception("Password must be at least 8 characters long");
        }
        
        if (!preg_match("/[A-Z]/", $password)) {
            throw new Exception("Password must contain at least one uppercase letter");
        }
        
        if (!preg_match("/[a-z]/", $password)) {
            throw new Exception("Password must contain at least one lowercase letter");
        }
        
        if (!preg_match("/[0-9]/", $password)) {
            throw new Exception("Password must contain at least one number");
        }
        
        return true;
    }
}