<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"] ?? null;
    $lname = $_POST["lname"] ?? null;
    $username = $_POST["username"] ?? null;
    $mailaddress = $_POST["mailaddress"] ?? null;
    $pnumber = $_POST["pnumber"] ?? null;
    $password = $_POST["password"] ?? null;
    $pwconfirm = $_POST["pwconfirm"] ?? null;

    // Validation: check if required fields are filled
    if (!$fname || !$lname || !$username || !$mailaddress || !$password || !$pwconfirm) {
        die("Please fill in all required fields.");
    }

    if ($password !== $pwconfirm) {
        die("Passwords do not match.");
    }

    // Database connection parameters
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "userportal";

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $role = 'admin';
    $department = '';
    $stmt = $conn->prepare("INSERT INTO users (fname, lname, department, username, email, pnumber, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $fname, $lname, $department, $username, $mailaddress, $pnumber, $hashed_password, $role);
    $stmt->execute();
    header('Location: /study%20Nest/adminusercontrolpanel.html');
    exit();
    $stmt->close();
    $conn->close();
        } 
?>