<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | STUDYNEST</title>
     <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/study nest/assets/css/dashboard.css">
    
    <style>
              
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', sans-serif;
      }

      body {
        background: radial-gradient(circle at bottom left,  #000000);
        color: #fff;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .container {
        /* background: rgba(20, 20, 20, 0.9); */
        width: 80%;
        max-width: 900px;
        border-radius: 20px;
        margin-left: 250px;
       
        padding: 40px;
        box-shadow: 0 0 50px rgba(255, 102, 0, 0.3);
      }

      header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 100px;
      }

      header h1 {
        font-size: 32px;
        color: #ff6a00;
      }

      .icons {
        display: flex;
        gap: 15px;
        font-size: 22px;
      }

      .middle-section {
        display: flex;
        align-items: center;
        gap: 30px;
        margin-bottom: 30px;
      }

      .profile img {
        width: 250px;
        height: 250px;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0 0 20px rgba(255, 102, 0, 0.5);
      }

      .name-section h2 {
        font-size: 26px;
        color: #fff;
        margin-bottom: 10px;
      }

      .name-section h3 {
        font-size: 18px;
        color: #ccc;
        margin: 0;
      }

      .info-section {
        margin-top: 20px;
        padding: 20px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(255, 102, 0, 0.2);
      }

      .info-section h3 {
        color: #ff6a00;
        margin-bottom: 20px;
        font-size: 20px;
      }

      .info-item {
        margin-bottom: 15px;
        padding: 10px;
        border-left: 3px solid #ff6a00;
        background-color: rgba(255, 255, 255, 0.03);
        border-radius: 8px;
        color: #eee;
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
                    <a href="#" class="nav_link submenu_item">
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
                    <a href="#" class="nav_link submenu_item">
                        <span class="navlink_icon">
                           <i class='bx bxs-report' ></i>
                        </span>
                        <span class="navlink">Reports</span>  
                    </a>
                </li>

           <li class="item">
                    <a href="#" class="nav_link submenu_item_active">
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

    
  <div class="container">

    <header>
      <h1>My Profile</h1>
      <div class="icons">
        <div class="bell">🔔</div>
        <div class="user-icon">👤</div>
        
      </div>
    </header>  

    <div class="middle-section">
      <div class="profile">
        <img src="../img/neon 5.png" alt="my photo">
      </div>  

      <div class="name-section">
      <?php
                            $servername = "localhost";
                            $dbusername = "root";
                            $dbpassword = "";
                            $dbname = "userportal";
                            $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

                            if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }                           
    if (isset($_SESSION['username'])) {
    $username = $conn->real_escape_string($_SESSION["username"]);
    
    $sql = "SELECT fname, lname, email ,department, pnumber, username,password, role,year,signuptime FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        echo "<h2>" . htmlspecialchars($row['username']) . "</h2>";
    } else {
        echo "<h2>User not found</h2>";
    }
} else {
    echo "<h2>Session expired or not logged in</h2>";
}

  ?>
     
      </div>

    </div>  
  
   <div class="info-section">
    <h3>Personal Information</h3>
    <br>
    
    <?php
    if (isset($row['fname']) && isset($row['lname'])) {
      echo '<div class="info-item"><strong>Name</strong><br>' . htmlspecialchars($row['fname'] . ' ' . $row['lname']) . '</div>';
    } else {
      echo '<div class="info-item"><strong>Name</strong><br>Not available</div>';
    }
    ?>
    <?php
    if (isset($row['email'])) {
      echo '<div class="info-item"><strong>Email</strong><br>' . htmlspecialchars($row['email']) . '</div>';
    } else {
      echo '<div class="info-item"><strong>Email</strong><br>Not available</div>';
    }
    ?>
    <?php
    if (isset($row['pnumber'])) {
      echo '<div class="info-item"><strong>Phone</strong><br>' . htmlspecialchars($row['pnumber']) . '</div>';
    } else {
      echo '<div class="info-item"><strong>Phone</strong><br>Not available</div>';
    }
    ?>
    <?php
    if (isset($row['department'])) {
      echo '<div class="info-item"><strong>Department</strong><br>' . htmlspecialchars($row['department']) . '</div>';
    } else {
      echo '<div class="info-item"><strong>Department</strong><br>Not available</div>';
    }
    ?>
    <?php
    if (isset($row['year'])) {
      echo '<div class="info-item"><strong>Year</strong><br>' . htmlspecialchars($row['year']) . '</div>';
    } else {
      echo '<div class="info-item"><strong>Year</strong><br>Not available</div>';
    }
    ?>
    <?php
    if (isset($row['signuptime'])) {
      $date = date('F Y', strtotime($row['signuptime']));
      echo '<div class="info-item"><strong>Joined</strong><br>' . htmlspecialchars($date) . '</div>';
    } else {
      echo '<div class="info-item"><strong>Joined</strong><br>Not available</div>';
    }
    ?>
    

  </div>
   <script>
function signOut() {
    // Clear session data
  
    
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

</body>
</html> 