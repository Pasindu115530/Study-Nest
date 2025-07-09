<?php
session_start();
$uploadSuccess = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "userportal");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
        $module = $_POST["module"] ?? '';
        $uploadDate = date("Y-m-d H:i:s");
        $filename = basename($_FILES["file"]["name"]);
        $year = $_POST["year"] ?? '';
        $semester = $_POST["semester"] ?? '';
        $department = $_POST["department"] ?? '';
        
        // Verify PDF
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);
        finfo_close($finfo);
        
        if ($mime != 'application/pdf') {
            $uploadSuccess = "❌ Only PDF files are allowed";
        } else {
            $fileData = file_get_contents($_FILES["file"]["tmp_name"]);
            
            if ($fileData) {
                $stmt = $conn->prepare("INSERT INTO lecture_notes (filename, module, filedata, upload_date, year, semester, department) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $null = NULL;
                $stmt->bind_param("ssbsiss", $filename, $module, $null, $uploadDate, $year, $semester, $department);
                $stmt->send_long_data(2, $fileData);
                
                if ($stmt->execute()) {
                    $_SESSION['uploadSuccess'] = "✅ File uploaded successfully!";
                    header("Location: dashboardcontent.php");
                    exit();
                } else {
                    $uploadSuccess = "❌ Upload failed: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $uploadSuccess = "❌ Failed to read file";
            }
        }
    }
    $conn->close();

?>


<!DOCTYPE html>
<!-- [Keep your existing HTML form exactly as is] -->