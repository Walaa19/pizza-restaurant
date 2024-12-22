<?php
$host = 'localhost';
$dbname = 'baba_johns'; // Replace with your database name
$username = 'root'; // Default username for XAMPP
$password = ''; // Default password for XAMPP

try {
    // Create a connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection errors
    die("Database connection failed: " . $e->getMessage());
}
?>
