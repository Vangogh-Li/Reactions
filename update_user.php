<?php
header("Content-Type: application/json");
include "config.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id']) || !isset($data['username']) || !isset($data['email']) || !isset($data['password'])) {
    echo json_encode(["success" => false, "message" => "Missing required fields"]);
    exit;
}

$id = intval($data['id']);
$username = $data['username'];
$email = $data['email'];
$password = $data['password'];

// Update query
$stmt = $conn->prepare("UPDATE users SET username=?, email=?, password=? WHERE id=?");
$stmt->bind_param("sssi", $username, $email, $password, $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "User updated successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Update failed: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
