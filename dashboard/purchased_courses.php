<?php
// Include necessary files and database connection
include('header.php');

// Get user ID from session (or however user data is stored)
$user_id = $_SESSION['user_id']; 

// Fetch all courses that the user has purchased
$purchased_courses = mysqli_query($conn, "SELECT * FROM purchased_courses WHERE user_id = '$user_id'");

if (!$purchased_courses) {
    // If query fails, print error message
    echo "Error: " . mysqli_error($conn);
} else {
    echo "<h2>Your Purchased Courses</h2>";

    // Check if any courses were found
    if (mysqli_num_rows($purchased_courses) > 0) {
        // Loop through the results
        while ($course = mysqli_fetch_assoc($purchased_courses)) {
            $course_id = $course['course_id'];
            $course_details = mysqli_query($conn, "SELECT * FROM purchased_courses WHERE course_id = '$course_id'");
            
            if (!$course_details) {
                // Error in fetching course details
                echo "Error fetching course details: " . mysqli_error($conn);
            } else {
                $course_data = mysqli_fetch_assoc($course_details);
                echo "<div class='course-item'>";
                echo "<h3>" . $course_data['course_name'] . "</h3>";
                echo "<p>" . $course_data['description'] . "</p>";
                echo "<button onclick='window.location.href=\"course_videos.php?course_id=$course_id\"'>View Videos</button>";
                echo "</div>";
            }
        }
    } else {
        echo "<p>You have not purchased any courses yet.</p>";
    }
}
?>
