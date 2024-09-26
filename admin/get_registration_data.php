<?php
include("connect.php");

$query = "SELECT DATE(registration_date) as reg_date, COUNT(*) as count FROM subscribers GROUP BY DATE(registration_date)";
$result = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>
