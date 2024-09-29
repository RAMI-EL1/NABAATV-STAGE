<?php
// Database connection settings
$servername = "localhost";
$username = "marouane";   // Your database username
$password = "";           // Your database password
$dbname = "news_website"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $category = $conn->real_escape_string($_POST['category']);
    
    // Handle image upload
    $image_url = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = basename($_FILES['image']['name']);
        $target_dir = "uploads/";
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_url = $target_file;
        }
    }

    // Insert article into the database
    $stmt = $conn->prepare("INSERT INTO articles (title, content, image_url, category) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $content, $image_url, $category);
    
    if ($stmt->execute()) {
        // Redirect to the main page with a success message
        header("Location: admin.php?success=1"); 
        exit();
    } else {
        echo "Error posting article: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
