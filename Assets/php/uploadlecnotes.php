<?php
session_start();
$uploadSuccess = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "userportal");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Validate module
    $allowedModules = ['ai', 'sda', 'fmsd', 'dcn', 'wt', 'ecl', 'mc', 'gp'];
    $module = $_POST["module"] ?? '';
    if (!in_array($module, $allowedModules)) {
        $uploadSuccess = "❌ Invalid module selected";
    } else {
        $uploadDate = date("Y-m-d H:i:s");
        $filename = basename($_FILES["file"]["name"]);
        
        // Verify PDF
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);
        finfo_close($finfo);
        
        if ($mime != 'application/pdf') {
            $uploadSuccess = "❌ Only PDF files are allowed";
        } else {
            $fileData = file_get_contents($_FILES["file"]["tmp_name"]);
            
            if ($fileData) {
                $stmt = $conn->prepare("INSERT INTO lecture_notes (filename, module, filedata, upload_date) VALUES (?, ?, ?, ?)");
                $null = NULL;
                $stmt->bind_param("ssbs", $filename, $module, $null, $uploadDate);
                $stmt->send_long_data(2, $fileData);
                
                if ($stmt->execute()) {
                    $_SESSION['uploadSuccess'] = "✅ File uploaded successfully!";
                    header("Location: /study nest/view_notes.php");
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
}
?>

<!DOCTYPE html>
<!-- [Keep your existing HTML form exactly as is] -->