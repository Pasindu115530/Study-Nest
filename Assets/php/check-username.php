<?php
header('Content-Type: application/json');

$conn = new mysqli('127.0.0.1', 'root', '', 'userportal');
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Connection failed']);
    exit;
}

$username = isset($_GET['username']) ? trim($_GET['username']) : '';
$email = isset($_GET['email']) ? trim($_GET['email']) : '';
$phone = isset($_GET['phone']) ? trim($_GET['phone']) : '';

$response = [];

// Username validation
if ($username !== '') {
    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $response['username_available'] = $stmt->num_rows === 0;
    $stmt->close();
}

// Email validation
if ($email !== '') {
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $response['email_available'] = $stmt->num_rows === 0;
    $stmt->close();
}

// Phone number validation
if ($phone !== '') {
    $stmt = $conn->prepare("SELECT phone FROM users WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $stmt->store_result();
    $response['phone_available'] = $stmt->num_rows === 0;
    $stmt->close();
}

$conn->close();
echo json_encode($response);
?>

