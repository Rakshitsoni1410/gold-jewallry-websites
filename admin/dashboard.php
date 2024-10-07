<?php
// Configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Start session
session_start();

// Dashboard
if (isset($_SESSION['admin'])) {
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
$conn = null;
?>