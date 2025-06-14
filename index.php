<?php
// Simple login logic for demonstration purposes only

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === 'admin') {
        header('Location: adminportal.html');
        exit();
    } elseif ($username === 'user' && $password === 'user') {
        header('Location: userportal.html');
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>