<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Politics News</title>
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

    footer {
        margin-top: auto;
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

    footer .col-md-6 {
        position: relative;
    }

    footer .col-md-6:nth-child(2) {
        position: absolute;
        top: 0;
        left: 70%;
        transform: translateX(-50%);
        z-index: 1;
        width: 100%;
        text-align: center;
    }

    footer .col-md-6:nth-child(2) h5 {
        color: #ce3c4a !important;
        font-size: 28px;
    }

    footer .col-md-6:nth-child(2) .d-flex {
        justify-content: center;
        gap: 20px;
    }

    footer .col-md-6:nth-child(2) .d-flex a {
        font-size: 35px;
        color: white;
    }
</style>

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
                            <a class="nav-link active" aria-current="page" href="index.html">Home</a>
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
                            <a href="signin.html" class="btn btn-outline-danger ms-2">Sign in</a>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>


    <div class="container my-4">
        <h1 class="text-center">Politics News</h1>
        <div id="newsContainer" class="row">
        <?php
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
       
       
       $category = 'politics';
       $sql = "SELECT id, title, content, image_url, created_at FROM articles WHERE category = '$category' ORDER BY created_at DESC";
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
       // Add the Read More button, passing the article ID in the URL
       echo '<a href="article.html?id=' . $row['id'] . '" class="btn btn-primary">Read More</a>';
       echo '</div>';
       echo '</div>';
       echo '</div>';
   }
} else {
   echo '<p>No articles found in the Politics category.</p>';
}

$conn->close();
?>

        </div>
    </div>       
    </div>

    <!-- Bootstrap and Custom Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
        <footer class="bg-dark text-white" style="position: relative; padding: 2rem 0; width:100% ;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-lg custom-card">
                            <div class="card-body text-center p-3">
                                <h3 class="card-title text-danger">Contact Us</h3>
                                <form action="contact.php" method="POST">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="email"></label>
                                                <input type="email" class="form-control border-danger" id="email"
                                                    name="email" placeholder="Enter your email" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="name"></label>
                                                <input type="text" class="form-control border-danger" id="name"
                                                    name="name" placeholder="Enter your name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="message"></label>
                                        <textarea name="message" class="form-control border-danger" id="message"
                                            placeholder="Your message"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-danger btn-block mt-4">Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex flex-column align-items-center"
                        style="margin-left: 150px;  margin-top:100PX ;">
                        <h5 class="text-uppercase font-weight-bold w-100 text-center"
                            style="color: #ce3c4a !important; font-size: 28px;">
                            FOLLOW US ON ALL OUR SOCIALS
                        </h5>

                        <div class="d-flex justify-content-center mt-2">
                            <p class="me-3">
                                <a href="https://www.facebook.com/Nabaatvcom" class="btn-floating btn-sm text-white"
                                    style="font-size: 35px;">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </p>
                            <p class="me-3">
                                <a href="#" class="btn-floating btn-sm text-white" style="font-size: 35px;">
                                    <i class="fab fa-x"></i>
                                </a>
                            </p>
                            <p class="me-3">
                                <a href="#" class="btn-floating btn-sm text-white" style="font-size: 35px;">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </p>
                            <p class="me-3">
                                <a href="#" class="btn-floating btn-sm text-white" style="font-size: 35px;">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </p>
                            <p>
                                <a href="#" class="btn-floating btn-sm text-white" style="font-size: 35px;">
                                    <i class="fab fa-threads"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <a href="#top" class="text-white"
                style="position: absolute; bottom: 10px; left: 10px; color: #c2272e; text-decoration: none; font-size: 16px;">
                Back to Top
            </a>
        </footer>
</body>

</html>