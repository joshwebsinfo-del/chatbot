<?php
require 'config.php';

// Generate a brand new hash for the word 'password'
$new_hash = password_hash('password', PASSWORD_DEFAULT);

// Update the database
$stmt = $conn->prepare("UPDATE admin SET password = ? WHERE username = 'admin'");
$stmt->bind_param("s", $new_hash);

if ($stmt->execute()) {
    echo "<h3>Success!</h3>";
    echo "<p>The password for the 'admin' user has been successfully reset to: <b>password</b></p>";
    echo "<a href='admin/login.php'>Click here to login</a>";
} else {
    echo "Error updating password: " . $conn->error;
}
?>
