<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root"; // Default username
$password = ""; // Default password
$database = "shop"; // Change this to your actual shared database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the tables
$tables = ['woman'];
$data = [];

foreach ($tables as $table) {
    // Update the SQL query to exclude price
    $sql = "SELECT image, description, carat FROM $table"; // Removed 'price'
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Assuming you want to store the carat as a string or array if you have multiple carats
                $row['carats'] = explode(',', $row['carat']); // Adjust this line based on how carat data is stored in the database
                $data[] = $row;
            }
        } else {
            echo "No records found.";
        }
    } else {
        echo "SQL Error: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelry Collection</title>
    <link rel="stylesheet" href="RINGT.CSS"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript" src="workforwishlist.js" async></script>
    <script src="addbutton.js" async></script>
</head>

<body>
<div class="head">
    <h2>Gold Woman Pendals</h2>
    <div class="icon">
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fa-heart" style="color: #e60abe;"></i>
        </button>

        <!-- Wishlist Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-black-50" id="exampleModalLabel">Wishlist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex gap-5" id="wishlist-container"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#cartModal">
            <i class="fa-solid fa-cart-shopping" style="color: #080707;"></i>
        </button>
        <a href="index.html"><i class="fa-solid fa-house" style="color: #080707;"></i></a>
    </div>

    <!-- Cart Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-black-50" id="cartModalLabel">Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="cart-container" class="modal-body d-flex gap-5"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://static.malabargoldanddiamonds.com/media/catalog/category/gold-pendant.jpg" class="d-block w-100" alt="Carousel Image">
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <?php foreach ($data as $item): ?>
            <div class="col-md-3 mb-4"> <!-- 4 cards per row on medium screens and above -->
                <div class="card">
                    <img src="<?php echo $item['image']; ?>" alt="Jewelry Image" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $item['description']; ?></h5>
                        <p class="available-carat">Available Carats:
                            <ul>
                                <?php foreach ($item['carats'] as $carat): ?>
                                    <li><?php echo $carat; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </p>
                        <div class="button-wrap">
                            <a href="#" class="cart button" id="add-to-cart"><i class="fa-solid fa-cart-shopping"></i></a>
                            <a href="#" class="wish button" id="wishlist"><i class="fa fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-2R8I6jZbMkZ6k8C6X5CfFZ0NF5hKj2a4YkK5lpuSQ4LPC2k6F1pmh8bxBOH4D1D6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-S2uH4G4x4OG3bZ5Qp4N2OHgiq1HIkqMSjsOWHA8h3I7qhrAdHSKgh9Fkp2mW7xXx" crossorigin="anonymous"></script>
</body>
</html>
