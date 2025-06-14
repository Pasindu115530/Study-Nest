<?php
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $department = $_POST['department'];
    $username = $_POST['username'];
    $mailaddress = $_POST['mailaddress'];
    $pnumber = $_POST['pnumber'];
    $password = $_POST['password'];
    $pwconfirm = $_POST['pwconfirm'];

    if ($password !== $pwconfirm) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
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
        else{
        // Prepare and bind
        $role = 'user';
        $stmt = $conn->prepare("INSERT INTO users (fname, lname, department, username, email, pnumber, password , role  ) VALUES (?, ?, ?, ?, ?, ?, ?,?)");
        $stmt->bind_param("ssssssss", $fname, $lname, $department, $username, $mailaddress, $pnumber, $password , $role);
            
        $stmt->execute();
        header("Location: login.html");
        exit();
        $stmt->close();
        $conn->close();
        }
    }

?>





