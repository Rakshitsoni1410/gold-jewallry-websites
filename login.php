<?php
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

// Process the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }

        if ($stmt->affected_rows > 0) {
            // Registration successful, redirect to login page
            header('Location: login.php');
            exit;
        } else {
            $error = 'Registration failed';
        }
    }
}

// Close connection
$conn->close();
?>
