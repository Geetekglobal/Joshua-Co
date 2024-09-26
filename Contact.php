<?php include ('header.php') ?>

        <!-- Contact Start -->
        <div class="container-fluid bg-secondary px-0" >
            <div class="row g-0">
                <div class="py-12 mx-auto contact">
                    <h1 class="display-5 mb-4">Contact For Any Queries</h1>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $sessionType = $_POST["sessionType"];
    $sessionDate = $_POST["sessionDate"];

    // Compose email content
    $to = "georgemoore2604@gmail.com";  // Replace with your email address
    $subject = "New Session Signup: $fullName";
    $message = " $fullName\n";
    $message .= " $email\n";
    $message .= " $phone\n";
    $message .= " $sessionType\n";
    $message .= " $sessionDate\n";

    // Set email headers
    $headers = "From: $email";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
      echo '<p style="color: green;">Form submitted successfully. Thank you!</p>';
    } else {
      echo '<p style="color: red;">Error submitting the form. Please try again later.</p>';
    }
  }
  ?>

  <form id="signupForm" action="" method="post">
    <!-- Your form fields here --><div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="form-floating-1" placeholder="John Doe" required>
                                    <label for="form-floating-1">Full Name</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="form-floating-2" placeholder="name@example.com" required>
                                    <label for="form-floating-2">Email address</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" id="form-floating-3" placeholder="000-0000-000" required>
                                    <label for="form-floating-3">phone</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-control" id="form-floating-3 sessionType" name="sessionType" required>
                                      <option value="leadership">Leadership Workshop</option>
                                      <option value="consultance">Business consultance</option>
                                      <option value="training">Staff Training</option>
                                    </select>
                                    <label for="sessionType" for="form-floating-3">Session Type:</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="form-floating-3" placeholder="dd-mm-yy">
                                    <label for="form-floating-3">Date</label>
                                </div>
                            </div>
                            <input type="email" name="_replyto" style="display: none;">
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                          
            </div>
        </div>
        <!-- Contact End -->

<?php include ('footer.php')?>