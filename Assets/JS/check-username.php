<?php
// No whitespace before this line!
header('Content-Type: application/json');

$response = [];

// Database connection
$conn = new mysqli('127.0.0.1', 'root', '', 'userportal');
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Connection failed']);
    exit;
}

$username = isset($_GET['username']) ? trim($_GET['username']) : '';

if ($username === '') {
    http_response_code(400);
    echo json_encode(['error' => 'No username provided']);
    $conn->close();
    exit;
}

$stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

$response = ['available' => $stmt->num_rows === 0];

$stmt->close();
$conn->close();
echo json_encode($response);
?>

