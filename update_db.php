<?php
require 'config.php';

// Create Unanswered Queries table
$sql1 = "CREATE TABLE IF NOT EXISTS unanswered_queries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    asked_count INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Create Leads table
$sql2 = "CREATE TABLE IF NOT EXISTS leads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Create Chat Logs table (for Analytics)
$sql3 = "CREATE TABLE IF NOT EXISTS chat_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message TEXT NOT NULL,
    type ENUM('user', 'bot') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql1) && $conn->query($sql2) && $conn->query($sql3)) {
    echo "Database updated successfully with new tables for premium features!";
} else {
    echo "Error updating database: " . $conn->error;
}
?>
