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

    // Check if the email address exists in the users table
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Email address exists in the users table, proceed with inserting into payments table
        $query = "INSERT INTO payments (email, firstname, address, city, state, zip, cardname, cardnumber, expmonth, expyear, cvv)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssssssss", $email, $firstname, $address, $city, $state, $zip, $cardname, $cardnumber, $expmonth, $expyear, $cvv);

        if ($stmt->execute()) {
            // Randomly determine the payment status
            $paymentStatus = rand(0, 1) ? 'Completed' : 'Not Completed';

            // Update the payment status in the payments table
            $updateQuery = "UPDATE payments SET payment_status = ? WHERE email = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("ss", $paymentStatus, $email);
            $updateStmt->execute();

            // Display the payment status to the user
            echo "<h2>Payment Status: $paymentStatus</h2>";
            
            // Redirect to a thank you page with the status
            header("Location: thank_you.php?status=$paymentStatus");
            exit();
            
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        // Email address does not exist in the users table, display an error message
        echo "<h2>Error: Email address does not exist in the users table.</h2>";
    }
}

// Close the connection
$conn->close();
?>