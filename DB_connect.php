<?php
// Database connection details
$servername = "localhost";
$username   = "root";        // Default user for XAMPP
$password   = "";            // Default password is empty
$dbname     = "db_pract8";   // Your database name

// Create connection using MySQLi (Object-oriented)
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection and handle errors
if ($conn->connect_error) {
    die("<p style='color:red; font-family:Arial;'>❌ Database Connection Failed: " . $conn->connect_error . "</p>");
}
?>
