<?php
// Configuration
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'shop';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Start the session
session_start();

// Check if the login form has been submitted
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL query
    try {
        $stmt = $conn->prepare("SELECT * FROM admins WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Check if the query returned any results
        if ($stmt->rowCount() > 0) {
            // Set the admin session variable
            $_SESSION['admin'] = $username;
            // Redirect to the dashboard
            header('Location: dashboard.php');
            exit();
        } else {
            // Display an error message
            echo "Invalid username or password";
        }
    } catch(PDOException $e) {
        echo "Database error: " . $e->getMessage();
        exit();
    }
}

// Check if the admin is logged in
if (isset($_SESSION['admin'])) {
    // Redirect to the dashboard
    header('Location: dashboard.php');
    exit();
} else {
    // Add CSS styling to the login form
    ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .login-form {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-form label {
            display: block;
            margin-bottom: 10px;
        }

        .login-form input[type="text"], .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-form input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-form input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        .login-button {
            text-align: center;
        }
    </style>

    <!-- Create the login form -->
    <div class="login-form">
        <h2>Login</h2>
        <form action="" method="post">
            <label for="username">Admin id:</label>
            <input type="text" id="username" name="username"><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br><br>
            <div class="login-button">
                <input type="submit" name="login" value="Login">
            </div>
        </form>
    </div>
    <?php
}
?>