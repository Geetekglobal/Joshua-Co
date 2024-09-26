

<div id="content" style="padding-left: 0px; margin-top: 0px;">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Video Upload</h3>
                <h4 class="animated fadeInDown">
                    Remeber to Select <span class="fa-angle-right fa"></span> The Course
                </h4>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="padding-right: 0px; padding-left: 0px;">
        <div class="panel">
            <div class="panel-heading"></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="admin_courses.php" method="POST" enctype="multipart/form-data">
                            <div class="input-group fileupload-v1">
                                <select name="course_id" required class="form-control">
                                    <option value="">Select Course</option>
                                    <?php
                                    $courses = mysqli_query($conn, "SELECT * FROM courses");
                                    while($course = mysqli_fetch_assoc($courses)) {
                                        echo "<option value='" . $course['course_id'] . "'>" . $course['course_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div><!-- /input-group -->
                            <div class="input-group fileupload-v1">
                                <input type="text" name="video_title" class="form-control fileupload-v1-path" placeholder="Video Title" required>
                            </div><!-- /input-group -->
                            <div class="input-group fileupload-v1">
                                <input type="file" name="video_url" class="fileupload-v1-file hidden" required/>
                                <input type="text" class="form-control fileupload-v1-path" placeholder="File Path..." disabled>
                                <span class="input-group-btn">
                                    <button class="btn fileupload-v1-btn" type="button"><i class="fa fa-folder"></i> Choose File</button>
                                </span>
                            </div><!-- /input-group -->
                            <button type="submit" name="upload_video" class="btn btn-primary">Upload Video</button>
                        </form>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
            </div>
        </div>

    </div>
</div>

<?php
if (isset($_POST['upload_video'])) {
    $course_id = mysqli_real_escape_string($conn, $_POST['course_id']);
    $video_title = mysqli_real_escape_string($conn, $_POST['video_title']);
    $video_url = $_FILES['video_url']['name'];
    $video_type = strtolower(pathinfo($video_url, PATHINFO_EXTENSION));

    $allowed_types = array('mp4', 'avi', 'mov', 'wmv');
    
    if (!in_array($video_type, $allowed_types)) {
        echo "<script>alert('Only video files (mp4, avi, mov, wmv) are allowed.');</script>";
    } else {
        $safe_file_name = preg_replace("/[^a-zA-Z0-9.]/", "", basename($video_url));
        $target_file = 'uploads/' . $safe_file_name;
        
        if (move_uploaded_file($_FILES['video_url']['tmp_name'], $target_file)) {
            $sql = $conn->prepare("INSERT INTO videos (course_id, video_title, video_url) VALUES (?, ?, ?)");
            $sql->bind_param("sss", $course_id, $video_title, $target_file);

            if ($sql->execute()) {
                echo "<script>alert('Video uploaded successfully.');</script>";
            } else {
                echo "Error: " . $sql->error;
            }
            $sql->close();
        } else {
            echo "Failed to upload video.";
        }
    }
}
?>

