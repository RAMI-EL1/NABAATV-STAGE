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

// Get the article ID from the URL
if (isset($_GET['id'])) {
    $article_id = intval($_GET['id']);

    // Fetch the article details
    $sql = "SELECT * FROM articles WHERE id = $article_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
        // Return article details as JSON
        echo json_encode($article);
    } else {
        echo json_encode(['error' => 'Article not found']);
    }
} else {
    echo json_encode(['error' => 'No article ID provided']);
}

$conn->close();
?>
