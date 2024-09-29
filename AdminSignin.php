<?php
session_start(); // Start the session

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['Password'];

    // Fetch admin data from the database
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Check if the entered password matches the one in the database
        if ($password === $row['password']) {
            // Password is correct, start a session
            $_SESSION['admin_email'] = $row['email'];
            header("Location: admin.php"); // Redirect to nabaatv.html
            exit();
        } else {
            // Password is incorrect, show an alert
            echo "<script>alert('Incorrect password!');</script>";
        }
    } else {
        // No account found with that email
        echo "<script>alert('No account found with that email!');</script>";
    }
}

// Close the connection
$conn->close();
?>