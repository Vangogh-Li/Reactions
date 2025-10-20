<?php
header("Content-Type: application/json");
include "config.php";

if (!isset($_POST['id'])) {
    echo json_encode(["success" => false, "message" => "Missing article ID."]);
    exit;
}

$id = intval($_POST['id']);

$stmt = $conn->prepare("DELETE FROM articles WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Article deleted successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to delete article: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
