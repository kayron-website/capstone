<?php                
require 'database_connection.php'; // Assuming you include your database connection here

$event_name = $_POST['event_name'];
$date = date("Y-m-d", strtotime($_POST['date']));
$end_date = date("Y-m-d", strtotime($_POST['end_date']));
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$location = $_POST['location'];
$activity = $_POST['activity'];

// Assuming you have an array of selected user emails from the checkboxes
$user_emails = $_POST['user_emails'];

// Insert the event into the calendar_page table
$insert_query_calendar = "INSERT INTO `calendar_page` (`event_name`, `date`, `end_date`, `start_time`, `end_time`, `location`, `activity`)
VALUES ('$event_name', '$date', '$end_date', '$start_time', '$end_time', '$location', '$activity')";

if (mysqli_query($con, $insert_query_calendar)) {
    $data = array(
        'status' => true,
        'msg' => 'Event added successfully!'
    );
} else {
    $data = array(
        'status' => false,
        'msg' => 'Error adding event to calendar_page: ' . mysqli_error($con)
    );
}

// Insert the event for each selected user in the table_sched table
foreach ($user_emails as $user_email) {
    $insert_query_user = "INSERT INTO `table_sched` (`user_email`, `date`, `start_time`, `end_time`, `location`, `activity`)
    VALUES ('$user_email', '$date', '$start_time', '$end_time', '$location', '$activity')";

    if (mysqli_query($con, $insert_query_user)) {
        // Event added successfully for this user
    } else {
        $data = array(
            'status' => false,
            'msg' => 'Error adding event to table_sched: ' . mysqli_error($con)
        );
    }
}

echo json_encode($data);
?>
