<?php include ('header.php') ?>
<div id="content" style="padding-left: 0px; margin-top: 0px;" class="mx-4">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft mt-4">Available Videos</h3>
            </div>
        </div>
    </div>

    <div class="col-md-12" style="padding-right: 0px; padding-left: 0px;">
        <div class="panel">
            <div class="panel-heading"></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="video-grid">
                            <?php
                            // Fetch courses from the database
                            $courses = mysqli_query($conn, "SELECT * FROM courses");

                            // Loop through each course
                            while($course = mysqli_fetch_assoc($courses)) {
                                $course_id = $course['course_id'];
                                $course_name = $course['course_name'];
                                $course_description = $course['description'];
                                $course_price = $course['price'];

                                // Fetch the first video for the current course
                                $video = mysqli_query($conn, "SELECT * FROM videos WHERE course_id = '$course_id' LIMIT 1");
                                $video_data = mysqli_fetch_assoc($video);

                                if ($video_data) {
                                    $video_file_path = '../admin/' . $video_data['video_url'];

                                    // Check if the file exists before displaying it
                                    if (file_exists($video_file_path)) {
                                        echo "<div class='video-item'>";
                                        echo "<video class='course-video' data-course-id='$course_id' >
                                                <source src='" . $video_file_path . "' type='video/mp4'>
                                                Your browser does not support the video tag.
                                              </video>";
                                        echo "<h3 class='course-title'>" . $course_name . "</h3>";
                                        echo "<p class='course-description'>" . $course_description . "</p>";
                                        echo "<h2 class='course-price'>Price: $" . $course_price . "</h2>";
                                        echo "<a href='course_details.php?course_id=" . $course['course_id'] . "' class='btn btn-primary view-button' data-course-id='$course_id'>View Course</a>";
                                        echo "</div>";
                                    } else {
                                        echo "<p>Video file not found: " . $video_file_path . "</p>";
                                    }
                                } else {
                                    echo "<p>No videos available for this course.</p>";
                                }
                            }
                            ?>
                        </div><!-- /.video-grid -->
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
            </div>
        </div>
    </div>
</div>

<?php include ('footer.php') ?>