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

// Get and sanitize input
$module = isset($_GET['subject']) ? urldecode($_GET['subject']) : '';

// Initialize notes array
$notes = [];

// Prepare and execute query with parameterized statement
$stmt = $conn->prepare("SELECT id, filename, module, upload_date, year, semester, department 
                       FROM lecture_notes 
                       WHERE module=? 
                       ORDER BY upload_date DESC");
if ($stmt) {
    $stmt->bind_param("s", $module);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result) {
        $notes = $result->fetch_all(MYSQLI_ASSOC);
    }
    $stmt->close();
} else {
    // Handle prepare error
    error_log("Prepare failed: " . $conn->error);
}

$conn->close();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Lecture Notes | StudyNest</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/Study Nest/Assets/css/dashboard.css">
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
                        <a href="dashboardcontentadmin.php">
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
                        <a href="/study nest/uploadlecnotes.html">
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
                        <a href="myprofile.php">
                            <span class="icon">
                                <ion-icon name="settings-outline"></ion-icon>
                            </span>
                            <span class="title">My profile</span>
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
        
        <?php if (!empty($errorMsg)): ?>
            <div class="error-message"><?= htmlspecialchars($errorMsg) ?></div>
        <?php endif; ?>

 
        <?php if (empty($notes)): ?>
            <p>No lecture notes found. Be the first to upload!</p>
        <?php else: ?>
            <div class="notes-grid">
                <?php foreach ($notes as $note): ?>
                    <div class="note-card" data-dept="<?= $note['department'] ?>">
                        <span class="module-badge" style="background: <?= getModuleColor($note['module']) ?>">
                            <?= htmlspecialchars($note['module']) ?>
                        </span>
                        <h3 class="note-title"><?= htmlspecialchars($note['filename']) ?></h3>
                        
                        <div class="note-meta">
                            <span class="meta-badge">Year: <?= htmlspecialchars($note['year']) ?></span>
                            <span class="meta-badge">Semester: <?= htmlspecialchars($note['semester']) ?></span>
                            <span class="meta-badge"><?= htmlspecialchars($departmentNames[$note['department']] ?? $note['department']) ?></span>
                        </div>
                        
                        <div class="note-date">Uploaded on <?= date('M d, Y H:i', strtotime($note['upload_date'])) ?></div>
                        <div class="action-buttons">
                            <a href="delete.php?id=<?= $note['id'] ?>" class="delete-btn">Delete</a>
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
            window.location.replace("/study nest/HomePage.html");
        });
    
    // Prevent default link behavior
    return false;
}
</script>

</body>
</html>

