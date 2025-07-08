<?php
// Start session and destroy it
session_start();
session_unset();
session_destroy();

// Prevent page caching
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Redirect to homepage
header("Location: HomePage.html");
exit();
?>