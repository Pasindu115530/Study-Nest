<?php
<<<<<<< Updated upstream
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
=======
$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$department = $_POST['department'] ?? '';
$username = $_POST['username'] ?? '';
$mailaddress = $_POST['mailaddress'] ?? '';
$pnumber = $_POST['pnumber'] ?? '';
$password = $_POST['password'] ?? '';
$pwconfirm = $_POST['pwconfirm'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($password !== $pwconfirm) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Database connection
>>>>>>> Stashed changes
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "userportal";

<<<<<<< Updated upstream
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





=======
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (fname, lname, department, username, email, pnumber, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $fname, $lname, $department, $username, $mailaddress, $pnumber, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('Signup successful! Redirecting to login page...'); window.location.href='loginpage.php';</script>";
        } else {
            echo "<script>alert('Signup failed!');</script>";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
>>>>>>> Stashed changes
