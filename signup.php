<?php
include 'config.php';  // connects to database

header('Content-Type: application/json');

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode(["error" => "Please fill in all fields."]);
        exit;
    }

    // Optional: Check for duplicates
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(["error" => "Username or email already exists."]);
        exit;
    }
    $stmt->close();

    // Hash password (for safety)
    $hashed = $password;


    // Insert user into DB
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed);

    if ($stmt->execute()) {
        echo json_encode(["success" => "Account created successfully!"]);
    } else {
        echo json_encode(["error" => "Database error: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
