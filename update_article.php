<?php
header("Content-Type: application/json");
include "config.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id']) || !isset($data['title']) || !isset($data['author']) || !isset($data['content'])) {
    echo json_encode(["success" => false, "message" => "Missing required fields."]);
    exit;
}

$id = intval($data['id']);
$title = $data['title'];
$author = $data['author'];
$content = $data['content'];

$stmt = $conn->prepare("UPDATE articles SET title=?, author=?, content=? WHERE id=?");
$stmt->bind_param("sssi", $title, $author, $content, $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Article updated successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to update article: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