<?php
function getModuleColor($module) {
    $moduleColors = [
         # Year 1 Semester 1 (CS)
        'Professional English' => '#FF9AA2',
        'Principles of Management' => '#FFB7B2',
        'Introductory Statistics' => '#FFDAC1',
        'Discrete Mathematics' => '#E2F0CB',
        'Computer System Organization' => '#B5EAD7',
        'Fundamentals of Programming' => '#C7CEEA',
        'Introduction to Software Engineering' => '#F8B195',
        'Leadership & Human Skills Development' => '#F67280',
        
        # Year 1 Semester 2 (CS)
        'Web Development' => '#A2D2FF',
        'Mathematics II' => '#BDE0FE',
        'Object Oriented Programming' => '#CDB4DB',
        'Database Management Systems' => '#FFC8DD',
        'Data Structures and Algorithms' => '#FFAFCC',
        'Object Oriented Analysis and Design' => '#B5E2FA',
        'Computer System Architecture' => '#F9C74F',
        'Rapid Application Development' => '#90BE6D',
        'Algebra for Computing' => '#43AA8B',
        
        # Year 2 Semester 1 (CS)
        'Group Project Part 1' => '#577590',
        'Data Communication and Networks' => '#277DA1',
        'Operating Systems' => '#FF9AA2',
        'Web Technologies' => '#FFB7B2',
        'Statistical Distribution and Inferences' => '#FFDAC1',
        'Mathematics for Computer Science' => '#E2F0CB',
        'Artificial Intelligence' => '#B5EAD7',
        
        # Year 2 Semester 2 (CS)
        'Group Project Part 2' => '#C7CEEA',
        'Computer Graphics' => '#F8B195',
        'High Performance Computing' => '#F67280',
        'Human Computer Interactions' => '#A2D2FF',
        'Differential Equations' => '#BDE0FE',
        'Service Oriented Web Applications' => '#CDB4DB',
        'Industrial Internship' => '#FFC8DD',
        'Software Architecture and Design Patterns 1' => '#FFAFCC',
        'Software Architecture and Design Patterns 2' => '#B5E2FA',
        'Software Architecture and Design Patterns 3' => '#F9C74F',
        'Software Architecture and Design Patterns 4' => '#90BE6D',
        
        # Year 3 Semester 1 (CS)
        'Data Analytics' => '#43AA8B',
        'Social and Professional Issues in Information Technology' => '#577590',
        'Knowledge Representation' => '#277DA1',
        'Theory of Computation' => '#FF9AA2',
        'Advanced Data Structures and Algorithms' => '#FFB7B2',
        'Computer Security' => '#FFDAC1',
        'Introduction to Machine Learning' => '#E2F0CB',
        'Emerging Trends in Computing' => '#B5EAD7',
        'Visual Computing' => '#C7CEEA',
        'IT Project Management' => '#F8B195',
        
        # Year 3 Semester 2 (CS)
        'Digital Image Processing' => '#F67280',
        'Software Quality Assurance' => '#A2D2FF',
        'Advanced Machine Learning' => '#BDE0FE',
        'Theory of Programming Languages' => '#CDB4DB',
        'Multimedia Systems' => '#FFC8DD',
        'Nature Inspired Algorithms' => '#FFAFCC',
        'Embedded Systems and Internet of Things' => '#B5E2FA',
        'Game Development' => '#F9C74F',
        'Middleware Architecture' => '#90BE6D',
        'Mathematical Optimization' => '#43AA8B',
        
        # Year 4 Semester 1 (CS)
        'Research Project Part I' => '#577590',
        'Computational Biology' => '#277DA1',
        'Independent Literature Review' => '#FF9AA2',
        'Computer Vision' => '#FFB7B2',
        'Cloud Computing' => '#FFDAC1',
        'Big Data Technologies' => '#E2F0CB',
        'Robotics' => '#B5EAD7',
        'Natural Language Processing' => '#C7CEEA',
        'Advanced Database Systems' => '#F8B195',
        'Mobile Computing' => '#F67280',
        
        # Year 4 Semester 2 (CS)
        'Industrial Training' => '#A2D2FF',
        'Research Project Part II' => '#BDE0FE',

        # Year 1 Semester 1 (SE)
        'Professional English'=> '#FF9AA2',
        'Principles of Management'=> '#FFB7B2',
        'Introductory Statistics'=> '#FFDAC1',
        'Discrete Mathematics'=> '#E2F0CB',
        'Computer System Organization'=> '#B5EAD7',
        'Fundamentals of Programming'=> '#C7CEEA',
        'Introduction to Software Engineering'=> '#F8B195',
        'Leadership & Human Skills Development'=>'#F67280',
        
        # Year 1 Semester 2 (SE)
        'Object Oriented Programming'=> '#A2D2FF',
        'Database Management Systems'=> '#BDE0FE',
        'Data Structures and Algorithms'=> '#CDB4DB',
        'Object Oriented Analysis and Design'=> '#FFC8DD',
        'Operating Systems'=> '#FFAFCC',
        'Rapid Application Development'=> '#B5E2FA',
        'Advanced Mathematics'=> '#F9C74F',
        
        # Year 2 Semester 1 (SE)
        'Group Project Part 1'=> '#90BE6D',
        'Essentials in Computer Networking'=> '#43AA8B',
        'Formal Methods in Software Development'=> '#577590',
        'Web Technologies'=> '#277DA1',
        'Software Design and Architecture'=> '#FF9AA2',
        'Mathematics for Computing'=> '#FFB7B2',
        'Artificial Intelligence'=> '#FFDAC1',
        'Essentials of Computer Law'=> '#E2F0CB',
        
        # Year 2 Semester 2 (SE)
        'Group Project Part 2'=> '#B5EAD7',
        'Fundamentals of Software Security'=> '#C7CEEA',
        'Software Testing and Validation'=> '#F8B195',
        'Human Computer Interaction'=> '#F67280',
        'Software Project Management'=> '#A2D2FF',
        'Software Configuration Management'=> '#BDE0FE',
        'Industrial Inspection'=> '#CDB4DB',
        'Management Information Systems'=> '#FFC8DD',
        
        # Year 3 Semester 1 (SE)
        'Software Safety and Reliability'=> '#FFAFCC',
        'Social and Professional Issues in Information Technology'=> '#B5E2FA',
        'Software Process Management'=>'#F9C74F',
        'Group Project in Hardware'=> '#90BE6D',
        'Software Evolution'=>'#43AA8B',
        'Enterprise Information Systems'=> '#577590',
        'Human Resource Management'=> '#277DA1',
        'Visual Computing'=> '#FF9AA2',
        'Introduction to Business Intelligence'=> '#FFB7B2',
        'High Performance Computing'=> '#FFDAC1',
        
        # Year 3 Semester 2 (SE)
        'System Development Project'=> '#E2F0CB',
        'Introduction to Distributed Computing'=> '#B5EAD7',
        'Software Quality Assurance'=> '#C7CEEA',
        'Advanced Database Management Systems'=> '#F8B195',
        'Software Design Patterns'=> '#F67280',
        'Mobile Computing'=> '#A2D2FF',
        'Machine Learning'=> '#BDE0FE',
        'Game Designing and Development'=> '#CDB4DB',
        'Middleware Architecture'=> '#FFC8DD',
        'Social Computing'=> '#FFAFCC',
        'Semantic Web'=> '#B5E2FA',
        
        # Year 4 Semester 1 (SE)
        'Research Project Part I'=> '#F9C74F',
        'Research Methodologies and Scientific Communication'=> '#90BE6D',
        'Service Oriented Architecture'=> '#43AA8B',
        'Software Engineering Economics'=> '#577590',
        'Cloud Computing'=> '#277DA1',
        'Big Data Technologies'=> '#FF9AA2',
        'Robotics'=> '#FFB7B2',
        'Selected Topics in Software Engineering'=> '#FFDAC1',
        'Natural Language Processing'=> '#E2F0CB',
        'Refactoring and Design'=> '#B5EAD7',
        'Emerging Trends in Computing'=> '#C7CEEA',
        
        # Year 4 Semester 2 (SE)
        'Industrial Training'=> '#F8B195',
        'Research Project Part II'=> '#F67280',
        # Year 1 Semester 1 (IS)
        'Introductory Mathematics'=> '#FF9AA2',
        'Fundamentals of Programming'=> '#FFB7B2',
        'Principles of Management'=> '#FFDAC1',
        'Introductory Statistics'=> '#E2F0CB',
        'Fundamentals of Information Systems'=> '#B5EAD7',
        'Introduction to Software Engineering'=> '#C7CEEA',
        'Leadership & Human Skills Development'=> '#F8B195',
        'Professional English'=> '#F67280',

        # Year 1 Semester 2 (IS)
        'Object Oriented Programming'=> '#A2D2FF',
        'Database Management System'=> '#BDE0FE',
        'Data Structures and Algorithms'=> '#CDB4DB',
        'Advanced Software Engineering'=> '#FFC8DD',
        'Economics & Accounting'=> '#FFAFCC',
        'Rapid Application Development'=> '#B5E2FA',
        'Business Communication'=> '#F9C74F',

        # Year 2 Semester 1 (IS)
        'Business Process Management'=> '#90BE6D',
        'Operations Management'=> '#43AA8B',
        'Marketing Management'=> '#577590',
        'Information Systems Security'=> '#277DA1',
        'Organizational Behaviour and Society'=> '#FF9AA2',
        'System Administration and Maintenance'=> '#FFB7B2',
        'Statistical Distribution and Inferences'=> '#FFDAC1',

        # Year 2 Semester 2 (IS)
        'Enterprise Applications'=> '#E2F0CB',
        'Information System Risk Management'=> '#B5EAD7',
        'Introduction to Entrepreneurship and SMEs'=> '#C7CEEA',
        'Business Intelligence'=> '#F8B195',
        'Operating System Concepts'=> '#F67280',
        'Advanced Database Systems'=> '#A2D2FF',
        'Industrial Inspection'=> '#BDE0FE',
        'Personal Productivity with IS Technology'=> '#CDB4DB',

        # Year 3 Semester 1 (IS)
        'Group Project Part 1'=> '#FFC8DD',
        'Social and Professional Issues in Information Technology'=> '#FFAFCC',
        'Agile Software Development'=> '#B5E2FA',
        'Software Quality Assurance'=> '#F9C74F',
        'Design Patterns and Applications'=> '#90BE6D',
        'Research Methodologies'=> '#43AA8B',
        'Data Communication and Networks'=> '#577590',
        'Software Engineering Economics'=> '#277DA1',
        'Game Designing and Development'=> '#FF9AA2',
        'Artificial Intelligence'=> '#FFB7B2',

        # Year 3 Semester 2 (IS)
        'IT Procurement Management'=> '#FFDAC1',
        'Group Project Part 2'=> '#E2F0CB',
        'Digital Business'=> '#B5EAD7',
        'Web-based Application Development'=> '#C7CEEA',
        'E-Learning and Instructional Design'=> '#F8B195',
        'Mobile Computing'=> '#F67280',
        'Machine Learning and Neural Computing'=> '#A2D2FF',
        'Blockchain and Technologies'=> '#BDE0FE',
        'Human Computer Interactions'=> '#CDB4DB',
        'Middleware Architecture'=> '#FFC8DD',

        # Year 4 Semester 1 (IS)
        'Research Project Part I'=> '#FFAFCC',
        'Introduction to Distributed Systems'=> '#B5E2FA',
        'Ethical Issues and Legal Aspects of Information Technology'=> '#F9C74F',
        'Human Resource Management'=> '#90BE6D',
        'Cloud Computing'=> '#43AA8B',
        'Data Mining and Applications'=> '#577590',
        'Data Analytics'=> '#277DA1',
        'Natural Language Processing'=> '#FF9AA2',
        'Refactoring and Design'=> '#FFB7B2',
        'High Performance Computing'=> '#FFDAC1',

        # Year 4 Semester 2 (IS)
        'Industrial Training'=> '#E2F0CB',
        'Research Project Part II'=> '#B5EAD7',
    ];
    return $moduleColors[$module] ?? '#888888';
}
?>