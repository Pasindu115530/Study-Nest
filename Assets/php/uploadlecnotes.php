<?php
<<<<<<< Updated upstream
session_start();
=======
>>>>>>> Stashed changes
$uploadSuccess = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
<<<<<<< Updated upstream
    $conn = new mysqli("localhost", "root", "", "userportal");
=======
    $conn = new mysqli("localhost", "root", "", "studynest");
>>>>>>> Stashed changes
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

<<<<<<< Updated upstream
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
=======
    $module = $_POST["module"];
    $uploadDate = date("Y-m-d H:i:s");
    $filename = basename($_FILES["file"]["name"]);
    $fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if ($fileType !== "pdf") {
        $uploadSuccess = "❌ Only PDF files are allowed.";
    } else {
        // Read file as binary
        $fileData = file_get_contents($_FILES["file"]["tmp_name"]);

        if ($fileData) {
            $stmt = $conn->prepare("INSERT INTO lecture_notes (filename, module, filedata, upload_date) VALUES (?, ?, ?, ?)");
            $null = NULL; // for blob placeholder

            $stmt->bind_param("ssbs", $filename, $module, $null, $uploadDate); // use 'b' for BLOB
            $stmt->send_long_data(2, $fileData); // send the actual blob content to param #3 (index 2)
            
            if ($stmt->execute()) {
                $uploadSuccess = "✅ File uploaded and stored in the database.";
            } else {
                $uploadSuccess = "❌ Upload failed: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $uploadSuccess = "❌ Failed to read file.";
        }
    }

>>>>>>> Stashed changes
    $conn->close();
}
?>

<<<<<<< Updated upstream
<!DOCTYPE html>
<!-- [Keep your existing HTML form exactly as is] -->
=======

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Lecture Notes | StudyNest</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/uploadlecnotes.css">
    
</head>
<body>



<main>
    <div class="upload-card">
        <h2>Upload Lecture Notes</h2><br>

        <?php if ($uploadSuccess): ?>
            <div class="message"><?= htmlspecialchars($uploadSuccess) ?></div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <label for="file">Select a PDF file:</label>
            <input type="file" id="file" name="file" accept="application/pdf" required>

            <label for="module">Select Module:</label>
            <select id="module" name="module" required>
                <option value="" disabled selected>Select a module</option>
                <option value="ai">Artificial Intelligence</option>
                <option value="sda">Software Design Architecture</option>
                <option value="fmsd">Formal Methods in Software Development</option>
                <option value="dcn">Data Communication & Networking</option>
                <option value="wt">Web Technologies</option>
                <option value="ecl">Essentials of Computer Law</option>
                <option value="mc">Mathematics for Computing</option>
                <option value="gp">Group Project</option>
            </select>

            <br><br><br>
            <input type="submit" value="Upload">
        </form>
    </div>
</main>




</body>
</html>
>>>>>>> Stashed changes
