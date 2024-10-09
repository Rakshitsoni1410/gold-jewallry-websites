<?php
// Database Connection
session_start(); // Start the session
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'shop';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Logout function
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    // Unset all session variables
    $_SESSION = [];
    // Destroy the session
    session_destroy();
    // Redirect to the login page
    header("Location: login forthe admin.php"); // Change this to your actual login page URL
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-dashboard {
            padding: 20px;
        }
        .icon-container {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .icon-container i {
            font-size: 40px;
            color: #007bff;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .icon-container i:hover {
            transform: scale(1.1);
            color: #0056b3;
        }
        .modal-header {
            background-color: #007bff;
            color: white;
        }
        .table {
            margin-top: 10px;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
        }
        .table tbody tr {
            border-bottom: 1px solid #dddddd;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
        }
        .modal-footer {
            border-top: 1px solid #dddddd;
            background-color: #f8f9fa;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .btn-danger {
            background-color: #dc3545; /* Bootstrap danger color */
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333; /* Darker shade on hover */
        }
    </style>
</head>
<body>

<div class="container admin-dashboard">
    <h2 class="text-center mb-4">Admin Dashboard</h2>
    
    <!-- Logout Button -->
    <div class="text-right mb-3">
        <a href="?action=logout" class="btn btn-danger">Logout</a>
    </div>

    <div class="icon-container">
        <i class="fas fa-users" data-toggle="modal" data-target="#userModal" title="User Information"></i>
        <i class="fas fa-money-check-alt" data-toggle="modal" data-target="#paymentModal" title="Payment Information"></i>
        <i class="fas fa-box-open" data-toggle="modal" data-target="#orderModal" title="Order Information"></i>
        <i class="fas fa-comments" data-toggle="modal" data-target="#feedbackModal" title="Feedback Information"></i>
        <i class="fas fa-address-book" data-toggle="modal" data-target="#contactModal" title="Contact Information"></i>
    </div>

    <!-- User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">User Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    // Fetch user data
                    $stmt = $conn->prepare("SELECT * FROM users");
                    $stmt->execute();
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($data) {
                    ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Username</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data as $row) { ?>
                            <tr>
                                <td><?php echo $row['user_id'] ?? 'N/A'; ?></td>
                                <td><?php echo $row['username'] ?? 'N/A'; ?></td>
                                <td><?php echo $row['email'] ?? 'N/A'; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php } else {
                        echo "No user data available.";
                    } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    // Fetch all payment data
                    $stmt = $conn->prepare("SELECT * FROM payments");
                    $stmt->execute();
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>User Email</th>
                                <th>First Name</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zip</th>
                                <th>Card Name</th>
                                <th>Card Number</th>
                                <th>Exp Month</th>
                                <th>Exp Year</th>
                                <th>CVV</th>
                                <th>Amount</th>
                                <th>Payment Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data as $row) { ?>
                            <tr>
                                <td><?php echo $row['payment_id']; ?></td>
                                <td><?php echo $row['user_email']; ?></td>
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['city']; ?></td>
                                <td><?php echo $row['state']; ?></td>
                                <td><?php echo $row['zip']; ?></td>
                                <td><?php echo $row['cardname']; ?></td>
                                <td><?php echo $row['cardnumber']; ?></td>
                                <td><?php echo $row['expmonth']; ?></td>
                                <td><?php echo $row['expyear']; ?></td>
                                <td><?php echo $row['cvv']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo $row['payment_date']; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Order Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Order Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM orders");
                    $stmt->execute();
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>User ID</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data as $row) { ?>
                            <tr>
                                <td><?php echo $row['order_id']; ?></td>
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo $row['total']; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feedbackModalLabel">Feedback Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                // Fetch feedback data
                $stmt = $conn->prepare("SELECT f.id, f.user_email, f.name, f.feedback, f.rating, u.email AS user_email_registered FROM feedback f LEFT JOIN users u ON f.user_email = u.email");
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($data) {
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Email</th>
                            <th>Name</th>
                            <th>Feedback</th>
                            <th>Rating</th>
                            <th>Email Registered</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $row) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['user_email']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['feedback']; ?></td>
                            <td><?php echo $row['rating']; ?></td>
                            <td><?php echo ($row['user_email_registered'] == $row['user_email']) ? 'Yes' : 'No'; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <?php } else {
                    echo "No feedback data available.";
                } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Contact Modal -->
