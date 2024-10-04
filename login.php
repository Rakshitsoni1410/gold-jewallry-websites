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

<!DOCTYPE html>
<html>
<head>
    <title>Login/Register Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="modal-body">
        <div class="panel">
            <div class="panel-header">
                <h2>Login/Register Panel</h2>
            </div>
            <div class="panel-body">
                <button class="toggle-button" id="login-btn">Login</button>
                <button class="toggle-button" id="register-btn">Register</button>
                <div class="register" id="register-form">
                    <form action="login.php" method="post">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required><br><br>
                        
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required><br><br>
                        
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required><br><br>
                        
                        <input type="submit" value="submit" name="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>