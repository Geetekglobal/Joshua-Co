<?php
session_start();
include("connect.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

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
                    <div class="d-flex align-items-center  justify-content-between">                        
                    <h3 class="mx-4" style="color:white; text-transform:capitalize;"> <?php echo $row['user_name'];?></h3>
                    <a href="logout.php" class="btn btn-light mx-2">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

    <!-- gallery Start -->
    <div class="container my-4 p4">
        <div class="row g-3 mx-auto">
            <div class="col-lg-6 col-m-6 small-12">
                <div class="blog-item">
                    <div class="position-relative overflow-hidden">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/LctYYYiOn-w?si=5_cZRVF8ofYJNdBM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-m-6 small-12">
                <div class="blog-item">
                    <div class="position-relative overflow-hidden">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/fiqxamuv6U0?si=Q2v4LBNBobk7QCF3" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-m-6 small-12">
                <div class="blog-item">
                    <div class="position-relative overflow-hidden">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/Mtjatz9r-Vc?si=qicRM8SFBeGItzbj" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-m-6 small-12">
                <div class="blog-item">
                    <div class="position-relative overflow-hidden">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/4e6KSaCxcHs?si=6mkWPeTGq4GJxwu-" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>                </div>
            </div>
        </div>
    </div>
</body>
</html>
