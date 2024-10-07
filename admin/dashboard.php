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

// Dashboard
if (isset($_SESSION['user_id'])) {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <i class="fa fa-user"></i>
                        <h5 class="card-title">Users</h5>
                        <p class="card-text">View user information</p>
                        <a href="user_info.php" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <i class="fa fa-money"></i>
                        <h5 class="card-title">Payments</h5>
                        <p class="card-text">View payment information</p>
                        <a href="payment_info.php" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    header('Location: login.php');
    exit;
}

// Close the connection
$conn->close();
?>