<?php
// Start the session and include the database connection
session_start();
require 'database_connection.php'; // Ensure you have this file that establishes $conn

// Fetch data from vendors table
$query = "SELECT * FROM vendors";
$result_vendors = $conn->query($query);

// Fetch data from collaborations table
$query = "SELECT * FROM collaborations";
$result_collab = $conn->query($query);

// Fetch data from careers table
$query = "SELECT * FROM careers";
$result_careers = $conn->query($query);

// Fetch data from contact table
$query = "SELECT * FROM contact";
$result_contact = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor and Collaboration Information</title>
    <!-- Include Bootstrap CSS and Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .list-group-item {
            padding: 15px;
        }
        .list-group-item i {
            font-size: 20px;
            margin-right: 10px;
        }
        .list-group-item a {
            text-decoration: none;
            color: #337ab7;
        }
        .list-group-item a:hover {
            color: #23527c;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Vendors Section -->
        <h2 class="mb-4">Vendors</h2>
        <ul class="list-group">
            <?php while ($row = $result_vendors->fetch_assoc()) { ?>
                <li class="list-group-item d-flex align-items-center">
                    <i class="fas fa-building me-3"></i>
                    <div>
                        <span class="fw-bold"><?php echo htmlspecialchars($row['company']); ?></span>
                        <p class="mb-1"><?php echo htmlspecialchars($row['product_service']); ?></p>
                        <a href="<?php echo htmlspecialchars($row['website']); ?>" target="_blank" class="text-primary">Visit Website</a>
                    </div>
                </li>
            <?php } ?>
        </ul>

        <!-- Collaborations Section -->
        <h2 class="mt-4 mb-4">Collaborations</h2>
        <ul class="list-group">
            <?php while ($row = $result_collab->fetch_assoc()) { ?>
                <li class="list-group-item d-flex align-items-center">
                    <i class="fas fa-handshake me-3"></i>
                    <div>
                        <span class="fw-bold"><?php echo htmlspecialchars($row['company']); ?></span>
                        <p class="mb-1"><?php echo htmlspecialchars($row['collab_type']); ?></p>
                        <a href="<?php echo htmlspecialchars($row['website']); ?>" target="_blank" class="text-primary">Visit Website</a>
                    </div>
                </li>
            <?php } ?>
        </ul>

        <!-- Careers Section -->
        <h2 class="mt-4 mb-4">Careers</h2>
        <ul class="list-group">
            <?php while ($row = $result_careers->fetch_assoc()) { ?>
                <li class="list-group-item d-flex align-items-center">
                    <i class="fas fa-briefcase me-3"></i>
                    <div>
                        <span class="fw-bold"><?php echo htmlspecialchars($row['position']); ?></span>
                        <p class="mb-1"><?php echo htmlspecialchars($row['cover_letter']); ?></p>
                        <a href="<?php echo htmlspecialchars($row['portfolio']); ?>" target="_blank" class="text-primary">View Portfolio</a>
                    </div>
                </li>
            <?php } ?>
        </ul>

        <!-- Contact Section -->
        <h2 class="mt-4 mb-4">Contact</h2>
        <ul class="list-group">
            <?php while ($row = $result_contact->fetch_assoc()) { ?>
                <li class="list-group-item d-flex align-items-center">
                <i class="fas fa-envelope me-3"></i>
                <div>
                    <span><?php echo htmlspecialchars($row['message']); ?></span>
                </div>
            </li>
        <?php } ?>
        </ul>
    </div>

    <!-- Modal for Contact Information -->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Contact Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    // Assuming the contact details are stored in a similar way, you can pull the details like this
                    $query_contact_details = "SELECT * FROM contact_details WHERE contact_id = ?"; // Example query, update according to your schema
                    $stmt = $conn->prepare($query_contact_details);
                    $stmt->execute();
                    $result_contact_details = $stmt->get_result();

                    while ($contact_row = $result_contact_details->fetch_assoc()) { ?>
                        <p><strong>Name:</strong> <?php echo htmlspecialchars($contact_row['name']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($contact_row['email']); ?></p>
                        <p><strong>Message:</strong> <?php echo htmlspecialchars($contact_row['message']); ?></p>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


</body>
</html>

