<?php
// Include necessary files and database connection
include('header.php');

$course_id = $_GET['course_id'];

// Fetch course details
$course = mysqli_query($conn, "SELECT * FROM courses WHERE course_id = '$course_id'");
$course_data = mysqli_fetch_assoc($course);

// Fetch all videos for the course
$videos = mysqli_query($conn, "SELECT * FROM videos WHERE course_id = '$course_id'");

echo "<h2>Course: " . $course_data['course_name'] . "</h2>";
echo "<p>" . $course_data['description'] . "</p>";

echo "<h3>Videos:</h3>";
while($video = mysqli_fetch_assoc($videos)) {
    $video_url = '../admin/' . $video['video_url'];
    echo "<div class='video-item'>";
    echo "<h4>" . $video['video_title'] . "</h4>";
    echo "<video controls>
            <source src='$video_url' type='video/mp4'>
          </video>";
    echo "</div>";
}
?>
