<?php
// Simple login logic using database
session_start(); // Start the session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $_SESSION["username"] = $username; // Store username in session
    
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'userportal');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT password,role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($db_password, $role);
        $stmt->fetch();
        if ($password === $db_password) { // For plain text passwords
            // Redirect based on role
            if ($role === 'admin') {
                header('Location: /Study Nest/dashboardcontentadmin.php');
            } else {
                header('Location: /Study Nest/dashboardcontentuser.php');          }
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
    $stmt->close();
    $conn->close();
}
?>

