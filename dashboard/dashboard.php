<?php
include('header.php'); 

// Check if the user is logged in by verifying if the user ID is set
if(!isset($_SESSION['user_id'])) {
    echo "User not logged in";
    exit();
}

// Assuming you have a user ID stored in the session after login
$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$sql = "SELECT user_name, user_email FROM subscribers WHERE user_id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the user's details
    $row = $result->fetch_assoc();
    $fullName = $row['user_name'];
    $email = $row['user_email'];
} else {
    echo "User not found";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sessionType = $_POST["sessionType"];
    
    // Check if "Others" was selected and get the custom session type
    if ($sessionType === "others") {
        $sessionType = $_POST["otherSessionType"];
    }
    
    $date = $_POST["date"];

    $sql = "INSERT INTO bookings (user_id, full_name, email, session_type, date) 
            VALUES ('$user_id', '$fullName', '$email', '$sessionType', '$date')";

    if ($conn->query($sql) === TRUE) {
        // Use JavaScript to show an alert and redirect the user
        echo "<script>
                alert('Booking completed successfully!');
                window.location.href = 'dashboard.php';
              </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

</head>
<body>
  <h4 class="container p-2 name" style="text-align:right;">Welcome Back <span><?php echo $fullName; ?></span> </h4>
  <div class="mx-5 dashboard">
        <div class="left_side">
          <p>Book a live session, get training from our team on various topics such as business consulting, staff training, leadership training, and more. Fill out the form below to get started:</p>
          <div class="form-container">
          <form id="signupForm" action="" method="post">
                <h2>Book a Live Session</h2>
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $fullName; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="sessionType">Preferred Session</label>
                    <select class="form-control" id="sessionType" name="sessionType" required>
                        <option value="leadership">Leadership Workshop</option>
                        <option value="consultance">Business Consultancy</option>
                        <option value="training">Staff Training</option>
                        <option value="others">Others</option>
                    </select>
                </div>
                <div class="form-group" id="otherSessionTypeContainer" style="display: none;">
                    <label for="otherSessionType">Specify Your Session</label>
                    <input type="text" class="form-control" id="otherSessionType" name="otherSessionType">
                </div>
                <div class="form-group">
                    <label for="date">Preferred Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <button type="submit" class="btn-submit">Submit</button>
            </form>
          </div>
        </div>
        <div class="right-side d-flex flex-column">
          <div class="sidebox">
            <h4>Get A Lifetime Recording of Our Trainings</h4>
            <p>This option is available for subscribers who can't book a live session or are too busy to attend one.</p>
            <a href="#" class="btn-submit">See More</a>
          </div>
          <div class="sidebox">
            <h4>View Your Booked Sessions</h4>
            <p>See the sessions you have booked. If you don't have any, feel free to book one now.</p>            
            <a href="mytrainings.php" class="btn-submit">Check Status</a>
          </div>
          <div class="sidebox">
            <h4>Check Recorded Training</h4>
            <p>Check for newly added video training and select the one that suits your needs, or just book a live session.</p>
            <a href="#" class="btn-submit">Check Status</a>
          </div>
        </div>
    </div>


    <?php include('footer.php');?>
