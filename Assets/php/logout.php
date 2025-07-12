<?php
// logout.php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'userportal');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if we have login data to record
if (isset($_SESSION['login_month']) && isset($_SESSION['login_time'])) {
    
    $month = $_SESSION['login_month'] ?? null;
$login_time = $_SESSION['login_time'] ?? null;
$logout_time = date('H:i:s');

    // Calculate session duration
    $duration = strtotime($logout_time) - strtotime($login_time);
    $hours = floor($duration / 3600);
    $minutes = floor(($duration % 3600) / 60);
    $seconds = $duration % 60;
    $formatted_duration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    
    // Insert into datatime table
    $stmt = $conn->prepare("INSERT INTO datatime (month, login_time, logout_time,duration) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss",$month, $login_time, $logout_time,$formatted_duration);
    $stmt->execute();
    $stmt->close();
}

// Clear all session data
session_unset();
session_destroy();

// Prevent page caching
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Redirect to homepage
header("Location: /study nest/HomePage.html");
exit();
?>