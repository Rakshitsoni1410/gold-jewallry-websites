<?php
// Get the payment status from the query string
$status = isset($_GET['status']) ? htmlspecialchars($_GET['status']) : 'Unknown Status';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
</head>
<body>
    <h1>Thank You for Your Payment!</h1>
    <p>Your payment status is: <strong><?php echo $status; ?></strong></p>
    <p>We appreciate your business!</p>
</body>
</html>
