<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header('location: login.php');
    exit;
}

$mysqli = new mysqli("localhost", "root", "", "scheduler");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/admin_panel.css">
  <title>User Details</title>
  <script>
    function changeStatus(email, newStatus) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          // Update the button text or perform any other action if needed
          console.log(xhr.responseText);
        }
      };
      xhr.open("GET", "update_status.php?email=" + email + "&status=" + newStatus, true);
      xhr.send();
    }
  </script>
</head>
<body>
<a href="logout.php" class="logout-link">
  <button class="Btn">
    <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c-17.7 0-32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
    <div class="text">Logout</div>
  </button>
</a>
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

// Fetch user details from the database
$sql = "SELECT user_email, user_type, department, status FROM user_form";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table id='customers'>";
    echo "<tr><th>User Email</th><th>User Type</th><th>Department</th><th>Status</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["user_email"] . "</td>";
        echo "<td>" . $row["user_type"] . "</td>";
        echo "<td>" . $row["department"] . "</td>";
        // Show Active or Inactive button based on the status
        echo "<td>";
        if ($row["status"] == 0) {
            echo "<button onclick='changeStatus(\"" . $row["user_email"] . "\", \"Active\")'>Active</button>";
        } else {
            echo "<button onclick='changeStatus(\"" . $row["user_email"] . "\", \"Inactive\")'>Inactive</button>";
        }
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$specialDepartments = ['DIT', 'DIET', 'DCEE', 'DCEA', 'DAFE'];

foreach ($specialDepartments as $department) {
    $sql = "SELECT user_email, user_type, department FROM user_form WHERE user_type = 'User' AND department = '$department'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display a header for each department
        echo "<h2>$department Department</h2>";

        echo "<table id='customers'>";
        echo "<tr><th>User Email</th><th>User Type</th><th>Department</th><th>Promote</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["user_email"] . "</td>";
            echo "<td>" . $row["user_type"] . "</td>";
            echo "<td>" . $row["department"] . "</td>";

            // Add a "Promote" button for users
            echo "<td><form method='post' action='promote_user.php'>";
            echo "<input type='hidden' name='user_email' value='" . $row["user_email"] . "'>";
            echo "<input type='submit' value='Promote'></form></td>";

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No User types found for department $department";
    }
}
$conn->close();
?>
</body>
</html>
