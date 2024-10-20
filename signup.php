<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection settings
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'shop';

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'error' => 'Database connection failed: ' . $e->getMessage()]));
}

// Set the response header to JSON
header('Content-Type: application/json');
session_start();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input data
    if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
        echo json_encode(['success' => false, 'error' => 'Please fill in all fields.']);
        exit;
    }

    // Retrieve and sanitize input data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Hash the password

    // Prepare and execute query to insert new user
    try {
        $query = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $success = $query->execute([$username, $email, $password]);

        // After successful signup
        if ($success) {
            echo json_encode(['success' => true, 'redirect' => 'index.html']);
        } else {
            // Signup failed for unknown reason
            echo json_encode(['success' => false, 'error' => 'Signup failed. Please try again.']);
        }
    } catch (PDOException $e) {
        if ($e->getCode() === '23000') {
            // Handle duplicate username/email error
            echo json_encode(['success' => false, 'error' => 'Username or email already exists.']);
        } else {
            // Other database error
            echo json_encode(['success' => false, 'error' => 'Error: ' . $e->getMessage()]);
        }
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No POST request received']);
}
?>