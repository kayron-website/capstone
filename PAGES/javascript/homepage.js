<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "scheduler";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Count total available members
$sqlAvailable = "SELECT COUNT(DISTINCT u.user_email) AS total_available
                FROM user_form u
                LEFT JOIN table_sched s ON u.user_email = s.user_email
                WHERE s.user_email IS NULL OR s.available_status = 'available'";
$resultAvailable = mysqli_query($conn, $sqlAvailable);

if (!$resultAvailable) {
    die("Query error: " . mysqli_error($conn));
}

$rowAvailable = mysqli_fetch_assoc($resultAvailable);
$totalAvailableMembers = $rowAvailable['total_available'];

// Count total occupied members
$sqlOccupied = "SELECT COUNT(DISTINCT user_email) AS total_occupied FROM table_sched WHERE available_status = 'Occupied'";
$resultOccupied = mysqli_query($conn, $sqlOccupied);

if (!$resultOccupied) {
    die("Query error: " . mysqli_error($conn));
}

$rowOccupied = mysqli_fetch_assoc($resultOccupied);
$totalOccupiedMembers = $rowOccupied['total_occupied'];

// Javascript For My Schedules
$sql = "SELECT COUNT(*) AS ongoing FROM table_sched WHERE user_email = '$user_email' AND available_status = 'Occupied'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ongoing = $row['ongoing'];
} else {
    $ongoing = 0;
}

// Javascript For List of Calendar Schedules
$sql = "SELECT COUNT(*) AS pending FROM table_sched WHERE user_email = '$user_email' AND available_status = 'Available'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pending = $row['pending'];
} else {
    $pending = 0;
}

mysqli_close($conn);
?>