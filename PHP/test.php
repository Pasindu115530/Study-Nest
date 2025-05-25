<?php
// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $fname = isset($_POST["fname"]) ? htmlspecialchars($_POST["fname"]) : '';
    $lname = isset($_POST["lname"]) ? htmlspecialchars($_POST["lname"]) : '';
    $uname = isset($_POST["name"]) ? htmlspecialchars($_POST["fname"]) : '';
    $uname = isset($_POST["uname"]) ? htmlspecialchars($_POST["uname"]) : '';
    $mail = isset($_POST["mail"]) ? htmlspecialchars($_POST["mail"]) : '';
    $pnumber = isset($_POST["pnumber"]) ? htmlspecialchars($_POST["pnumber"]) : '';
    $pw = isset($_POST["pw"]) ? htmlspecialchars($_POST["pw"]) : '';
    $pwconfirm = isset($_POST["pwconfirm"]) ? htmlspecialchars($_POST["pwconfirm"]) : '';

    
    #echo "Welcome " . $fname ." ".$lname. "<br>";
    #echo "Your email address is: " . $mail. "<br>";
    #echo "Your phone number is: " . $pnumber. "<br>";
}
header("Location: ..\HomePage.php");
exit();
?>