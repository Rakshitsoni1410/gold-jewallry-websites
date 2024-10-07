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

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];
    $rating = $_POST['rating'];

    // Validate if the email exists in the users table
    $stmt = $conn->prepare("SELECT email FROM user WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email exists, proceed to insert feedback
        $insertStmt = $conn->prepare("INSERT INTO feedback (user_email, name, feedback, rating) VALUES (?, ?, ?, ?)");
        $insertStmt->bind_param('sssi', $email, $name, $feedback, $rating);

        if ($insertStmt->execute()) {
            echo "Feedback submitted successfully!";
        } else {
            echo "Error submitting feedback. Please try again.";
        }
    } else {
        // Email does not exist in the users table
        echo "Error: The email provided does not match any user account.";
    }
}

// Close connection
$conn->close();
?>
