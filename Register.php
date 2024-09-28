<?php
// Configuration
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "registration_db";

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate form data
    if (empty($username) || empty($email) || empty($password)) {
        echo "Please fill in all fields.";
    } else {
        // Hash password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare query
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Registration successful!";
            // You can also start a session or redirect to a protected page
        } else {
            echo "Registration failed: " . $conn->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>