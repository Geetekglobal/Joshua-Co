<?php include('header.php'); ?>

<div id="content">
                

                <div class="col-md-12" style="padding:20px;">
                    <div class="col-md-12 padding-0">
                        <div class="col-md-8 padding-0">
                            <div class="col-md-12">
                                <div class="panel box-v4">
                                      <div class="panel-body padding-0">
                                        <div class="col-md-12 col-xs-12 col-md-12 padding-0 box-v4-alert">
                                            <h4>Manage Courses</h4>                                            
                                        </div>

                                        <div class="panel-body ">
                                            <form action="admin_courses.php" method="POST" class="shadow p-4 rounded bg-light"> 
                                                <div class="form-group mb-3">
                                                    <label for="courseName" class="form-label">Course Name</label>
                                                    <input type="text" id="courseName" name="course_name" class="form-control mx-auto"  placeholder="Course Name" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="description" class="form-label">Course Description</label>
                                                    <textarea id="description" name="description" class="form-control mx-auto"  placeholder="Course Description"></textarea>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="price" class="form-label">Price</label>
                                                    <input type="text" id="price" name="price" class="form-control mx-auto"  placeholder="Price" required>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" name="add_course" class="btn btn-primary">Add Course</button>
                                                </div>
                                            </form>
                                            <hr/>
                                        </div>                                    </div>
                                </div> 
                            </div>
                            <?php include('admin_videos.php'); ?>  

                        </div>
                        <div class="col-md-4">
                            <div class="col-md-12 padding-0">
                              <div class="panel box-v3">
                                <div class="panel-heading bg-white border-none">
                                  <h4>This Weeks Bookings</h4>
                                  <?php include('summery.php'); ?>
                                </div>
                            </div>

                        </div>
                    </div>


                
                </div>
      		  </div>

        <?php
        if(isset($_POST['add_course'])) {
            $course_name = $_POST['course_name'];
            $description = $_POST['description'];
            $price = $_POST['price'];

            $sql = "INSERT INTO courses (course_name, description, price) VALUES ('$course_name', '$description', '$price')";
            if(mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success mt-4'>Course added successfully.</div>";
            } else {
                echo "<div class='alert alert-danger mt-4'>Error: " . mysqli_error($conn) . "</div>";
            }
        }
        ?>


<?php include('footer.php'); ?>
