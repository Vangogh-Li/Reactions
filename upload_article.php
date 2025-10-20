<?php
include 'config.php';

$title = $_POST['title'];
$author = $_POST['author'];
$content = $_POST['content'];
$slot = $_POST['slot'];

$imageName = "";
if (!empty($_FILES['image']['name'])) {
    $imageName = time() . "_" . basename($_FILES['image']['name']);
    $target = "uploads/" . $imageName;
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
}

// Check if slot already exists and update, otherwise insert
$checkSql = "SELECT id FROM articles WHERE slot = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("i", $slot);
$checkStmt->execute();
$result = $checkStmt->get_result();

if ($result->num_rows > 0) {
    // Update existing article in this slot
    $sql = "UPDATE articles SET title = ?, author = ?, content = ?, image = ?, created_at = NOW() WHERE slot = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $title, $author, $content, $imageName, $slot);
    $action = "updated";
} else {
    // Insert new article
    $sql = "INSERT INTO articles (title, author, content, image, slot, created_at) 
            VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $title, $author, $content, $imageName, $slot);
    $action = "uploaded";
}

if ($stmt->execute()) {
    echo " Article {$action} successfully in slot {$slot}!";
} else {
    echo " Error: " . $stmt->error;
}
$conn->close();
?>
