<?php
// Database connection settings
$servername = "localhost";
$username = "marouane";   // Your database username
$password = "";       // Your database password
$dbname = "news_website";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the email from the form
$email = $_POST['email'];

// Prepare and execute the SQL query
$sql = "SELECT * FROM subscribers WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);  // "s" indicates a string parameter
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Email exists, redirect to the news page
    header("Location: index.html");
    exit();  // Make sure to exit after redirection
} else {
    // Email does not exist, show an error or redirect to sign-up page
    echo "<script>alert('Email not found. Please sign up first.');</script>";
    echo "<script>window.location.href = 'subscription.html';</script>";
}

// Close the database connection
$conn->close();
?>
