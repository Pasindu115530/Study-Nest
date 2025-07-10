<?php
// Verify the request is valid
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request");
}

// Database connection
$conn = new mysqli("localhost", "root", "", "userportal");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT filename, filedata FROM lecture_notes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($filename, $filedata);
    $stmt->fetch();
    
    header("Content-Type: application/pdf");
    header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\"");
    echo $filedata;
} else {
    die("File not found");
}

$stmt->close();
$conn->close();
?>