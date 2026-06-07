<?php
session_start(); // Start session

$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "empowerher"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling User Registration
if (isset($_POST["signUp"])) {
    $firstName = $_POST["fName"];
    $lastName = $_POST["lName"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Secure password

    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! You can now login.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handling User Login
if (isset($_POST["signIn"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $row["first_name"];
            header("Location: welcome.php"); // Redirect to welcome page
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with this email!";
    }
}

$conn->close();
