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
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

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
    if (isset($_POST['career-name']) && isset($_POST['career-email']) && isset($_POST['career-phone']) && isset($_POST['position']) && isset($_FILES['resume'])) {
        $name = mysqli_real_escape_string($conn, $_POST['career-name']);
        $email = mysqli_real_escape_string($conn, $_POST['career-email']);
        $phone = mysqli_real_escape_string($conn, $_POST['career-phone']);
        $position = mysqli_real_escape_string($conn, $_POST['position']);
        $resume = uploadFile($_FILES['resume']);
        $cover_letter = isset($_POST['cover-letter']) ? mysqli_real_escape_string($conn, $_POST['cover-letter']) : ''; // Optional
        $portfolio = isset($_POST['portfolio']) ? mysqli_real_escape_string($conn, $_POST['portfolio']) : ''; // Optional

        if ($resume) {
            $sql = "INSERT INTO careers (name, email, phone, position, resume, cover_letter, portfolio) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $name, $email, $phone, $position, $resume, $cover_letter, $portfolio);

            if ($stmt->execute()) {
                echo "Career application submitted successfully!<br>";
                header('Location: index.php');
                exit;
            } else {
                echo "Error: " . $stmt->error . "<br>";
            }
            $stmt->close();
        }
    }


// Collaboration Form
if (isset($_POST['collab-name']) && isset($_POST['company']) && isset($_POST['collab-email']) && isset($_POST['collab-type']) && isset($_POST['collab-website']) && isset($_POST['collab-message'])) {
    
    // Prepare SQL statement for collaboration
    $sql = "INSERT INTO collaborations (company_name, email_address, phone_number, collab_type, website_url, message_content, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    
    // Check if statement preparation was successful
    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("ssssss", 
            $_POST['company'], 
            $_POST['collab-email'], 
            $_POST['collab-phone'], 
            $_POST['collab-type'], 
            $_POST['collab-website'], 
            $_POST['collab-message']
        );
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "Collaboration request submitted successfully!<br>";
            header('Location: index.php');
            exit;
        } else {
            echo "Error: " . $stmt->error; // Show error message
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error; // Show error in statement preparation
    }
}if (isset($_POST['vendor-name']) && isset($_POST['vendor-company']) && isset($_POST['vendor-email']) && isset($_POST['vendor-phone']) && isset($_POST['vendor-product']) && isset($_POST['vendor-website']) && isset($_POST['vendor-message'])) {
    
    // Insert data into the inquiries table
    $sql = "INSERT INTO inquiries (name, email, phone) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $name = $_POST['vendor-name'];
        $email = $_POST['vendor-email'];
        $phone = $_POST['vendor-phone'];
        
        $stmt->bind_param("sss", $name, $email, $phone);
        
        // Execute the statement
        if ($stmt->execute()) {
            $inquiry_id = $conn->insert_id;
            echo "Inquiry submitted successfully!<br>";
            header('Location: index.php');
            exit;
        } else {
            echo "Error: " . $stmt->error . "<br>";
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error; // Show error in statement preparation
    }
    
    // Insert data into the vendors table
    $sql = "INSERT INTO vendors (inquiry_id, company, product_service, website, message) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $company = $_POST['vendor-company'];
        $product_service = $_POST['vendor-product'];
        $website = $_POST['vendor-website'];
        $message = $_POST['vendor-message'];
        
        $stmt->bind_param("issss", $inquiry_id, $company, $product_service, $website, $message);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "Vendor inquiry submitted successfully!<br>";
            header('Location: index.php');
            exit;
        } else {
            echo "Error: " . $stmt->error . "<br>";
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error; // Show error in statement preparation
    }
}

// Close the database connection
$conn->close();}
?>
