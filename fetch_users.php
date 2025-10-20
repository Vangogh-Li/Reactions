<?php
header("Content-Type: application/json");
include "config.php";

$result = $conn->query("SELECT id, username, email, password, created_at FROM users ORDER BY id ASC");

if (!$result) {
    echo json_encode(["error" => "Database query failed: " . $conn->error]);
    exit;
}

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);
$conn->close();
?>
