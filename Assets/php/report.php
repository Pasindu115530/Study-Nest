<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'userportal');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables with default values
$visitsData = [];
$months = [];
$totalVisitors = 0;
$avgVisitors = 0;
$peakMonth = 'No data';
$peakValue = 0;
$avgDailyHours = 0;
$mostActiveDay = 'No data';
$leastActiveDay = 'No data';
$mostActiveCount = 0;
$leastActiveCount = PHP_INT_MAX; // Initialize with maximum possible value

// Get count of visits per month
$visitQuery = "SELECT month, COUNT(*) as visit_count FROM datatime GROUP BY month ORDER BY id";
$visitResult = $conn->query($visitQuery);

if ($visitResult && $visitResult->num_rows > 0) {
    while($row = $visitResult->fetch_assoc()) {
        $months[] = $row['month'];
        $visitsData[] = (int)$row['visit_count'];
    }
    
    // Calculate statistics only if we have data
    if (count($visitsData) > 0) {
        $totalVisitors = array_sum($visitsData);
        $avgVisitors = round($totalVisitors / count($visitsData));
        $peakValue = max($visitsData);
        $peakMonthIndex = array_search($peakValue, $visitsData);
        $peakMonth = isset($months[$peakMonthIndex]) ? $months[$peakMonthIndex] . " (" . $peakValue . ")" : 'No data';
    }
}

// Get average duration per visit (if durations column exists)
$screenQuery = "SELECT AVG(duration)/60 as avg_hours FROM datatime";
$screenResult = $conn->query($screenQuery);
if ($screenResult && $screenResult->num_rows > 0) {
    $row = $screenResult->fetch_assoc();
    $avgDailyHours = round($row['avg_hours'], 1);
}

// Get most and least active days
$dayQuery = "SELECT day, COUNT(*) as day_count FROM datatime GROUP BY day";
$dayResult = $conn->query($dayQuery);

if ($dayResult && $dayResult->num_rows > 0) {
    while($row = $dayResult->fetch_assoc()) {
        $count = (int)$row['day_count'];
        
        // Check for most active day
        if ($count > $mostActiveCount) {
            $mostActiveCount = $count;
            $mostActiveDay = $row['day'];
        }
        
        // Check for least active day
        if ($count < $leastActiveCount) {
            $leastActiveCount = $count;
            $leastActiveDay = $row['day'];
        }
    }
    
    // Only format with counts if we found data
    if ($mostActiveCount > 0) {
        $mostActiveDay = $mostActiveDay . " (" . $mostActiveCount . ")";
    }
    if ($leastActiveCount < PHP_INT_MAX) { // Check if we found any data
        $leastActiveDay = $leastActiveDay . " (" . $leastActiveCount . ")";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Lecture Notes | StudyNest</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="/study nest/assets/css/dashboard.css">
    <style>
        *{
            margin: 0;
            padding: 0;

        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color:rgba(0, 0, 0, 1);
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
        h1, h2, h3 {
            margin-bottom: 1rem;
            color: white;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 2rem;
            border-bottom: 2px solid var(--black2);
            padding-bottom: 0.5rem;
        }

        h2 {
            font-size: 1.5rem;
            margin-top: 2rem;
        }

        .card {
            background: linear-gradient(to top right, rgba(195, 220, 220, 0.3) 20%, rgba(255, 255, 255, 0.15) 30%);
            backdrop-filter: blur(10px);
            border: 1px solid rgb(255 255 255 / 50%);
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 7px 25px rgba(255, 0, 0, 0.08);
        }

        .stats-container {
            display: flex;
            gap: 20px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 15px;
            flex: 1;
            min-width: 200px;
        }

        .stat-card h3 {
            color: white;
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .stat-card p {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: rgba(255, 114, 0, 0.1);
            font-weight: 600;
            color: var(--black2);
        }

        tr:hover {
            background: var(--black2);
            color: var(--white);
        }

        tr:hover td {
            color: var(--white);
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
                    <a href="dashboardcontentadmin.php" class="nav_link submenu_item">
                        <span class="navlink_icon">
                           <i class="bx bx-home-alt"></i>
                        </span>
                        <span class="navlink"> Dashboard</span>  
                    </a>
                </li>
            
          
        
           <li class="item">
                    <a href="adminusercontrolpanel.php" class="nav_link submenu_item">
                        <span class="navlink_icon">
                           <i class='bx bxs-user-account'></i>
                        </span>
                        <span class="navlink">Manage Users</span>  
                    </a>
                </li>
           <li class="item">
                    <a href="/study nest/uploadlecnotes.html" class="nav_link submenu_item">
                        <span class="navlink_icon">
                           <i class='bx bx-book-content' ></i>
                        </span>
                        <span class="navlink">Manage Content</span>  
                    </a>
                </li>

            <li class="item">
                    <a href="#" class="nav_link submenu_item_active">
                        <span class="navlink_icon">
                           <i class='bx bxs-report' ></i>
                        </span>
                        <span class="navlink">Reports</span>  
                    </a>
                </li>

           <li class="item">
                    <a href="myprofile.php" class="nav_link submenu_item">
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
                    
                    <div class="user">
                        <img src="assets/images/image02.jpg" alt="">
                    </div>
                </div>

        

        <div class="container">
            <h1>Reports Dashboard</h1>
        
        <!-- Section 1: Monthly Visits Report -->
        <div class="card">
            <h2>Monthly Visits Report</h2>
            <div class="chart-container">
                <canvas id="visitsChart"></canvas>
            </div>
            <div class="stats-container">
                <div class="stat-card">
                    <h3>Total Visitors</h3>
                    <p id="totalVisitors"><?php echo number_format($totalVisitors); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Average Per Month</h3>
                    <p id="avgVisitors"><?php echo number_format($avgVisitors); ?></p>
                </div>
                <div class="stat-card">
                    <h3>Highest Month</h3>
                    <p id="peakMonth"><?php echo $peakMonth; ?></p>
                </div>
            </div>
        </div>
          <div class="card">
    <h2>Screen Time</h2>
    <div class="stats-container">
        <div class="stat-card">
            <h3>Avg. Daily Hours</h3>
            <p><?php echo $avgDailyHours; ?> hours</p>
        </div>
        <div class="stat-card">
            <h3>Most Active Day</h3>
            <p><?php echo $mostActiveDay; ?></p>
        </div>
        <div class="stat-card">
            <h3>Least Active Day</h3>
            <p><?php echo $leastActiveDay; ?></p>
        </div>
    </div>
        </div>
                                        </div></div>
   

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
            window.location.replace("logout.php");
        });
    
    // Prevent default link behavior
    return false;
}
</script>
<script>
        // Monthly Visits Chart
        const ctx = document.getElementById('visitsChart').getContext('2d');
        const months = <?php echo json_encode($months); ?>;
        const visitsData = <?php echo json_encode($visitsData); ?>;
        
        // Create chart
        const visitsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Monthly Visitors',
                    data: visitsData,
                    backgroundColor: 'rgba(255, 114, 0, 0.7)',
                    borderColor: 'rgba(255, 114, 0, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            color: 'white'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: 'white'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'white'
                        }
                    }
                }
            }
        });</script>

</body>
</html>