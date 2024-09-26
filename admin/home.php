<?php
// Start the session at the very beginning of the script
session_start();

// Regenerate session ID to prevent session hijacking
session_regenerate_id(true);

// Include the database connection file
include("connect.php");

// Check if the user is not logged in, then redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user information from the database
$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM subscribers WHERE user_id = '$user_id'");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Page Header Start -->
    <div class="container-fluid bg-dark p-3">
        <div class="row">
            <div class="col d-flex justify-content-between align-items-center">        
                <img src="img/logo-white.png" alt="" width="10%">
                <div class="d-flex align-items-center justify-content-between">                        
                    <h3 class="mx-4" style="color:white; text-transform:capitalize;"> 
                        <?php echo htmlspecialchars($row['user_name']); ?>
                    </h3>
                    <a href="logout.php" class="btn btn-light mx-2">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Gallery Start -->
    <div class="container my-4 p-4">
        <div class="row g-3 mx-auto">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="blog-item">
                    <div class="position-relative overflow-hidden">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/LctYYYiOn-w?si=5_cZRVF8ofYJNdBM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="blog-item">
                    <div class="position-relative overflow-hidden">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/fiqxamuv6U0?si=Q2v4LBNBobk7QCF3" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="blog-item">
                    <div class="position-relative overflow-hidden">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/Mtjatz9r-Vc?si=qicRM8SFBeGItzbj" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="blog-item">
                    <div class="position-relative overflow-hidden">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/4e6KSaCxcHs?si=6mkWPeTGq4GJxwu-" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery End -->
</body>
</html>
