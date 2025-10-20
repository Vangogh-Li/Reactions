<?php
include 'config.php';

$sql = "SELECT id, title, author, content, image, slot, created_at FROM articles ORDER BY id DESC";
$result = $conn->query($sql);

$articles = [];
while ($row = $result->fetch_assoc()) {
    $articles[] = $row;
}

header('Content-Type: application/json');
echo json_encode($articles);
$conn->close();
?>
