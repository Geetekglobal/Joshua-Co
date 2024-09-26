<?php include('header.php') ?>

<!-- Contact Start -->
<div class="container-fluid bg-secondary px-0">
    <div class="row g-0">
        <div class="py-12 mx-auto contact">
            <h1 class="display-5 mb-4">Contact For Any Queries</h1>

            <?php
            // Create connection
            include('connect.php');

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Retrieve form data
                $fullName = $_POST["form-floating-1"];
                $email = $_POST["form-floating-2"];
                $phone = $_POST["form-floating-3"];
                $sessionType = ($_POST["sessionType"] === "Others") ? $_POST["other_info"] : $_POST["sessionType"];
                $date = $_POST["form-floating-4"];

                // SQL query to insert data into the database
                $sql = "INSERT INTO Bookings (full_name, email, phone, session_type, date) 
                        VALUES ('$fullName', '$email', '$phone', '$sessionType', '$date')";

                if ($conn->query($sql) === TRUE) {
                    $message = "Registration successfully";
                } else {
                    $message = "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            // Close the database connection
            $conn->close();
            ?>

            <script>
                // JavaScript to display a pop-up box with blue text
                var message = "<?php echo $message; ?>";
                if (message !== "") {
                    alert(message);
                }

                // Function to toggle visibility of text area based on session type selection
                function updateInputType() {
                    var sessionType = document.getElementById("sessionType");
                    var otherTextArea = document.getElementById("otherTextArea");

                    if (sessionType.value === "Others") {
                        otherTextArea.style.display = "block";
                        otherTextArea.setAttribute("name", "sessionType");
                        otherTextArea.setAttribute("id", "sessionType");
                        sessionType.setAttribute("name", "temp");
                        sessionType.style.display = "none";
                    } else {
                        otherTextArea.style.display = "none";
                        sessionType.setAttribute("name", "sessionType");
                        sessionType.setAttribute("id", "sessionType");
                    }
                }
            </script>

            <form id="signupForm" action="" method="post">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="form-floating-1" name="form-floating-1" placeholder="John Doe" required>
                            <label for="form-floating-1">Full Name</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="form-floating-2" name="form-floating-2" placeholder="name@example.com" required>
                            <label for="form-floating-2">Email address</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="tel" class="form-control" id="form-floating-3" name="form-floating-3" placeholder="000-0000-000" required>
                            <label for="form-floating-3">Phone</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <select class="form-control" id="sessionType" name="sessionType" onchange="updateInputType()">
                                <option value="leadership">Leadership Workshop</option>
                                <option value="consultance">Business Consultancy</option>
                                <option value="training">Staff Training</option>
                                <option value="Others">Others</option>
                            </select>
                            <label for="sessionType">Session Type</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea id="otherTextArea" class="form-control" name="other_info" style="display: none;" placeholder="Enter other session type"></textarea>
                            <label for="otherTextArea">Other Session Type</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="form-floating-4" name="form-floating-4" placeholder="dd-mm-yy">
                            <label for="form-floating-4">Date</label>
                        </div>
                    </div>
                    <div class="col-12 my-4">
                        <button class="btn btn-primary w-100 py-3" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Contact End -->

<?php include('footer.php') ?>