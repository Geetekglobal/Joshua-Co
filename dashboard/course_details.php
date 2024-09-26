<?php
// Include necessary files and database connection
include('header.php');

$course_id = $_GET['course_id'];

// Fetch course details
$course = mysqli_query($conn, "SELECT * FROM courses WHERE course_id = '$course_id'");
$course_data = mysqli_fetch_assoc($course);
$course_name = $course_data['course_name'];
$course_description = $course_data['description'];
$course_price = $course_data['price']; // Price in dollars

// Fetch all videos for the course
$videos = mysqli_query($conn, "SELECT * FROM videos WHERE course_id = '$course_id'");
$first_video = mysqli_fetch_assoc($videos);
$video_file_path = '../admin/' . $first_video['video_url'];

// Check if the first video file exists
if (file_exists($video_file_path)) {
    echo "<div class='course-wrapper'>";
    
    // Left section: video preview
    echo "<div class='video-preview'>";
    echo "<h4>Preview of First Video</h4>";
    echo "<video class='preview-video' data-course-id='$course_id' autoplay muted>
            <source src='$video_file_path' type='video/mp4'>
            Your browser does not support the video tag.
          </video>";
    echo "</div>";

    // Right section: course details and buy button
    echo "<div class='course-details'>";
    echo "<h3>Course: $course_name</h3>";
    echo "<p>$course_description</p>";
    echo "<h2>Price: $$course_price</h2>";
    
    // Buy Now button with Paystack integration
    echo "<button class='btn btn-primary pay-button' data-course-id='$course_id' data-price='$course_price'>Buy Now</button>";
    echo "</div>";

    echo "</div>"; // End of course-wrapper
} else {
    echo "<p>Video file not found: " . $video_file_path . "</p>";
}

// Display all other videos in a list
echo "<h4>All Videos</h4>";
while($video = mysqli_fetch_assoc($videos)) {
    $video_path = '../admin/' . $video['video_url'];
    echo "<div class='video_list'>";
    echo "<div class='video-item' style='width:10%;'>";
    echo "<p>Video: " . $video['video_title'] . "</p>";
    echo "<video class='course-video'>
            <source src='$video_path' type='video/mp4'>
          </video>";
    echo "</div>";
    echo "</div";
}
?>

<!-- Add responsive styling for layout -->


<!-- Paystack Integration -->
<script src="https://js.paystack.co/v1/inline.js"></script>
<script src="js/paystack.js"></script>


<!-- Limit first video playback to 30 seconds -->
<script src="js/playback.js"></script><script>
        callback: function(response) {
    // Redirect to a PHP page for verification
    window.location.href = "verify_payment.php?reference=" + response.reference + "&course_id=" + courseId;
}
</script>