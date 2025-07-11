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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Lecture Notes | StudyNest</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/study nest/assets/css/dashboard.css">
    <style>
        *{
            margin: 0;
            padding: 0;

        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color:rgb(0, 0, 0);
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
            background: linear-gradient(to top right, rgba(195, 220, 220, 0.1) 20%, rgba(255, 255, 255, 0.15) 30%);
            backdrop-filter: blur(10px);
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
            box-shadow: 0 2px 5px #ff7200;
        }
        .module-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
            color: black;
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
            background:rgb(255, 213, 179);
            color: #000;
        }
          .year-section {
            margin-bottom: 40px;
            /* border: 1px solid rgb(255 255 255 / 50%);
            background:transparent; */
            /* background: linear-gradient(to top right, rgba(195, 220, 220, 0.3) 10%, rgba(255, 255, 255, 0.15) 10%); */
            /* backdrop-filter: blur(30px); */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .year-section h1 {
            color: #ff7200;
            font-weight: 900;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }
        .semester-section {
            margin-bottom: 30px;
            padding: 15px;
            border: 1px solid rgb(255 255 255 / 50%);
            background: linear-gradient(to top right, rgba(195, 220, 220, 0.3) 10%, rgba(255, 255, 255, 0.15) 10%);
            background: white(0.9);
            backdrop-filter: blur(30px);
            border-radius: 8px;
        }
        .semester-section h3 {
            color: #fff;
            margin-bottom: 15px;
        }
        .department-section {
    margin-bottom: 20px;
    border: 1px solid #eee;
    padding: 15px;
    border-radius: 5px;
}

.department-title {
    color: #ff7200;
    margin-bottom: 15px;
    padding-bottom: 5px;
    border-bottom: 1px solid #ddd;
}
        .note-date {
            font-size: 12px;
            color:rgb(0, 0, 0);
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
   
    <header class="navbar">
        <div class="logo_item">
            <button id="sidebarOpen" aria-label="Toggle sidebar">
                <i class="bx bx-menu"></i>
            </button>
            <img src="../img/website-icon.png" alt="StudyNest Logo">
            <span>Study Nest</span>
        </div>
        <div class="navbar_content">
            <img src="../img/neon 5.png" alt="User profile" class="profile" />
        </div>
    </header>

    <!-- Sidebar -->
    <nav class="sidebar" aria-label="Main navigation">
        <div class="menu_content">
            <ul class="menu_items">
                <div class="breaker"></div>
                <br><br>
                
                <li class="item">
                    <a href="#" class="nav_link submenu_item_active">
                        <span class="navlink_icon">
                            <i class="bx bx-home-alt"></i>
                        </span>
                        <span class="navlink">Dashboard</span>
                    </a>
                </li>

                <li class="item">
                    <a href="lecturedetails.php" class="nav_link submenu_item">
                        <span class="navlink_icon">
                            <i class='bx bxs-graduation'></i>
                        </span>
                        <span class="navlink">Lectures Details</span>
                    </a>
                </li>

                <li class="item">
                    <a href="#" class="nav_link submenu_item">
                        <span class="navlink_icon">
                            <i class='bx bx-user'></i>
                        </span>
                        <span class="navlink">My Profile</span>  
                    </a>
                </li>

               <li class="item">
                    <a href="logout.php" class="nav_link submenu_item" onclick="signOut()">
                        <span class="navlink_icon">
                            <i class='bx bx-log-out'></i>
                        </span>
                        <span class="navlink">Sign Out</span>  
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="main">
         <div class="left-semicircle"></div>
                <div class="middle-circle"></div>
                <div class="right"></div>
                <div class="topbar">
                    <div class="toggle">
                        <ion-icon name="menu-outline"></ion-icon>
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
            <div class="year-filter">
                    <button class="filter-btn active" data-year="all">All Years</button>
                    <button class="filter-btn" data-year="1">First Year</button>
                    <button class="filter-btn" data-year="2">Second Year</button>
                    <button class="filter-btn" data-year="3">Third Year</button>
                    <button class="filter-btn" data-year="4">Fourth Year</button>
            </div>
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
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.year-filter .filter-btn');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            const selectedYear = this.dataset.year;
            const allCards = document.querySelectorAll('.note-card');
            
            allCards.forEach(card => {
                // Extract year from card (assuming format "Year: X" in meta-badge)
                const yearBadge = card.querySelector('.meta-badge');
                let cardYear = '';
                
                if (yearBadge && yearBadge.textContent.includes('Year:')) {
                    cardYear = yearBadge.textContent.split('Year: ')[1].trim();
                }
                
                // Show/hide logic
                if (selectedYear === 'all' || cardYear === selectedYear) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Optional: Trigger click on "All Years" by default
    document.querySelector('.year-filter .filter-btn[data-year="all"]').click();
});
</script>

    <script>
    
    document.querySelectorAll('.note-card').forEach(card => {
        card.addEventListener('click', function() {
            const subjectName = encodeURIComponent(this.querySelector('.note-title').textContent);
            window.location.href = `view_notes_user.php?subject=${subjectName}`;
        });
    });

        function signOut() {
            localStorage.clear();
            sessionStorage.clear();
            fetch('/logout', { method: 'POST' })
                .then(() => {
                    window.location.replace("/study nest/HomePage.html");
                });
            return false;
        }
    </script>
    
    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
     <script>
function signOut() {
    // Clear session data
    localStorage.clear();
    sessionStorage.clear();
    
    // Send a request to server to invalidate the session
    fetch('/logout', { method: 'POST' })
        .then(() => {
            // Redirect to home page with no-cache headers
            window.location.replace("/study nest/HomePage.html");
        });
    
    // Prevent default link behavior
    return false;
}
</script>

</body>
</html>

 