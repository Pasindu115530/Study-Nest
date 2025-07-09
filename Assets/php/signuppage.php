<?php
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $department = $_POST['department'];
    $year = $_POST['year'];
    $username = $_POST['username'];
    $mailaddress = $_POST['mailaddress'];
    $pnumber = $_POST['pnumber'];
    $password = $_POST['password'];
    $pwconfirm = $_POST['pwconfirm'];
    $signup_date = date('Y-m-d H:i:s'); 

    if ($password !== $pwconfirm) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Database connection parameters
        $servername = "127.0.0.2";
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
        $role = 'user';
        $stmt = $conn->prepare("INSERT INTO users (fname, lname, department, username, email, pnumber, password , role ,year,signuptime ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $fname, $lname, $department, $username, $mailaddress, $pnumber, $password , $role , $year ,  $signup_date);
            
        $stmt->execute();
        header("Location: ../../login.html");
        exit();
        $stmt->close();
        $conn->close();
        }
    

?>





