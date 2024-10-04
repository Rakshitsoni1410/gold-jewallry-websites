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

// Get user data
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM user WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

// Get order data
$stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$order_data = $result->fetch_all(MYSQLI_ASSOC);

// Get product data
$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$result = $stmt->get_result();
$product_data = $result->fetch_all(MYSQLI_ASSOC);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Account</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Welcome, <?php echo $user_data['username']; ?>!</h1>
        <section>
            <h2>Orders</h2>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                <?php foreach ($order_data as $order) { ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['product_name']; ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td><?php echo $order['total']; ?></td>
                </tr>
                <?php } ?>
            </table>
        </section>
        <section>
            <h2>Products</h2>
            <table>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
                <?php foreach ($product_data as $product) { ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                </tr>
                <?php } ?>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; 2023</p>
    </footer>
</body>
</html>