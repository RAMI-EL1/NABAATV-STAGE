<?php

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
$email = $_POST['email'];
$name = $_POST['nom'];
$preferences = $_POST['preferences'];

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format.";
    exit;
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO subscribers (email, name, preferences) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $name, $preferences);

// Execute the statement
if ($stmt->execute()) {
    echo "Subscription successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>