<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "bronxscience";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}
?>
