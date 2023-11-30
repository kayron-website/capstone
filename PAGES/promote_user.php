<?php
$conn = new mysqli("localhost", "root", "", "scheduler");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection already established ($conn)
    $user_email = $_POST["user_email"];

    // Update user_type to "Admin" in the database
    $update_sql = "UPDATE user_form SET user_type = 'Admin' WHERE user_email = '$user_email'";
    if ($conn->query($update_sql) === TRUE) {
        header("Location: practice.php");
        exit();
    } else {
        echo "Error promoting user: " . $conn->error;
    }
} else {
    echo "Invalid request";
}
?>
