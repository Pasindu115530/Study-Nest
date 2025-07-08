<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin & User Control Panel</title>
    <!-- ======= Styles ====== -->
    <style>
        /* Dashboard Theme Styles */
        @import url("https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap");

        :root {
            --blue: #ff7200;
            --white: #060606;
            --gray: #ff0000;
            --black1: #222;
            --black2: #ffffff;
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --dark: #1e293b;
            --darker: #0f172a;
            --light: #f8fafc;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        * {
            font-family: "Ubuntu", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;
            background: var(--white);
        }

        /* Navigation */
        .navigation {
            position: fixed;
            width: 300px;
            height: 100%;
            background: var(--blue);
            border-left: 10px solid var(--blue);
            transition: 0.5s;
            overflow: hidden;
        }

        .navigation.active {
            width: 80px;
        }

        .navigation ul {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        .navigation ul li {
            position: relative;
            width: 100%;
            list-style: none;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }

        .navigation ul li:hover,
        .navigation ul li.hovered {
            background-color: var(--white);
        }

        .navigation ul li:nth-child(1) {
            margin-bottom: 40px;
            pointer-events: none;
        }

        .navigation ul li a {
            position: relative;
            display: block;
            width: 100%;
            display: flex;
            text-decoration: none;
            color: var(--white);
        }

        .navigation ul li:hover a,
        .navigation ul li.hovered a {
            color: var(--blue);
        }

        .navigation ul li a .icon {
            position: relative;
            display: block;
            min-width: 60px;
            height: 60px;
            line-height: 75px;
            text-align: center;
        }

        .navigation ul li a .icon ion-icon {
            font-size: 1.75rem;
        }

        .navigation ul li a .title {
            position: relative;
            display: block;
            padding: 0 10px;
            height: 60px;
            line-height: 60px;
            text-align: start;
            white-space: nowrap;
        }

        .navigation ul li span img {
            position: absolute;
            left: 15px;
            top: 20px;
            width: 30px;
            height: 30px;
            line-height: 90px;
        }

        /* Main Content */
        .main {
            position: absolute;
            width: calc(100% - 300px);
            left: 300px;
            min-height: 100vh;
            background: var(--white);
            transition: 0.5s;
        }

        .main.active {
            width: calc(100% - 80px);
            left: 80px;
        }

        /* Topbar */
        .topbar {
            width: 100%;
            height: 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 10px;
        }

        .toggle {
            position: relative;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2.5rem;
            cursor: pointer;
        }

        .search {
            position: relative;
            width: 400px;
            margin: 0 10px;
        }

        .search label {
            position: relative;
            width: 100%;
        }

        .search label input {
            width: 100%;
            height: 40px;
            border-radius: 40px;
            padding: 5px 20px;
            padding-left: 35px;
            font-size: 18px;
            outline: none;
            border: 1px solid var(--black2);
        }

        .search label ion-icon {
            position: absolute;
            top: 0;
            left: 10px;
            font-size: 1.2rem;
        }

        .user {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
        }

        .user img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Control Panel Specific Styles */
        .card {
            background: linear-gradient(to top right, rgba(195, 220, 220, 0.3) 20%, rgba(255, 255, 255, 0.15) 30%);
            backdrop-filter: blur(10px);
            border: 1px solid rgb(255 255 255 / 50%);
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 7px 25px rgba(255, 0, 0, 0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            color: var(--black1);
        }

        th {
            background-color: rgba(255, 114, 0, 0.1);
            font-weight: 600;
            color: var(--blue);
        }

        tr:hover {
            background: var(--blue);
            color: var(--white);
        }

        tr:hover td {
            color: var(--white);
        }

        .status {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status.active {
            background-color: rgba(16, 185, 129, 0.2);
            color: var(--success);
        }

        .status.inactive {
            background-color: rgba(239, 68, 68, 0.2);
            color: var(--danger);
        }

        .status.pending {
            background-color: rgba(245, 158, 11, 0.2);
            color: var(--warning);
        }

        .action-btn {
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
            margin: 0 5px;
            font-size: 1.1rem;
            transition: color 0.2s;
        }

        .action-btn:hover {
            color: var(--primary);
        }

        .action-btn.delete:hover {
            color: var(--danger);
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--black1);
        }

        input, select {
            width: 100%;
            padding: 10px 15px;
            background-color: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            color: var(--black1);
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--blue);
        }

        .btn {
            background-color: var(--blue);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .btn:hover {
            background-color: #e05d00;
        }

        .form-row {
            display: flex;
            gap: 1rem;
        }

        .form-row .form-group {
            flex: 1;
        }

        h1, h2, h3 {
            margin-bottom: 1rem;
            color: var(--blue);
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--blue);
            padding-bottom: 0.5rem;
        }

        h2 {
            font-size: 1.5rem;
            margin-top: 2rem;
        }

        /* Popup Styles */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background: linear-gradient(to top right, rgba(255, 255, 255, 0.9) 20%, rgba(255, 255, 255, 0.8) 30%);
            backdrop-filter: blur(10px);
            border: 1px solid rgb(255 255 255 / 50%);
            border-radius: 20px;
            padding: 2rem;
            width: 400px;
            max-width: 90%;
            box-shadow: 0 7px 25px rgba(255, 0, 0, 0.2);
            position: relative;
        }

        .close-popup {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--blue);
        }

        .close-popup:hover {
            color: var(--danger);
        }

        /* Responsive Design */
        @media (max-width: 991px) {
            .navigation {
                left: -300px;
            }
            .navigation.active {
                width: 300px;
                left: 0;
            }
            .main {
                width: 100%;
                left: 0;
            }
            .main.active {
                left: 300px;
            }
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            th, td {
                padding: 8px 10px;
                font-size: 0.9rem;
            }
            
            .action-btn {
                margin: 0 2px;
                font-size: 1rem;
            }
            
            .search {
                width: 200px;
            }
        }

        @media (max-width: 480px) {
            .user {
                min-width: 40px;
            }
            .navigation {
                width: 100%;
                left: -100%;
                z-index: 1000;
            }
            .navigation.active {
                width: 100%;
                left: 0;
            }
            .toggle {
                z-index: 10001;
            }
            .main.active .toggle {
                color: #fff;
                position: fixed;
                right: 0;
                left: initial;
            }
        }
    </style>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <!-- =============== Navigation ================ -->
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
                <a href="dashboard.html">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="adminusercontrolpanel.html" class="hovered">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="title">Manage Users</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="chatbubble-outline"></ion-icon>
                    </span>
                    <span class="title">Manage Content</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="help-outline"></ion-icon>
                    </span>
                    <span class="title">Reports</span>
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
                <a href="#">
                    <span class="icon">
                        <ion-icon name="settings-outline"></ion-icon>
                    </span>
                    <span class="title">Settings</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </span>
                    <span class="title">Sign Out</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- ========================= Main ==================== -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>

            <div class="search">
                <label>
                    <input type="text" placeholder="Search...">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>

            <div class="user">
                <img src="assets/images/image02.jpg" alt="">
            </div>
        </div>

        <!-- ================= Main Content =================== -->
        <div class="container" style="padding: 20px;">
            <h1>Admin & User Control Panel</h1>
            
            <div class="card">
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Remove</th>
                        </tr>
                    </thead>

                    <?php
                    $servername = "localhost";
                    $dbusername = "root";
                    $dbpassword = "";
                    $dbname = "userportal";
                    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }                           
                    $sql = "SELECT username, password, role FROM users";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['username']) . "</td>
                                    <td>" . htmlspecialchars($row['password']) . "</td>
                                    <td>" . htmlspecialchars($row['role']) . "</td>
                                    <td><button class='action-btn edit-btn' data-username='".htmlspecialchars($row['username'])."' data-password='".htmlspecialchars($row['password'])."' data-role='".htmlspecialchars($row['role'])."'>✏️</button></td>
                                    <td><button class='action-btn delete-btn'>🗑️</button></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No users found.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </table>
            </div>
            
            <div class="card">
                <h2>New Admin Add Form</h2>
                <form id="adminForm" action="Assets/php/addadmin.php" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" name="fname" required>
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" id="lname" name="lname" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="mailaddress">Email Address</label>
                            <input type="email" id="mailaddress" name="mailaddress" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="pnumber">Phone Number</label>
                            <input type="tel" id="pnumber" name="pnumber">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="pwconfirm">Confirm Password</label>
                            <input type="password" id="pwconfirm" name="pwconfirm" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn">Add Admin</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit User Popup -->
    <div class="popup-overlay" id="editPopup">
        <div class="popup-content">
            <span class="close-popup">&times;</span>
            <h2>Edit User</h2>
            <form id="editUserForm" action="Assets/php/update_user.php" method="POST">
                <input type="hidden" id="edit_username" name="username">
                
                <div class="form-group">
                    <label for="edit_password">Password</label>
                    <input type="password" id="edit_password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="edit_role">Role</label>
                    <select id="edit_role" name="role" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                
                <button type="submit" class="btn">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        // Edit button functionality
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-btn');
            const popup = document.getElementById('editPopup');
            const closePopup = document.querySelector('.close-popup');
            
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Get data from data attributes
                    const username = this.getAttribute('data-username');
                    const password = this.getAttribute('data-password');
                    const role = this.getAttribute('data-role');
                    
                    // Fill the form with existing data
                    document.getElementById('edit_username').value = username;
                    document.getElementById('edit_password').value = password;
                    document.getElementById('edit_role').value = role;
                    
                    // Show the popup
                    popup.style.display = 'flex';
                });
            });
            
            // Close popup when X is clicked
            closePopup.addEventListener('click', function() {
                popup.style.display = 'none';
            });
            
            // Close popup when clicking outside the content
            popup.addEventListener('click', function(e) {
                if (e.target === popup) {
                    popup.style.display = 'none';
                }
            });
        });

        // Toggle navigation
        const toggle = document.querySelector('.toggle');
        const navigation = document.querySelector('.navigation');
        const main = document.querySelector('.main');

        toggle.addEventListener('click', function() {
            navigation.classList.toggle('active');
            main.classList.toggle('active');
        });
    </script>
</body>
</html>