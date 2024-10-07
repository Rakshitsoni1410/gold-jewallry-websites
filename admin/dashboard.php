<?php
// Database Connection
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
        }
    </style>
</head>
<body>

<div class="container admin-dashboard">
    <h2 class="text-center mb-4">Admin Dashboard</h2>
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
                    $stmt = $conn->prepare("SELECT * FROM payment");
                    $stmt->execute();
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>User ID</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data as $row) { ?>
                            <tr>
                                <td><?php echo $row['payment_id']; ?></td>
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
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
                // Modify the SQL query to use the correct column name for user reference
                $stmt = $conn->prepare("
                    SELECT f.feedback_id, u.email AS user_email, f.feedback
                    FROM feedback f
                    JOIN users u ON f.user_email = u.email  -- Update this line if necessary
                ");
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Feedback ID</th>
                            <th>User Email</th> <!-- Change header -->
                            <th>Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $row) { ?>
                        <tr>
                            <td><?php echo $row['feedback_id']; ?></td>
                            <td><?php echo $row['user_email'] ?? 'N/A'; ?></td> <!-- Change to user email -->
                            <td><?php echo $row['feedback']; ?></td>
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


    <!-- Contact Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Contact Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM contact");
                    $stmt->execute();
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Contact ID</th>
                                <th>User ID</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data as $row) { ?>
                            <tr>
                                <td><?php echo $row['contact_id']; ?></td>
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo $row['message']; ?></td>
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
</div>

</body>
</html>
