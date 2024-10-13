<?php
// Start the session
session_start();


$servername = 'localhost'; 
$username = 'root';         
$password = '';            
$dbname = 'shop';           

try {
    
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Uncomment this line to check if the connection is successful
    // echo "Connected successfully"; 
} catch (PDOException $e) {
    // Catch any connection errors and display the message
    echo "Connection failed: " . $e->getMessage();
    exit(); // Stop the script if the connection fails
}

// Logout function
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    // Unset all session variables
    $_SESSION = [];
    // Destroy the session
    session_destroy();
   
    header("Location: login forthe admin.php"); // Change this to your actual login page URL
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
  
</head>
<body>
    <!-- Logout Button -->
    <div class="logout">
        <a href="?action=logout" class="btn btn-danger"> Logout</a>
    </div>

    


<!-- Include Bootstrap and Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Admin Panel Dashboard Icons -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Admin Panel</h2>
    <div class="row text-center">
        <div class="col-md-3">
            <i class="fas fa-users fa-3x text-primary" data-toggle="collapse" href="#users-table" role="button" aria-expanded="false" aria-controls="users-table"></i>
            <p>Users</p>
        </div>
        <div class="col-md-3">
            <i class="fas fa-money-check-alt fa-3x text-success" data-toggle="collapse" href="#payments-table" role="button" aria-expanded="false" aria-controls="payments-table"></i>
            <p>Payments</p>
        </div>
        <div class="col-md-3">
            <i class="fas fa-comment fa-3x text-warning" data-toggle="collapse" href="#feedback-table" role="button" aria-expanded="false" aria-controls="feedback-table"></i>
            <p>Feedback</p>
        </div>
        <div class="col-md-3">
            <i class="fas fa-question-circle fa-3x text-info" data-toggle="collapse" href="#inquiries-table" role="button" aria-expanded="false" aria-controls="inquiries-table"></i>
            <p>Inquiries</p>
        </div>
    </div>

    <div class="row text-center mt-4">
        <div class="col-md-3">
            <i class="fas fa-briefcase fa-3x text-danger" data-toggle="collapse" href="#careers-table" role="button" aria-expanded="false" aria-controls="careers-table"></i>
            <p>Careers</p>
        </div>
        <div class="col-md-3">
            <i class="fas fa-industry fa-3x text-dark" data-toggle="collapse" href="#vendors-table" role="button" aria-expanded="false" aria-controls="vendors-table"></i>
            <p>Vendors</p>
        </div>
        <div class="col-md-3">
            <i class="fas fa-handshake fa-3x text-secondary" data-toggle="collapse" href="#collaborations-table" role="button" aria-expanded="false" aria-controls="collaborations-table"></i>
            <p>Collaborations</p>
        </div>
    </div>

    <!-- Collapsible Tables -->
    <div class="collapse" id="users-table">
        <div class="card card-body mt-3">
            <h3>Users</h3>
            <button class="btn btn-sm btn-danger mb-3 float-right" data-toggle="collapse" href="#users-table" role="button" aria-expanded="false" aria-controls="users-table">Close</button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch user data
                    $stmt = $conn->prepare("SELECT * FROM users");
                    $stmt->execute();
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $row) { ?>
                        <tr>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['password']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

   <!-- Payments Table -->
<div class="collapse" id="payments-table">
    <div class="card card-body mt-3">
        <h3><i class="fas fa-credit-card" style="color: #337ab7; margin-right: 10px;"></i> Payments</h3>
        <button class="btn btn-sm btn-danger mb-3 float-right" data-toggle="collapse" href="#payments-table" role="button" aria-expanded="false" aria-controls="payments-table">Close</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="background-color: #337ab7; color: #fff; padding: 10px; border: 1px solid #337ab7;">ID</th>
                    <th style="background-color: #337ab7; color: #fff; padding: 10px; border: 1px solid #337ab7;">Email</th>
                    <th style="background-color: #337ab7; color: #fff; padding: 10px; border: 1px solid #337ab7;">Firstname</th>
                    <th style="background-color: #337ab7; color: #fff; padding: 10px; border: 1px solid #337ab7;">Address</th>
                    <th style="background-color: #337ab7; color: #fff; padding: 10px; border: 1px solid #337ab7;">City</th>
                    <th style="background-color: #337ab7; color: #fff; padding: 10px; border: 1px solid #337ab7;">State</th>
                    <th style="background-color: #337ab7; color: #fff; padding: 10px; border: 1px solid #337ab7;">Zip</th>
                    <th style="background-color: #337ab7; color: #fff; padding: 10px; border: 1px solid #337ab7;">Card Name</th>
                    <th style="background-color: #337ab7; color: #fff; padding: 10px; border: 1px solid #337ab7;">Card Number</th>
                    <th style="background-color: #337ab7; color: #fff; padding: 10px; border: 1px solid #337ab7;">Exp. Month</th>
                    <th style="background-color: #337ab7; color: #fff; padding: 10px; border: 1px solid #337ab7;">Exp. Year</th>
                    <th style="background-color: #337ab7; color: #fff; padding: 10px; border: 1px solid #337ab7;">CVV</th>
                    <th style="background-color: #337ab7; color: #fff; padding: 10px; border: 1px solid #337ab7;">Payment Status</th>
                    <th style="background-color: #337ab7; color: #fff; padding: 10px; border: 1px solid #337ab7;">Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch payment data
                $stmt = $conn->prepare("SELECT * FROM payments");
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($data as $row) { ?>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['id']; ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['email']; ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['firstname']; ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['address']; ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['city']; ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['state']; ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['zip']; ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['cardname']; ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['cardnumber']; ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['expmonth']; ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['expyear']; ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['cvv']; ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['payment_status']; ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['created_at']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

    <!-- Add similar blocks for Feedback, Inquiries, Careers, Vendors, and Collaborations as shown above. -->
     <!-- Collapsible Tables for Feedback, Inquiries, Careers, Vendors, and Collaborations -->
<div class="collapse" id="feedback-table">
    <div class="card card-body mt-3">
        <h3>Feedback</h3>
        <button class="btn btn-sm btn-danger mb-3 float-right" data-toggle="collapse" href="#feedback-table" role="button" aria-expanded="false" aria-controls="feedback-table">Close</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Email</th>
                    <th>Name</th>
                    <th>Feedback</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch feedback data
                $stmt = $conn->prepare("SELECT * FROM feedback");
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['user_email']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['feedback']; ?></td>
                        <td><?php echo $row['rating']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="collapse" id="inquiries-table">
    <div class="card card-body mt-3">
        <h3>Inquiries</h3>
        <button class="btn btn-sm btn-danger mb-3 float-right" data-toggle="collapse" href="#inquiries-table" role="button" aria-expanded="false" aria-controls="inquiries-table">Close</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Type</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch inquiry data
                $stmt = $conn->prepare("SELECT * FROM inquiries");
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                        <td><?php echo $row['type']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="collapse" id="careers-table">
    <div class="card card-body mt-3">
        <h3>Careers</h3>
        <button class="btn btn-sm btn-danger mb-3 float-right" data-toggle="collapse" href="#careers-table" role="button" aria-expanded="false" aria-controls="careers-table">Close</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Inquiry ID</th>
                    <th>Position</th>
                    <th>Cover Letter</th>
                    <th>Portfolio</th>
                    <th>Resume</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch career data
                $stmt = $conn->prepare("SELECT * FROM careers");
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['inquiry_id']; ?></td>
                        <td><?php echo $row['position']; ?></td>
                        <td><?php echo $row['cover_letter']; ?></td>
                        <td><?php echo $row['portfolio']; ?></td>
                        <td><?php echo $row['resume']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="collapse" id="vendors-table">
    <div class="card card-body mt-3">
        <h3>Vendors</h3>
        <button class="btn btn-sm btn-danger mb-3 float-right" data-toggle="collapse" href="#vendors-table" role="button" aria-expanded="false" aria-controls="vendors-table">Close</button>
        <table class="table table-striped">
            <thead>
                <tr>
              
                    <th>Inquiry ID</th>
                    <th>Company</th>
                    <th>Product/Service</th>
                    <th>Website</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch vendor data
                $stmt = $conn->prepare("SELECT * FROM vendors");
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($data as $row) { ?>
                    <tr>
                        
                        <td><?php echo $row['inquiry_id']; ?></td>
                        <td><?php echo $row['company']; ?></td>
                        <td><?php echo $row['product_service']; ?></td>
                        <td><?php echo $row['website']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div><div class="collapse" id="collaborations-table">
    <div class="card card-body mt-3">
        <h3>Collaborations</h3>
        <button class="btn btn-sm btn-danger mb-3 float-right" data-toggle="collapse" href="#collaborations-table" role="button" aria-expanded="false" aria-controls="collaborations-table">Close</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Collaboration Type</th>
                    <th>Website</th>
                    <th>Message</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch collaboration data
                try {
                    $stmt = $conn->prepare("SELECT id, company_name, email_address, phone_number, collab_type, website_url, message_content, created_at FROM collaborations");
                    $stmt->execute();
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($data) { // Check if there are results
                        foreach ($data as $row) {
                            // Output each field using echo
                            echo "<tr>
                                    <td>" . $row['id'] . "</td>
                                    <td>" . $row['company_name'] . "</td>
                                    <td>" . $row['email_address'] . "</td>
                                    <td>" . $row['phone_number'] . "</td>
                                    <td>" . $row['collab_type'] . "</td>
                                    <td>" . $row['website_url'] . "</td>
                                    <td>" . $row['message_content'] . "</td>
                                    <td>" . $row['created_at'] . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No collaborations found.</td></tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='8'>Error fetching data: " . $e->getMessage() . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Product Management Icon with Add, Update, and Delete Options -->

<body>
    <div class="container mt-5">

        <div class="row text-center">
            <div class="col-md-3">
                <i class="fas fa-boxes fa-3x text-info" data-toggle="collapse" href="#products-table" role="button" aria-expanded="false" aria-controls="products-table"></i>
                <p>Products</p>
            </div>
        </div>

        <div class="collapse" id="products-table">
            <div class="card card-body mt-3">
                <h3>Products</h3>
                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addProductModal">
                    <i class="fas fa-plus-circle"></i> Add Product
                </button>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Database connection
                        $conn = new PDO('mysql:host=localhost;dbname=your_database', 'your_username', 'your_password');

                        // Fetch product data
                        $stmt = $conn->prepare("SELECT * FROM products");
                        $stmt->execute();
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($data as $row) { ?>
                            <tr>
                                <td><?php echo $row['product_id']; ?></td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td>
                                    <!-- Update and Delete Icons -->
                                    <a href="update_product.php?id=<?php echo $row['product_id']; ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Update
                                    </a>
                                    <button class="btn btn-danger btn-sm delete-product" data-id="<?php echo $row['product_id']; ?>">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Product -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="add_product.php" method="post">
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Deleting Product -->
    <script>
        $(document).ready(function() {
            $('.delete-product').click(function() {
                var productId = $(this).data('id');

                if (confirm("Are you sure you want to delete this product?")) {
                    // Send AJAX request to delete the product
                    $.ajax({
                        url: 'delete_product.php',
                        method: 'POST',
                        data: {
                            product_id: productId
                        },
                        success: function(response) {
                            if (response == 'success') {
                                alert("Product deleted successfully!");
                                location.reload();
                            } else {
                                alert("Failed to delete product. Please try again.");
                            }
                        },
                        error: function() {
                            alert("An error occurred while processing your request.");
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>

    
     
<!-- Include Bootstrap and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
