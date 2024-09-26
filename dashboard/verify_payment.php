<?php
// Include database connection
include('header.php');

// Get the payment reference and course ID from the URL
$reference = $_GET['reference'];
$course_id = $_GET['course_id'];

// Verify payment via Paystack API
$paystack_secret_key = 'sk_test_c7f0dced6c0f01df7f7dddbbd47356e8b8e64f03'; // Replace with your Paystack secret key
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer " . $paystack_secret_key,
        "Cache-Control: no-cache"
    ),
));

$response = curl_exec($curl);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if ($http_code !== 200) {
    // Handle failure to contact Paystack server
    die("Failed to connect to Paystack. Please try again later.");
}

$paystack_response = json_decode($response, true);

// Check if the payment was successful
if ($paystack_response['data']['status'] === 'success') {
    // Payment was successful, grant access to the course

    // Example: Insert payment details into the 'payments' table
    $user_id = $_SESSION['user_id']; // Assuming you're using sessions to track the logged-in user
    $amount_paid = $paystack_response['data']['amount'] / 100; // Convert amount from kobo to naira
    $transaction_id = $paystack_response['data']['id'];

    // Save payment details in the database
    $insert_payment = mysqli_query($conn, "INSERT INTO purchased_courses  (user_id, course_id, amount_paid, transaction_id) 
                                           VALUES ('$user_id', '$course_id', '$amount_paid', '$transaction_id')");
    
    if ($insert_payment) {
        // Redirect to a success page where users can access their course
        header("Location: access_course.php?course_id=" . $course_id);
    } else {
        // Handle database insertion failure
        die("Failed to record payment. Please contact support.");
    }
} else {
    // Payment failed
    die("Payment verification failed. Please try again.");
}

curl_close($curl);
?>
