<?php
session_start();
// Display success message if redirected from upload
if (isset($_SESSION['uploadSuccess'])) {
    $successMsg = $_SESSION['uploadSuccess'];
    unset($_SESSION['uploadSuccess']);
}

// Database connection
$conn = new mysqli("localhost", "root", "", "userportal");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all notes from database
$notes = [];
$result = $conn->query("SELECT id, filename, module, upload_date FROM lecture_notes ORDER BY upload_date DESC");
if ($result) {
    $notes = $result->fetch_all(MYSQLI_ASSOC);
}
$conn->close();

// Module names for display
$moduleNames = [
    'ai' => 'Artificial Intelligence',
    'sda' => 'Software Design Architecture',
    'fmsd' => 'Formal Methods in Software Development',
    'dcn' => 'Data Communication & Networking',
    'wt' => 'Web Technologies',
    'ecl' => 'Essentials of Computer Law',
    'mc' => 'Mathematics for Computing',
    'gp' => 'Group Project'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Lecture Notes | StudyNest</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .notes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .note-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s;
        }
        .note-card:hover {
            transform: translateY(-5px);
        }
        .module-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .note-title {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
        }
        .note-date {
            font-size: 12px;
            color: #666;
            margin-bottom: 15px;
        }
        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: auto;
        }
        .download-btn {
            display: inline-block;
            background: #4CAF50;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.3s;
        }
        .download-btn:hover {
            background: #3e8e41;
        }
        .delete-btn {
            display: inline-block;
            background: #f44336;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.3s;
        }
        .delete-btn:hover {
            background: #d32f2f;
        }
        .upload-btn {
            display: inline-block;
            background: #2196F3;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background 0.3s;
        }
        .upload-btn:hover {
            background: #0b7dda;
        }
    </style>
</head>
<body>
    <div class="navigation">
                <ul>
                    <li>
                        <a href="#">
                            <span class="icon">
                                <img src="assets/images/image01.png" alt="Logo">
                            </span>
                            <span class="title">Study Nest</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="adminusercontrolpanel.php">
                            <span class="icon">
                                <ion-icon name="people-outline"></ion-icon>
                            </span>
                            <span class="title">Manage Users</span>
                        </a>
                    </li>

                    <li>
                        <a href="uploadlecnotes.html">
                            <span class="icon">
                                <ion-icon name="chatbubble-outline"></ion-icon>
                            </span>
                            <span class="title">Manage Content</span>
                        </a>
                    </li>

                    <li>
                        <a href="report.html">
                            <span class="icon">
                                <ion-icon name="help-outline"></ion-icon>
                            </span>
                            <span class="title">Reports</span>
                        </a>
                    </li>

                    <li>
                        <a href="">
                            <span class="icon">
                                <ion-icon name="chatbubbles-outline"></ion-icon>
                            </span>
                            <span class="title">Lecture Details</span>
                        </a>
                    </li>

                    <li>
                        <a href="myprofile.php">
                            <span class="icon">
                                <ion-icon name="settings-outline"></ion-icon>
                            </span>
                            <span class="title">Settings</span>
                        </a>
                    </li>

                    <li>
                        <a href="logout.php" onclick="signOut()">
                            <span class="icon">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </span>
                            <span class="title">Sign Out</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="main">
                <!-- <div class="left-semicircle"></div>
                <div class="middle-circle"></div>
                <div class="right"></div> -->
                <div class="topbar">
                    <div class="toggle">
                        <ion-icon name="menu-outline"></ion-icon>
                    </div>

                    <div class="search">
                        <label>
                            <input type="text" placeholder="Search Courses">
                            <ion-icon name="search-outline"></ion-icon>
                        </label>
                    </div>

                    <div class="user">
                        <img src="assets/images/image02.jpg" alt="">
                    </div>
                </div>

    <div class="container">
        <div class="header">
            <h1>Lecture Notes</h1>
            <a href="main.html" class="upload-btn">Upload New Notes</a>
        </div>

        <?php if (!empty($successMsg)): ?>
            <div class="success-message"><?= htmlspecialchars($successMsg) ?></div>
        <?php endif; ?>

        <?php if (empty($notes)): ?>
            <p>No lecture notes found. Be the first to upload!</p>
        <?php else: ?>
            <div class="notes-grid">
                <?php foreach ($notes as $note): ?>
                    <div class="note-card">
                        <span class="module-badge" style="background: <?= getModuleColor($note['module']) ?>">
                            <?= htmlspecialchars($moduleNames[$note['module']] ?? $note['module']) ?>
                        </span>
                        <h3 class="note-title"><?= htmlspecialchars($note['filename']) ?></h3>
                        <div class="note-date">Uploaded on <?= date('M d, Y H:i', strtotime($note['upload_date'])) ?></div>
                        <div class="action-buttons">
                            <a href="delete.php?id=<?= $note['id'] ?>" class="delete-btn">delete</a>
                            <a href="dowload.php?id=<?= $note['id'] ?>" class="download-btn">Download</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <script>
function signOut() {
    // Clear session data
    localStorage.clear();
    sessionStorage.clear();
    
    // Send a request to server to invalidate the session
    fetch('/logout', { method: 'POST' })
        .then(() => {
            // Redirect to home page with no-cache headers
            window.location.replace("HomePage.html");
        });
    
    // Prevent default link behavior
    return false;
}
</script>
</body>
</html>

<?php
function getModuleColor($module) {
    $colors = [
        'ai' => '#FF9AA2',
        'sda' => '#FFB7B2',
        'fmsd' => '#FFDAC1',
        'dcn' => '#E2F0CB',
        'wt' => '#B5EAD7',
        'ecl' => '#C7CEEA',
        'mc' => '#F8B195',
        'gp' => '#F67280'
    ];
    return $colors[$module] ?? '#CCCCCC';
}
?>