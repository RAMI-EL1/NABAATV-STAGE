<?php
// Database connection variables
$servername = "localhost";
$username = "marouane";
$password = "";
$dbname = "news_website";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$email = isset($_POST['email']) ? $_POST['email'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format.";
    exit;
}

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO contact (email, name, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $name, $message);

// Execute the statement
if ($stmt->execute()) {
    echo "success";
} else {
    echo "Error: " . $stmt->error ;
}

// Close connections
$stmt->close();
$conn->close();
?>