<?php
// Start session handling
session_start();

// Database connection configuration
$host = 'localhost'; // Update as needed
$username = 'root'; // Replace with your MySQL username
$password = 'bendythe'; // Replace with your MySQL password
$dbname = 'dct_ccs'; // Database name

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function for user registration
function registerUser($conn, $username, $password) {
    // Hash the password using md5()
    $hashedPassword = md5($password);

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
        echo "Registration successful.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Function for user login
function loginUser($conn, $username, $password) {
    // Hash the password using md5()
    $hashedPassword = md5($password);

    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashedPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        echo "Login successful. Welcome, $username!";
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}
?>
