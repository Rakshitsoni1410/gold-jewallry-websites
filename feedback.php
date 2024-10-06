<!-- PHP Code (feedback.php) -->
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
    $name = $_POST["name"];
    $email = $_POST["email"];
    $feedback = $_POST["feedback"];
    $rating = $_POST["rating"];

    // Insert data into database
    $sql = "INSERT INTO feedback (name, email, feedback, rating) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $feedback, $rating);
    $stmt->execute();

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Display success message
    echo "Thank you for sharing your thoughts! Your feedback has been submitted successfully.";
} else {
    // Display error message
    echo "Error: Unable to submit feedback. Please try again.";
}
?>