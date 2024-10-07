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
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $cardname = $_POST['cardname'];
    $cardnumber = $_POST['cardnumber'];
    $expmonth = $_POST['expmonth'];
    $expyear = $_POST['expyear'];
    $cvv = $_POST['cvv'];

    // Prepare and execute query to insert payment data
    $stmt = $conn->prepare("INSERT INTO payments (firstname, email, address, city, state, zip, cardname, cardnumber, expmonth, expyear, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $firstname, $email, $address, $city, $state, $zip, $cardname, $cardnumber, $expmonth, $expyear, $cvv);

    if ($stmt->execute()) {
        // Randomly determine the payment status
        $paymentStatus = rand(0, 1) ? 'Completed' : 'Not Completed';

        // Display the payment status to the user
        echo "<h2>Payment Status: $paymentStatus</h2>";
        
        // You can also redirect to a thank you page with the status if needed
        // header("Location: thank_you.php?status=$paymentStatus");
        // exit();
        
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Close the connection
$stmt->close();
$conn->close();
?>