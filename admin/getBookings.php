<?php
$servername = "localhost";
$username = "uctehpcoobirp";
$password = "zcp2%43n%]5m"; // Add your password here
$dbname = "dba3d1fkb3guv1"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT session_type, date FROM bookings";
$result = $conn->query($sql);

$bookings = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        switch ($row['session_type']) {
            case 'leadership':
                $row['session_type'] = 'Leadership Workshop';
                break;
            case 'staff training':
                $row['session_type'] = 'Staff Training';
                break;
            case 'Business Consultancy':
                $row['session_type'] = 'Business Consultancy';
                break;
            default:
                $row['session_type'] = 'Others';
                break;
        }
        $bookings[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();

header('Content-Type: application/json');
echo json_encode($bookings);
?>
