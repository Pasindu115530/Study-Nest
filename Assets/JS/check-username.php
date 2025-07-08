<?php

    $con = new mysqli('127.0.0.1', 'root', '', 'userportal');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_GET['username'] ?? '';
    $username = $conn->real_escape_string($username);

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "❌ Username already taken";
    } else {
        echo "✅ Username available";
    }

    $conn->close();

?>