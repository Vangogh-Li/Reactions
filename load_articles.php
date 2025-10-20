<?php
header('Content-Type: application/json');
include 'config.php';

$result = $conn->query("SELECT * FROM articles ORDER BY slot ASC");
$articles = [];

while ($row = $result->fetch_assoc()) {
  $articles[$row['slot']] = $row;
}

// Ensure we have all slots 1-9 for the new layout
for ($i = 1; $i <= 9; $i++) {
  if (!isset($articles[$i])) {
    $articles[$i] = null;
  }
}

echo json_encode($articles);
?>
