<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'shop';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connection established successfully.<br>";
}

// Function to handle file upload
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

    // Allow certain file formats
    if ($imageFileType != "pdf" && $imageFileType != "docx" && $imageFileType != "doc") {
        echo "Sorry, only PDF, DOCX and DOC files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }
    return false; // Return false if upload failed
}

// Handle form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // General Inquiry Form
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $sql = "INSERT INTO inquiries (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);
        
        if ($stmt->execute()) {
            echo "General inquiry submitted successfully!<br>";
        } else {
            echo "Error: " . $stmt->error . "<br>";
        }
        $stmt->close();
    }

    // Careers Form
    if (isset($_POST['career-name']) && isset($_POST['career-email']) && isset($_POST['career-phone']) && isset($_POST['position']) && isset($_FILES['resume']) && isset($_POST['cover-letter'])) {
        $name = $_POST['career-name'];
        $email = $_POST['career-email'];
        $phone = $_POST['career-phone'];
        $position = $_POST['position'];
        $resume = uploadFile($_FILES['resume']); // Upload file
        $cover_letter = $_POST['cover-letter'];
        $portfolio = $_POST['portfolio'];

        if ($resume) { // Ensure resume upload was successful
            $sql = "INSERT INTO careers (name, email, phone, position, resume, cover_letter, portfolio) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $name, $email, $phone, $position, $resume, $cover_letter, $portfolio);
            
            if ($stmt->execute()) {
                echo "Career application submitted successfully!<br>";
            } else {
                echo "Error: " . $stmt->error . "<br>";
            }
            $stmt->close();
        }
    }

    // Collaboration and Partnership Form
    if (isset($_POST['collab-name']) && isset($_POST['company']) && isset($_POST['collab-email']) && isset($_POST['collab-type']) && isset($_POST['collab-website']) && isset($_POST['collab-message'])) {
        $name = $_POST['collab-name'];
        $company = $_POST['company'];
        $email = $_POST['collab-email'];
        $phone = $_POST['collab-phone'];
        $collaboration_type = $_POST['collab-type'];
        $website = $_POST['collab-website'];
        $message = $_POST['collab-message'];

        $sql = "INSERT INTO collaborations (name, company, email, phone, collaboration_type, website, message) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $name, $company, $email, $phone, $collaboration_type, $website, $message);
        
        if ($stmt->execute()) {
            echo "Collaboration request submitted successfully!<br>";
        } else {
            echo "Error: " . $stmt->error . "<br>";
        }
        $stmt->close();
    }

    // Vendor Form
    if (isset($_POST['vendor-name']) && isset($_POST['vendor-company']) && isset($_POST['vendor-email']) && isset($_POST['vendor-phone']) && isset($_POST['vendor-product']) && isset($_POST['vendor-website']) && isset($_POST['vendor-message'])) {
        $name = $_POST['vendor-name'];
        $company = $_POST['vendor-company'];
        $email = $_POST['vendor-email'];
        $phone = $_POST['vendor-phone'];
        $product_service = $_POST['vendor-product'];
        $website = $_POST['vendor-website'];
        $message = $_POST['vendor-message'];

        $sql = "INSERT INTO vendors (name, company, email, phone, product_service, website, message) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $name, $company, $email, $phone, $product_service, $website, $message);
        
        if ($stmt->execute()) {
            echo "Vendor inquiry submitted successfully!<br>";
        } else {
            echo "Error: " . $stmt->error . "<br>";
        }
        $stmt->close();
    }
}

// Close the database connection
$conn->close();

?>
