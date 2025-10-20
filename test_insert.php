<?php
include('config.php'); // ensures DB connection

// Fake data for testing
$username = "TestUser";
$email = "testuser" . rand(100,999) . "@example.com";
$password = password_hash("password123", PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $password);

if ($stmt->execute()) {
    echo "Test user inserted successfully:<br>";
    echo "Username: $username<br>Email: $email<br>";
} else {
    echo "Failed to insert user: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
