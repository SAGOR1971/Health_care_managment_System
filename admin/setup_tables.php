<?php
session_start();
include('../user/config.php');

// Check if admin is logged in
if(!isset($_SESSION['admin'])) {
    echo "<script>
        alert('Please login first!');
        window.location.href='form/login.php';
    </script>";
    exit();
}

// Create about_us table
$about_us_table = "CREATE TABLE IF NOT EXISTS about_us (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    description TEXT,
    mission TEXT,
    vision TEXT,
    address TEXT,
    phone VARCHAR(50),
    email VARCHAR(255),
    working_hours TEXT,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// Create contact_messages table
$contact_messages_table = "CREATE TABLE IF NOT EXISTS contact_messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if(mysqli_query($con, $about_us_table) && mysqli_query($con, $contact_messages_table)) {
    echo "Tables created successfully!";
} else {
    echo "Error creating tables: " . mysqli_error($con);
}
?> 