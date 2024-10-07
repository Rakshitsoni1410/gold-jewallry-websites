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

    // Use a LEFT JOIN to check if the email address exists in the users table
    $query = "INSERT INTO payments (email, firstname, address, city, state, zip, cardname, cardnumber, expmonth, expyear, cvv)
              SELECT u.email, '$firstname', '$address', '$city', '$state', '$zip', '$cardname', '$cardnumber', '$expmonth', '$expyear', '$cvv'
              FROM users u
              WHERE u.email = '$email'";

    if ($conn->query($query) === TRUE) {
        // Randomly determine the payment status
        $paymentStatus = rand(0, 1) ? 'Completed' : 'Not Completed';

        // Display the payment status to the user
        echo "<h2>Payment Status: $paymentStatus</h2>";
        
        // Redirect to a thank you page with the status
        header("Location: thank_you.php?status=$paymentStatus");
        exit();
        
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>