<?php
// Start session handling
session_start();

// Database connection
function dbConnect() {
    $host = 'localhost';      // Server host
    $dbname = 'dct_ccs';      // Corrected database name
    $username = 'root';       // MySQL username
    $password = 'bendythe';   // MySQL password

    try {
        // Create PDO instance
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error mode
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

// Get the total number of subjects
function getTotalSubjects() {
    $db = dbConnect();
    $stmt = $db->query("SELECT COUNT(*) as count FROM subjects");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] ?? 0;
}

// Get the total number of students
function getTotalStudents() {
    $db = dbConnect();
    $stmt = $db->query("SELECT COUNT(*) as count FROM students");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] ?? 0;
}

// Get the total number of passed students
function getPassedStudents() {
    $db = dbConnect();
    $stmt = $db->query("
        SELECT COUNT(*) as count 
        FROM students_subjects 
        WHERE grade >= 75
    ");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] ?? 0;
}

// Get the total number of failed students
function getFailedStudents() {
    $db = dbConnect();
    $stmt = $db->query("
        SELECT COUNT(*) as count 
        FROM students_subjects 
        WHERE grade < 75
    ");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] ?? 0;
}

// Function for user registration
function registerUser($conn, $email, $password, $name) {
    // Hash the password using md5()
    $hashedPassword = md5($password);

    $sql = "INSERT INTO users (email, password, name) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $hashedPassword, $name);

    if ($stmt->execute()) {
        echo "Registration successful.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Function for user login
function loginUser($conn, $email, $password) {
    // Hash the password for comparison
    $hashedPassword = md5($password);

    // Hardcoded admin credentials
    $adminEmail = "admin@gmail.com";
    $adminPasswordHash = md5("catcat123");

    // Check if the user is the admin
    if ($email === $adminEmail) {
        if ($hashedPassword === $adminPasswordHash) {
            $_SESSION['email'] = $email;
            $_SESSION['role'] = 'admin'; // Optional: Assign admin role
            echo "Admin login successful. Welcome, Admin!";
            return true;
        } else {
            echo "Invalid password for admin account.";
            return false;
        }
    }

    // For non-admin users, check the database
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $hashedPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        $user = $result->fetch_assoc();
        $_SESSION['name'] = $user['name']; // Store the user's name for use
        echo "Login successful. Welcome, {$user['name']}!";
        return true;
    } else {
        echo "Invalid email or password.";
        return false;
    }
}
?>
