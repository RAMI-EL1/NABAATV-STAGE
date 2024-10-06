<?php
session_start();
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


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the entered password with md5
    $hashed_password = md5($password);

    // Check if the email exists
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Debug: Check fetched email and hashed password
        echo "Fetched email: " . $user['email'];
        echo "Hashed password: " . $hashed_password;
        echo "Stored password: " . $user['password'];

        if ($hashed_password === $user['password']) {
            // Store user ID and name in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role']; 

            // Redirect based on user role
            if ($user['role'] === 'admin') {
                header("Location: admin.php"); // Replace with your admin page
            } else {
                header("Location: index.php"); // Replace with your user page
            }
            exit;
        } else {
            $error_message = "Incorrect password!";
        }
    } else {
        $error_message = "Email not found. Please sign up first.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN IN</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body text-center p-4">
                        <!-- Logo Image -->
                        <img src="NABAA-TV-LOGO1.png" alt="NABAATV" class="img-fluid mb-3" style="width: 100px;">
                        <!-- Title -->
                        <h3 class="card-title text-danger">Sign in to ur NABAATV account</h3>

                        <form action="login.php" method="POST">
                            <div class="form-group">
                            <label for="email">Email:</label>
                                <input type="email" class="form-control border-danger" id="email" name="email" placeholder="Enter your email" required> 

                                <label for="password">Password:</label>
                                <input type="password" class="form-control border-danger" id="password" name="password" placeholder="Enter Password" required>
                            </div>
                            <button type="submit" class="btn btn-danger btn-block">Sign in</button>
                            <p class="inline-text">Don't have an account</p>
                            <a href="register.php" class="btn-link">Sign up?</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
