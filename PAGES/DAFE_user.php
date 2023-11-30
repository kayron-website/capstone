<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "scheduler";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT uf.name, uf.user_type, uf.user_email, COALESCE(ts.available_status, 'Available') AS availability
        FROM user_form uf
        LEFT JOIN (SELECT DISTINCT user_email, available_status FROM table_sched) ts
        ON uf.user_email = ts.user_email
        WHERE uf.department = 'DAFE'";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>List of People</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
	<link rel="stylesheet" href="css/member_list.css">
</head>
<body>
	<div class="contain">
		<aside class="sidebar">
		  <div class="logo">
			<img src="img/logo.png" alt="logo">
			<h2>SCHEDULER</h2>
		  </div>
		  <ul class="links">
			<li>
			  <span class="material-symbols-outlined">home</span>
			  <a href="#">Home</a>
			</li>
			<hr>
			<li>
			  <span class="material-symbols-outlined">person</span>
			  <a href="#">Profile</a>
			</li>
			<hr>
			<li class="logout-link">
			  <span class="material-symbols-outlined">group</span>
			  <a href="#">List of Members</a>
			</li>
			<hr>
			<li class="logout-link">
			  <span class="material-symbols-outlined">edit_calendar</span>
			  <a href="#">Calendar</a>
			</li>
			<hr>
			<li class="logout-link">
			  <span class="material-symbols-outlined">logout</span>
			  <a href="#">Logout</a>
			</li>
			<hr>
			<h4>‎ </h4>
			<li class="logout-link">
			  <span class="material-symbols-outlined">info</span>
			  <a href="#">About Us</a>
			</li>
		  </ul>
		</aside>
	</div>
    
    <img class="department" src="img/DAFE.png">
    <button id="backButton">Back</button>
	<script>
	document.addEventListener("DOMContentLoaded", function() {
	  document.getElementById("backButton").addEventListener("click", function() {
		window.location.href = "members_user.php";
	  });
	});
	</script>
    <table>
		<?php
        if ($result->num_rows > 0) {
			echo "<table>
				<tr>
					<th>Name</th>
					<th>Role</th>
					<th>Email</th>
					<th>Availability</th>
				</tr>";

			// Output data from each row
			while ($row = $result->fetch_assoc()) {
				echo "<tr>
					<td>" . $row["name"] . "</td>
					<td>" . $row["user_type"] . "</td>
					<td>" . $row["user_email"] . "</td>
					<td>" . $row["availability"] . "</td>
				</tr>";
			}

			echo "</table>";
		} else {
			echo "No records found for the DAFE department";
		}

		// Close the database connection
		$conn->close();
		?>
    </table>
</body>

</html>