<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "menu_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the charset to utf8mb4 for full Unicode support
$conn->set_charset("utf8mb4");
?>
