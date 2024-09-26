<?php 
    
$stmt = $conn->prepare("SELECT * FROM blogs ORDER BY post_id DESC");
$stmt->execute();
$blog_posts = $stmt->get_result();

// Check if there are rows returned
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
                if ($blog_posts->num_rows > 0) {
                while ($row = $blog_posts->fetch_assoc()) {
                    // Access columns using column names
                    $post_title = $row['post_title'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_category = $row['post_category'];
                    $post_id = $row['post_id'];
            ?>
                    <div class="d-flex mb-3">
                        <img class="img-fluid" src="img/<?php echo $post_image ?>" style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        <a href="<?php echo "blog_post.php?post_id=" . $row['post_id']; ?>" class="h5 d-flex align-items-center bg-secondary px-3 mb-0"><?php echo $post_title ?>         </a>
                    </div>
                    <?php      }
                        } else {
                            echo "No blog posts found.";
                        }
                        ?>
</body>
</html>