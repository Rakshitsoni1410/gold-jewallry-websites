<?php

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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Careers Form Data
    $careerName = filter_input(INPUT_POST, 'career-name', FILTER_SANITIZE_STRING);
    $careerEmail = filter_input(INPUT_POST, 'career-email', FILTER_VALIDATE_EMAIL);
    $careerPhone = filter_input(INPUT_POST, 'career-phone', FILTER_SANITIZE_STRING);
    $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING);
    $coverLetter = filter_input(INPUT_POST, 'cover-letter', FILTER_SANITIZE_STRING);
    $portfolio = filter_input(INPUT_POST, 'portfolio', FILTER_VALIDATE_URL);

    // Collaboration Form Data
    $collabName = filter_input(INPUT_POST, 'collab-name', FILTER_SANITIZE_STRING);
    $company = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING);
    $collabEmail = filter_input(INPUT_POST, 'collab-email', FILTER_VALIDATE_EMAIL);
    $collabPhone = filter_input(INPUT_POST, 'collab-phone', FILTER_SANITIZE_STRING);
    $collabType = filter_input(INPUT_POST, 'collab-type', FILTER_SANITIZE_STRING);
    $collabWebsite = filter_input(INPUT_POST, 'collab-website', FILTER_VALIDATE_URL);
    $collabMessage = filter_input(INPUT_POST, 'collab-message', FILTER_SANITIZE_STRING);

    // Vendor Form Data
    $vendorName = filter_input(INPUT_POST, 'vendor-name', FILTER_SANITIZE_STRING);
    $vendorCompany = filter_input(INPUT_POST, 'vendor-company', FILTER_SANITIZE_STRING);
    $vendorEmail = filter_input(INPUT_POST, 'vendor-email', FILTER_VALIDATE_EMAIL);
    $vendorPhone = filter_input(INPUT_POST, 'vendor-phone', FILTER_SANITIZE_STRING);
    $vendorProduct = filter_input(INPUT_POST, 'vendor-product', FILTER_SANITIZE_STRING);
    $vendorWebsite = filter_input(INPUT_POST, 'vendor-website', FILTER_VALIDATE_URL);
    $vendorMessage = filter_input(INPUT_POST, 'vendor-message', FILTER_SANITIZE_STRING);

    // Define the recipient email address
    $to = "your-email@example.com"; // Replace with your email address

    // Determine which form was submitted
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $emailSubject = "New General Inquiry from $name";
        $emailBody = "Name: $name\nEmail: $email\nPhone: $phone\nSubject: $subject\nMessage:\n$message";
    } elseif (!empty($careerName) && !empty($careerEmail) && !empty($position) && !empty($coverLetter)) {
        $emailSubject = "New Career Application from $careerName";
        $emailBody = "Name: $careerName\nEmail: $careerEmail\nPhone: $careerPhone\nPosition Interested In: $position\nCover Letter:\n$coverLetter\nLinkedIn/Portfolio: $portfolio";
        
        // Handle file upload (Resume)
        if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
            $fileTmpPath = $_FILES['resume']['tmp_name'];
            $fileName = $_FILES['resume']['name'];
            $fileSize = $_FILES['resume']['size'];
            $fileType = $_FILES['resume']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $allowedfileExtensions = array('pdf', 'doc', 'docx');

            if (in_array($fileExtension, $allowedfileExtensions)) {
                $uploadFileDir = './uploads/';
                $dest_path = $uploadFileDir . $fileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $emailBody .= "\nResume: $dest_path";
                } else {
                    echo "There was an error moving the uploaded file.";
                    exit;
                }
            } else {
                echo "Invalid file type. Only PDF, DOC, and DOCX are allowed.";
                exit;
            }
        }
    } elseif (!empty($collabName) && !empty($collabEmail) && !empty($company) && !empty($collabType)) {
        $emailSubject = "New Collaboration Inquiry from $collabName";
        $emailBody = "Name: $collabName\nCompany: $company\nEmail: $collabEmail\nPhone: $collabPhone\nType of Collaboration: $collabType\nWebsite: $collabWebsite\nMessage:\n$collabMessage";
    } elseif (!empty($vendorName) && !empty($vendorEmail) && !empty($vendorCompany) && !empty($vendorProduct)) {
        $emailSubject = "New Vendor Inquiry from $vendorName";
        $emailBody = "Name: $vendorName\nCompany: $vendorCompany\nEmail: $vendorEmail\nPhone: $vendorPhone\nType of Product/Service: $vendorProduct\nWebsite: $vendorWebsite\nMessage:\n$vendorMessage";
    } else {
        echo "Required fields are missing.";
        exit;
    }

    // Email headers
    $headers = "From: $email";

    // Send email
    if (mail($to, $emailSubject, $emailBody, $headers)) {
        echo "Your message has been sent successfully!";
    } else {
        echo "There was an error sending your message. Please try again later.";
    }
} else {
    echo "Invalid request method.";
}
?>
