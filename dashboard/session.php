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
                $sessionType = ($_POST["sessionType"] === "Others") ? $_POST["Other_Session"] : $_POST["sessionType"];
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
                            <select class="form-control" id="options" name="sessionType">
                                <option value="leadership">     Leadership Workshop         </option>
                                <option value="consultance">    Business Consultancy        </option>
                                <option value="training">       Staff Training              </option>
                                <option value="Others">         Others                      </option>
                            </select>
                            <label for="sessionType">Session Type</label>
                        </div>
                    </div>
                    <div class="col-12" id="otherOptionInput" style="display: none;">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="form-floating-5" name="Other_Session" placeholder="please state Your Session Type">
                            <label for="form-floating-2">Other Session</label>
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

<script >
    document.addEventListener('DOMContentLoaded', function() {
  const optionsSelect = document.getElementById('options');
  const otherOptionInput = document.getElementById('otherOptionInput');

  optionsSelect.addEventListener('change', function() {
    if (optionsSelect.value === 'Others') {
      otherOptionInput.style.display = 'block';
    } else {
      otherOptionInput.style.display = 'none';
    }
  });

  document.getElementById('optionsForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting
    // You can perform any further actions here, like submitting the form data via AJAX
    // For demonstration, let's log the form data to the console
    const formData = new FormData(this);
    for (const pair of formData.entries()) {
      console.log(pair[0] + ': ' + pair[1]);
    }
  });
});

</script>
<?php include('footer.php') ?>