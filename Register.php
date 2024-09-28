<?php
// Enable error reporting for debugging (optional but recommended during development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost"; // or the IP address of the server
$username = "root"; // your MySQL username
$password = ""; // your MySQL password (leave empty for default XAMPP/WAMP)
$dbname = "registration_db"; // the database you created

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize user input to avoid SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Check if any form fields are empty (simple validation)
    if (empty($username) || empty($email) || empty($password)) {
        echo "All fields are required!";
    } else {
        // Hash the password before storing it for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert data into the users table
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

        // Execute the query and check if it was successful
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
