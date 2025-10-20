<?php
header("Content-Type: application/json");
include "config.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['username']) || !isset($data['password'])) {
    echo json_encode(["success" => false, "message" => "Missing username or password"]);
    exit;
}

$username = trim($data['username']);
$password = trim($data['password']);

// Query user
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["success" => false, "message" => "User not found in database."]);
    exit;
}

$row = $result->fetch_assoc();
$db_password = $row['password'];

// Direct (plaintext) comparison
if ($password === $db_password) {
    echo json_encode(["success" => true, "message" => "Login successful."]);
} else {
    echo json_encode(["success" => false, "message" => "Password doesn't match."]);
}

$stmt->close();
$conn->close();
?>
