<?php
// Database connection
$servername = "localhost";
$username = "marouane";
$password = "";
$dbname = "news_website";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get subscriber email
$email = $_GET['email'];

// Update subscriber status to unsubscribed
$sql = "UPDATE subscribers SET status='unsubscribed' WHERE email='$email'";

if ($conn->query($sql) === TRUE) {
    echo "You have successfully unsubscribed.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>