<?php
include_once 'connection.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
}

$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->fetchAll();

$stmt = $conn->prepare("SELECT * FROM orders");
$stmt->execute();
$orders = $stmt->fetchAll();

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll();
?>

<h1>Admin Dashboard</h1>

<h2>Products</h2>
<ul>
    <?php foreach ($products as $product) { ?>
    <li><?php echo $product['name']; ?></li>
    <?php } ?>
</ul>

<h2>Orders</h2>
<ul>
    <?php foreach ($orders as $order) { ?>
    <li><?php echo $order['id']; ?></li>
    <?php } ?>
</ul>

<h2>Users</h2>
<ul>
    <?php foreach ($users as $user) { ?>
    <li><?php echo $user['username']; ?></li>
    <?php } ?>
</ul>