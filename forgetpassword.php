<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'shop';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password , $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to reset password
function reset_password($email, $new_password) {
    global $conn;
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $new_password, $email);
    $stmt->execute();
    $stmt->close();
}

// Function to send reset password email
function send_reset_password_email($email, $token) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_data = $result->fetch_assoc();
    $stmt->close();

    if ($user_data) {
        $subject = "Reset your password on our website";
        $msg = "Hi there, click on this <a href='http://localhost/reset_password.php?token=" . $token . "'>link</a> to reset your password on our site";
        $msg = wordwrap($msg, 70);
        $headers = "From: [email@localhost]";
        mail($email, $subject, $msg, $headers);
    }
}

// Function to generate token
function generate_token() {
    return bin2hex(random_bytes(50));
}

// Check if user wants to reset password
if (isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    $token = generate_token();
    send_reset_password_email($email, $token);
    $stmt = $conn->prepare("INSERT INTO password_reset (email, token) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();
    $stmt->close();
    header('location: pending.php?email=' . $email);
}

// Check if user wants to enter new password
if (isset($_POST['new_password'])) {
    $new_password = $_POST['new_pass'];
    $new_password_c = $_POST['new_pass_c'];
    $token = $_POST['token'];

    if ($new_password == $new_password_c) {
        $stmt = $conn->prepare("SELECT * FROM password_reset WHERE token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $reset_data = $result->fetch_assoc();
        $stmt->close();

        if ($reset_data) {
            $email = $reset_data['email'];
            reset_password($email, $new_password);
            header('location: index.php');
        }
    }
}

// Close connection
$conn->close();
?>