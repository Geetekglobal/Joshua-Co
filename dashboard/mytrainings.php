<?php
include('header.php');

// Assuming you have a user ID stored in the session after login
$user_id = $_SESSION['user_id'];

// Handle form submission for booking, cancelling, or rescheduling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action == "book") {
            // Handle booking submission
            $sessionType = $_POST["sessionType"];
            $date = $_POST["date"];

            $sql = "INSERT INTO bookings (user_id, full_name, email, session_type, date, status) 
                    VALUES ('$user_id', '$fullName', '$email', '$sessionType', '$date', 'pending')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Booking completed successfully!');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } elseif ($action == "cancel") {
            // Handle cancelling a booking
            $booking_id = $_POST['booking_id'];

            $sql = "DELETE FROM bookings WHERE id = '$booking_id'";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Booking cancelled successfully!');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } elseif ($action == "reschedule") {
            // Handle rescheduling a booking
            $booking_id = $_POST['booking_id'];
            $newDate = $_POST['newDate'];

            $sql = "UPDATE bookings SET date = '$newDate' WHERE id = '$booking_id'";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Session rescheduled successfully!');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } elseif ($action == "done") {
            // Handle marking a booking as done
            $booking_id = $_POST['booking_id'];

            $sql = "UPDATE bookings SET status = 'done' WHERE id = '$booking_id'";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Booking marked as done successfully!');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

// Fetch user data from the database
$sql_user = "SELECT user_name, user_email FROM subscribers WHERE user_id = '$user_id'";
$result_user = $conn->query($sql_user);

if ($result_user->num_rows > 0) {
    $row_user = $result_user->fetch_assoc();
    $fullName = $row_user['user_name'];
    $email = $row_user['user_email'];
} else {
    echo "User not found";
    exit();
}

// Fetch user bookings from the database, ordered by date (earliest to latest)
$sql_bookings = "SELECT id, session_type, date, status FROM bookings WHERE user_id = '$user_id' ORDER BY date ASC";
$result_bookings = $conn->query($sql_bookings);

if ($result_bookings->num_rows > 0) {
    $bookings = $result_bookings->fetch_all(MYSQLI_ASSOC);
} else {
    $bookings = [];
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .status-pending { background-color: #ffeb3b; }
        .status-done { color: #4caf50; }
        .status-cancelled { color: #f44336; }
    </style>
</head>
<body>
    <div class="container">
        <h4 class="p-2 text-end">Welcome Back <span><?php echo $fullName; ?></span></h4>

        <div class="container mx-5">
            <h2 class="mt-5">Your Bookings</h2>
            <?php if (count($bookings) > 0): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Session Type</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking): ?>
                            <tr class="<?php echo 'status-' . htmlspecialchars($booking['status']); ?>">
                                <td><?php echo htmlspecialchars($booking['session_type']); ?></td>
                                <td><?php echo htmlspecialchars($booking['date']); ?></td>
                                <td><?php echo ucfirst(htmlspecialchars($booking['status'])); ?></td>
                                <td>
                                    <form action="" method="post" id="actionForm<?php echo $booking['id']; ?>">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                        <input type="hidden" name="action" id="action<?php echo $booking['id']; ?>">
                                        <select class="form-select" onchange="handleActionChange(event, <?php echo $booking['id']; ?>)">
                                            <option value="">Select Action</option>
                                            <?php if ($booking['status'] === 'pending'): ?>
                                                <option value="reschedule">Reschedule</option>
                                                <option value="done">Mark as Done</option>
                                                <option value="cancel">Cancel</option>
                                            <?php elseif ($booking['status'] === 'done'): ?>
                                                <option value="done" disabled>Done</option>
                                            <?php else: ?>
                                                <option value="cancel" disabled>Cancelled</option>
                                            <?php endif; ?>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>You have not made any bookings yet.</p>
            <?php endif; ?>
        </div>

        <!-- Reschedule Modal -->
        <div id="rescheduleModal" class="modal fade" tabindex="-1" aria-labelledby="rescheduleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rescheduleModalLabel">Reschedule Your Session</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="rescheduleForm" action="" method="post">
                            <div class="mb-3">
                                <label for="newDate" class="form-label">New Preferred Date</label>
                                <input type="date" class="form-control" id="newDate" name="newDate" required>
                            </div>
                            <input type="hidden" id="rescheduleBookingId" name="booking_id">
                            <input type="hidden" name="action" value="reschedule">
                            <button type="submit" class="btn btn-primary">Reschedule</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php include('footer.php');?>
