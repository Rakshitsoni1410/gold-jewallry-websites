<?php
session_start(); // Start session at the beginning

// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'shop';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error variable
$error = '';

// Process the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        // Handle login form submission
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare and execute query to fetch the user by username
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            echo json_encode(['loggedIn' => false, 'error' => $stmt->error]);
            exit;
        }
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Store user data in session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                echo json_encode(['loggedIn' => true]);
                exit;
            } else {
                $error = 'Invalid password';
            }
        } else {
            $error = 'Invalid username or password';
        }
    }
}

// Close the connection
$conn->close();
?>