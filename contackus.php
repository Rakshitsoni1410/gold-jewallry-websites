<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'shop';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connection established successfully.<br>";
}

// File upload function
function uploadFile($file) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    // Check file size (limit to 500KB)
    if ($file["size"] > 500000) {
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if (!in_array($imageFileType, ['pdf', 'docx', 'doc'])) {
        echo "Sorry, only PDF, DOCX, and DOC files are allowed.<br>";
        $uploadOk = 0;
    }

    // Try to upload file if all checks pass
    if ($uploadOk == 1) {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }
    return false; // Return false if the upload fails
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // General Inquiry Form
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $subject = $conn->real_escape_string($_POST['subject']);
        $message = $conn->real_escape_string($_POST['message']);

        $sql = "INSERT INTO inquiries (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);

        if ($stmt->execute()) {
            echo "General inquiry submitted successfully!<br>";
            header('Location: index.html');
            exit;
        } else {
            echo "Error: " . $stmt->error . "<br>";
        }
        $stmt->close();
    }

    // Careers Form
    if (isset($_POST['career-name']) && isset($_POST['career-email']) && isset($_POST['career-phone']) && isset($_POST['position']) && isset($_FILES['resume'])) {
        $position = $conn->real_escape_string($_POST['position']);
        $cover_letter = $conn->real_escape_string($_POST['cover-letter']);
        $portfolio = isset($_POST['portfolio']) ? $conn->real_escape_string($_POST['portfolio']) : ''; // Optional

        // Handle file upload
        $resume = uploadFile($_FILES['resume']);

        if ($resume) {
            // Insert into careers (note: inquiry_id removed)
            $stmt = $conn->prepare("INSERT INTO careers (position, cover_letter, portfolio, resume) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $position, $cover_letter, $portfolio, $resume);

            if ($stmt->execute()) {
                echo "Career application submitted successfully!<br>";
                header('Location: index.html');
                exit;
            } else {
                echo "Error: " . $stmt->error . "<br>";
            }
            $stmt->close();
        }
    }

// Collaboration Form

// Database connection


try {
    // Database connection
    $conn = new PDO("mysql:host=localhost;dbname=shop", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if all required fields are set
        if (isset($_POST['collab-name'], $_POST['company'], $_POST['collab-email'], $_POST['collab-type'], $_POST['collab-website'], $_POST['collab-message'])) {
            
            // Get form data
            $collabName = $_POST['collab-name']; // Ensure this corresponds with your form
            $company = $_POST['company'];
            $email = $_POST['collab-email'];
            $phone = isset($_POST['collab-phone']) ? $_POST['collab-phone'] : ''; // Optional
            $collabType = $_POST['collab-type'];
            $website = $_POST['collab-website'];
            $message = $_POST['collab-message'];

            // Prepare SQL insert query with the correct column names
            $stmt = $conn->prepare("INSERT INTO collaborations (name, company, email_address, phone_number, collab_type, website_url, message_content) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");

            // Execute the statement with values directly passed as an array
            if ($stmt->execute([$collabName, $company, $email, $phone, $collabType, $website, $message])) {
                echo "Data inserted successfully!";
            } else {
                echo "Failed to insert data.";
            }

        } else {
            echo "Error: Please fill in all required fields.";
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


// Vendor Form
if (isset($_POST['vendor-name']) && isset($_POST['vendor-company']) && isset($_POST['vendor-email']) && isset($_POST['vendor-phone']) && isset($_POST['vendor-product']) && isset($_POST['vendor-website']) && isset($_POST['vendor-message'])) {

    // Insert into vendors (note: inquiry_id removed)
    $sql = "INSERT INTO vendors (company, product_service, website, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST['vendor-company'], $_POST['vendor-product'], $_POST['vendor-website'], $_POST['vendor-message']]);

    if ($stmt) {
        echo "Vendor inquiry submitted successfully!<br>";
        header('Location: index.html');
        exit;
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }
}

// No need to explicitly close the connection in PDO
$conn = null; // This will close the connection
}
?>
