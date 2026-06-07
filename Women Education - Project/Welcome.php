<?php
session_start(); // Start session to store username

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signUp']) && !empty($_POST['fName'])) {
        $firstName = htmlspecialchars($_POST['fName']); // Get first name
        $_SESSION['username'] = $firstName; // Store in session
    } elseif (isset($_SESSION['username'])) {
        $firstName = $_SESSION['username']; // Get stored username
    } else {
        $firstName = "User"; // Default name if first name is missing
    }

    echo "<h1>Welcome, $firstName!</h1>";
} else {
    echo "<h1>Access Denied</h1>";
}
?>
