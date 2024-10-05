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

// Start session
session_start();

// Process the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        // Handle login form submission
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare and execute query to fetch the user by username
        $stmt = $conn->prepare("SELECT * FROM user WHERE username=?");
        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password using password_verify()
            if (password_verify($password, $user['password'])) {
                // Store user data in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Redirect to home page
                header('Location: index.html');
                exit;
            } else {
                $error = 'Invalid password';
            }
        } else {
            $error = 'Invalid username or password';
        }
    } elseif (isset($_POST['submit'])) {
        // Handle registration form submission
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute query to insert the new user
        $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }

        if ($stmt->affected_rows > 0) {
            // Registration successful, redirect to home page
            header('Location: index.html');
            exit;
        } else {
            $error = 'Registration failed';
        }
    }
}

// Close the connection
$conn->close();
?>
