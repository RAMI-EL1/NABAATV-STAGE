<?php
session_start();

$isAdmin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - All News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<style>
    html,
    body {
        height: 100%;
        margin: 0;
        overflow-x: hidden;
    }

    body {
        display: flex;
        flex-direction: column;
    }



    .container-fluid {
        padding-bottom: 0;
    }

    .carousel-item {
        height: 32rem;
        background: #777;
        color: white;
        position: relative;
        background-position: center;
        background-size: cover;
    }

    .content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding-bottom: 50px;
    }

    #mainNavbar {
        background-color: white;
        transition: background-color 0.3s ease;
    }

    #mainNavbar.sticky-top {
        background-color: rgba(255, 255, 255, 0.9);
    }

    #mainNavbar {
        box-shadow: none;
    }

    #mainNavbar.sticky-top {
        box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.3);

    }

    .custom-card {
        width: 100%;
        z-index: 10;
        position: relative;
        max-height: 310px;
        overflow: visible;
        margin: 0 auto;
    }

    .navbar-nav .nav-link,
    .navbar-nav .nav-link:focus,
    .navbar-nav .nav-link:hover,
    .search-input,
    .btn-outline-success {
        color: #ffffff;
    }


    .search-input {
        height: 35px;
        width: 200px;
    }

    .btn {
        height: 35px;
        padding: 0 15px;
        line-height: 35px;
    }

    .btn-outline-success,
    .btn-outline-danger {
        color: #ffffff;
        border-color: #ffffff;
        width: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn-danger.btn-block {
        width: 120px;
        height: 35px;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
    }

   
    footer.bg-secondary {
    background-color: #02090e; /* Slightly darker color for second footer */
    font-size: 14px;
}

footer.bg-secondary a {
    color: #ffffff; /* White color for Back to Top link */
    text-decoration: none;
}

footer .fa-arrow-up {
    margin-right: 5px; /* Adds space between the icon and Back to Top text */
}


footer.bg-secondary .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}</style>

<body>
    <div id="top"></div>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="mainNavbar">
            <div class="container-fluid justify-content-center">
                <a class="navbar-brand" href="#">
                    <img class="d-inline-block align-top" src="NABAA-TV-LOGO1.png" width="400" height="60" />
                </a>
            </div>
        </nav>

        <nav class="navbar navbar-expand-md navbar-dark" style="background-color:#c2272e;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">API NEWS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="politics.php">Politics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sports.php">Sports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="entertainement.php">Entertainment</a>
                        </li>
                    </ul>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2 search-input" type="search" placeholder="Search"
                                aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>

                            <?php if (isset($_SESSION['user_id'])): ?>
                                <a href="profile.php" class="btn btn-outline-success ms-2">Hello, <?php echo $_SESSION['user_name']; ?></a>
                                <a href="logout.php" class="btn btn-outline-danger ms-2">Logout</a>
                            <?php else: ?>
                                <a href="login.php" class="btn btn-outline-danger ms-2">Sign in</a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container my-4">
        <h1 class="text-center">All News</h1>

        <!-- Display Add Article Button for Admins -->
        <?php if ($isAdmin): ?>
            <div class="text-end mb-3">
                <a href="addArticle.html" class="btn btn-danger">Add Article</a>
            </div>
        <?php endif; ?>

        <div id="newsContainer" class="row">
        <?php
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

            $sql = "SELECT id, title, content, image_url, created_at FROM articles ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">';
                    echo '<div class="card mb-4">';
                    if (!empty($row['image_url'])) {
                        echo '<img src="' . $row['image_url'] . '" class="card-img-top" alt="Article Image">';
                    }
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['title'] . '</h5>';
                    echo '<p class="card-text">' . substr($row['content'], 0, 150) . '...</p>'; 
                    echo '<p class="card-text"><small class="text-muted">Posted on ' . date('F j, Y', strtotime($row['created_at'])) . '</small></p>';
                    echo '<a href="article.php?id=' . $row['id'] . '" class="btn btn-primary">Read More</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No articles found.</p>';
            }

            $conn->close();
        ?>
        </div>
    </div>

    <footer class="bg-dark text-white" style="padding: 2rem 0; width: 100%;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-lg custom-card">
                        <div class="card-body text-center p-3">
                            <h3 class="card-title text-danger">Contact Us</h3>
                            <form action="contact.php" method="POST">
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="email" class="form-control border-danger" id="email" name="email" placeholder="Enter your email" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control border-danger" id="name" name="name" placeholder="Enter your name">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <textarea name="message" class="form-control border-danger" id="message" placeholder="Your message"></textarea>
                                </div>
                                <button type="submit" class="btn btn-danger btn-block mt-4">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <footer class="bg-secondary text-white" style="padding: 1rem 0; width: 100%;">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <a href="#top" class="text-white" style="text-decoration: none;">
                    <i class="fa fa-arrow-up"></i> Back to Top
                </a>
            </div>
            <div class="d-flex">
                <a href="https://www.facebook.com/Nabaatvcom" class="btn-floating text-white me-3" style="font-size: 25px;">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="#" class="btn-floating text-white me-3" style="font-size: 25px;">
                    <i class="fab fa-x"></i>
                </a>
                <a href="#" class="btn-floating text-white me-3" style="font-size: 25px;">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="#" class="btn-floating text-white me-3" style="font-size: 25px;">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="#" class="btn-floating text-white" style="font-size: 25px;">
                    <i class="fab fa-threads"></i>
                </a>
            </div>
        </div>
    </footer>

</body>

</html>
