<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scheduler";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get parameters from the GET request
$email = $_GET['email'];
$newStatus = $_GET['status'];

// Update the status in the database
$sql = "UPDATE user_form SET status = " . ($newStatus == 'Active' ? 1 : 0) . " WHERE user_email = '$email'";
$result = $conn->query($sql);

if ($result) {
    echo "Status updated successfully";
} else {
    echo "Error updating status: " . $conn->error;
}

$conn->close();
?>
