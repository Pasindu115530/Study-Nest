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

// First, get the filename for confirmation message
$stmt = $conn->prepare("SELECT filename FROM lecture_notes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($filename);
    $stmt->fetch();
    $stmt->close();
    
    // Delete the record
    $delete_stmt = $conn->prepare("DELETE FROM lecture_notes WHERE id = ?");
    $delete_stmt->bind_param("i", $id);
    
    $delete_stmt->execute();
    $delete_stmt->close();
    
    // Display success message
    echo "File '" . htmlspecialchars($filename) . "' has been deleted successfully.<br>";
    echo "<a href='view_notes.php'>Back to main page</a>";
} else {
    die("File not found");
}

$conn->close();
?>