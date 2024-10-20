<?php
// Configuration
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

header('Content-Type: application/json');
session_start();

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (true) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare and execute query to fetch the user by username
        $query = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $query->execute([$username]);
        $user = $query->fetch();

        // If user exists and password is correct
        if ($user && password_verify($password, $user['password'])) {
            // Store user data in session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];

            // Return success response with redirect URL
            echo json_encode([
                'loggedIn' => true,
                'redirect' => 'index.html'
            ]);
        } else {
            // Invalid credentials
            echo json_encode([
                'loggedIn' => false,
                'error' => 'Invalid username or password.'
            ]);
        }
        exit();
    }

    // Handle signup
   /* if (isset($_POST['signup'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

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
        exit();
    }*/
}

// Close the PDO connection
$pdo = null;
?>
