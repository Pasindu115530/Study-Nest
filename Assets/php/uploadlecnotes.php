<?php
session_start();
$uploadSuccess = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "studynest");
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

        // Verify PDF using MIME type
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
