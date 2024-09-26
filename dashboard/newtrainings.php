<?php
include('header.php');

// Fetch recorded classes from the database
$sql = "SELECT id, class_name, description, price FROM recorded_classes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $classes = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $classes = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['class_id'])) {
    // Handle purchase logic here, e.g., insert order into the database
    $class_id = $_POST['class_id'];

    // Fetch the class details
    $sql_class = "SELECT class_name, s3_url FROM recorded_classes WHERE id = '$class_id'";
    $result_class = $conn->query($sql_class);

    if ($result_class->num_rows > 0) {
        $class = $result_class->fetch_assoc();
        $class_name = $class['class_name'];
        $s3_url = $class['s3_url'];

        // Insert purchase record (this assumes a 'purchases' table exists)
        $user_id = $_SESSION['user_id'];
        $sql_purchase = "INSERT INTO purchases (user_id, class_id) VALUES ('$user_id', '$class_id')";

        if ($conn->query($sql_purchase) === TRUE) {
            echo "<script>alert('Purchase successful! You can now access $class_name');</script>";
            // Redirect to the S3 URL or provide a download link
            echo "<script>window.location.href='$s3_url';</script>";
        } else {
            echo "Error: " . $sql_purchase . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>

</head>
<body>
    <h4 class="container p-2 name" style="text-align:right;">Welcome Back <span><?php echo htmlspecialchars($_SESSION['user_name']); ?></span></h4>
    
    <div class="container mx-5 dashboard">
        <h2>Purchase Recorded Classes</h2>
        <?php if (count($classes) > 0): ?>
            <div class="classes-list">
                <?php foreach ($classes as $class): ?>
                    <div class="class-item">
                        <h4><?php echo htmlspecialchars($class['class_name']); ?></h4>
                        <p><?php echo htmlspecialchars($class['description']); ?></p>
                        <p><strong>Price:</strong> $<?php echo htmlspecialchars($class['price']); ?></p>
                        <form action="" method="post">
                            <input type="hidden" name="class_id" value="<?php echo $class['id']; ?>">
                            <button type="submit" class="btn btn-primary">Purchase</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No recorded classes available at the moment.</p>
        <?php endif; ?>
    </div>
</body>
</html>
