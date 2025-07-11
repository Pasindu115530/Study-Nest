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
$result = $conn->query("SELECT id, filename, module, upload_date, year, semester, department FROM lecture_notes ORDER BY upload_date DESC");
if ($result) {
    $notes = $result->fetch_all(MYSQLI_ASSOC);
}
$conn->close();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Lecture Notes | StudyNest</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
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
        <img src="../img/website-icon.png" alt="">
        <span>Study Nest</span>
      </div>
      <div class="navbar_content">
        <img src="../img/neon 5.png" alt="" class="profile" />
      </div>
    </header>
    
    <nav class="sidebar"  aria-label="Main navigation">
      <div class="menu_content">
        <ul class="menu_items">
          <div class="breaker"></div>
          <br><br>
          <!-- <div class="menu_title menu_dahsboard"></div> -->
          
          <li class="item">
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class="bx bx-home-alt"></i>
              </span>
              <span class="navlink">Dashboard</span>
            </div>
            
          </li>
          <!-- end -->
          <!-- duplicate this li tag if you want to add or remove  navlink with submenu -->
          <!-- start -->
          <li class="item">
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class='bx bxs-user-account'></i>
              </span>
              <span class="navlink">Manage Users</span>
            </div>

            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class='bx bx-book-content' ></i>
              </span>
              <span class="navlink">Manage Content</span>  
            </div>

            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class='bx bxs-report' ></i>
              </span>
              <span class="navlink">Reports</span>  
            </div>

            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class='bx bx-user'></i>
              </span>
              <span class="navlink">My Profile</span>  
            </div>

            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class='bx bx-log-out'></i>
              </span>
              <span class="navlink">Sign Out</span>  
            </div>
            
          </li>
          <!-- end -->
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
        <!-- <h1>Lecture Notes Repository</h1> -->
        
        <?php
        
        // Database connection
        $conn = new mysqli("localhost", "root", "", "userportal");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get all notes from database
      $allNotes = [];
        $result = $conn->query("SELECT id, subject_name, year, semester, department, upload_date FROM subjects ORDER BY year, semester, upload_date DESC");
        if ($result) {
            $allNotes = $result->fetch_all(MYSQLI_ASSOC);
        }
        $conn->close();

        // Organize notes by year and semester
        $organizedNotes = [];
        foreach ($allNotes as $note) {
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

        // Display notes for each year and semester
        for ($year = 1; $year <= 4; $year++): ?>
    <div class="year-section">
        <h1>Year <?= $year ?></h1>

        <?php for ($semester = 1; $semester <= 2; $semester++): ?>
            <div class="semester-section">
                <h3>Semester <?= $semester ?></h3>
                
                <?php 
                // Get all departments for this year and semester
                $departments = [];
                if (!empty($organizedNotes[$year][$semester])) {
                    foreach ($organizedNotes[$year][$semester] as $note) {
                        $dept = $note['department'];
                        if (!in_array($dept, $departments)) {
                            $departments[] = $dept;
                        }
                    }
                }
                
                if (empty($departments)): ?>
                    <div class="no-notes">No notes available for this semester yet.</div>
                <?php else: ?>
                    <?php foreach ($departments as $dept): ?>
                        <div class="department-section" data-dept="<?= htmlspecialchars($dept) ?>">
                            <h2 class="department-title"><?= htmlspecialchars($dept) ?></h2>
                            <div class="notes-grid">
                                <?php 
                                $hasNotes = false;
                                foreach ($organizedNotes[$year][$semester] as $note): 
                                    if ($note['department'] === $dept): 
                                        $hasNotes = true;
                                ?>
                                    <div class="note-card">
                                        <h3 class="note-title"><?= htmlspecialchars($note['subject_name']) ?></h3>
                                        <div class="note-meta">
                                            <span class="meta-badge">Year: <?= htmlspecialchars($note['year']) ?></span>
                                            <span class="meta-badge">Semester: <?= htmlspecialchars($note['semester']) ?></span>
                                        </div>
                                        <?php if (isset($note['upload_date'])): ?>
                                            <div class="note-date">Uploaded on <?= date('M d, Y H:i', strtotime($note['upload_date'])) ?></div>
                                        <?php endif; ?>
                                    </div>
                                <?php 
                                    endif;
                                endforeach; 
                                
                                if (!$hasNotes): ?>
                                    <div class="no-notes">No notes available for <?= htmlspecialchars($dept) ?> department.</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endfor; ?>
    </div>
<?php endfor; ?>
    </div>

    <script>
    document.querySelectorAll('.note-card').forEach(card => {
        card.addEventListener('click', function(e) {
            // Check if the clicked element is NOT a button, link, or interactive element
            if (e.target.tagName !== 'BUTTON' && e.target.tagName !== 'A' && !e.target.closest('button, a')) {
                const subjectName = encodeURIComponent(this.querySelector('.note-title').textContent);
                window.location.href = `view_notes.php?subject=${subjectName}`;
            }
        });

        // Prevent card click when clicking on interactive elements
        const interactiveElements = card.querySelectorAll('button, a, [onclick], [href]');
        interactiveElements.forEach(element => {
            element.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    });
</script>

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

