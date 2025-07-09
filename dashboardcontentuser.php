<?php
session_start();

// Display success message if redirected from upload
if (isset($_SESSION['uploadSuccess'])) {
    $successMsg = $_SESSION['uploadSuccess'];
    unset($_SESSION['uploadSuccess']);
}

// Get department from URL parameter
$department = isset($_GET['department']) ? $_GET['department'] : '';
if (empty($department)) {
    die("Department parameter is missing");
}

// Database connection
$conn = new mysqli("localhost", "root", "", "userportal");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get notes for the specific department
$notes = [];
$stmt = $conn->prepare("SELECT id, subject_name, year, semester, department, upload_date 
                        FROM subjects 
                        WHERE department = ? 
                        ORDER BY year, semester, upload_date DESC");
$stmt->bind_param("s", $department);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    $notes = $result->fetch_all(MYSQLI_ASSOC);
}
$stmt->close();
$conn->close();

// Organize notes by year and semester
$organizedNotes = [];
foreach ($notes as $note) {
    $year = $note['year'];
    $semester = $note['semester'];
    if (!isset($organizedNotes[$year])) {
        $organizedNotes[$year] = [];
    }
    if (!isset($organizedNotes[$year][$semester])) {
        $organizedNotes[$year][$semester] = [];
    }
    $organizedNotes[$year][$semester][] = $note;
}

// Department names
$departmentNames = [
    'cs' => 'Computer Science',
    'se' => 'Software Engineering',
    'is' => 'Information Systems'
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
        *{
            margin: 0;
            padding: 0;
        }
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
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
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
            display: flex;
            flex-direction: column;
            position: relative;
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
            color: white;
        }
        .note-title {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
            word-break: break-word;
        }
        .note-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 10px;
        }
        .meta-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            background: #f0f0f0;
            color: #555;
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
        }.department-filter {
            margin-bottom: 20px;
        }
        .filter-btn {
            padding: 8px 16px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            background: #e0e0e0;
            cursor: pointer;
        }
        .filter-btn.active {
            background: #2196F3;
            color: white;
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
                <a href="view_notes_user.php?department=<?= $department ?>">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#">
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
            <h1><?= htmlspecialchars($departmentNames[$department] ?? $department) ?> Lecture Notes</h1>
            
            <?php if (!empty($successMsg)): ?>
                <div class="success-message"><?= htmlspecialchars($successMsg) ?></div>
            <?php endif; ?>
            
            <?php if (empty($notes)): ?>
                <p>No lecture notes found for this department. Be the first to upload!</p>
            <?php else: ?>
                <?php for ($year = 1; $year <= 4; $year++): ?>
                    <div class="year-section">
                        <h2>Year <?= $year ?></h2>
                        
                        <?php for ($semester = 1; $semester <= 2; $semester++): ?>
                            <div class="semester-section">
                                <h3>Semester <?= $semester ?></h3>
                                
                                <?php if (empty($organizedNotes[$year][$semester])): ?>
                                    <div class="no-notes">No notes available for this semester yet.</div>
                                <?php else: ?>
                                    <div class="notes-grid">
                                        <?php foreach ($organizedNotes[$year][$semester] as $note): ?>
                                            <div class="note-card">
                                                <h3 class="note-title"><?= htmlspecialchars($note['subject_name']) ?></h3>
                                                <div class="note-meta">
                                                    <span class="meta-badge">Year: <?= htmlspecialchars($note['year']) ?></span>
                                                    <span class="meta-badge">Semester: <?= htmlspecialchars($note['semester']) ?></span>
                                                </div>
                                                <div class="note-date">Uploaded on <?= date('M d, Y H:i', strtotime($note['upload_date'])) ?></div>
               
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>

    <script>
    
    document.querySelectorAll('.note-card').forEach(card => {
        card.addEventListener('click', function() {
            const subjectName = encodeURIComponent(this.querySelector('.note-title').textContent);
            window.location.href = `view_notes.php?subject=${subjectName}`;
        });
    });

        function signOut() {
            localStorage.clear();
            sessionStorage.clear();
            fetch('/logout', { method: 'POST' })
                .then(() => {
                    window.location.replace("HomePage.html");
                });
            return false;
        }
    </script>
    
    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>