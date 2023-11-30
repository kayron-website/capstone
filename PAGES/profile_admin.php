<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scheduler";

$conn = new mysqli($servername, $username, $password, $dbname);

session_start();

if (!isset($_SESSION["user_email"])) {
    exit("User not logged in");
}

$userEmail = $_SESSION["user_email"];

$userQuery = "SELECT * FROM user_form WHERE user_email = '$userEmail'";
$result = mysqli_query($conn, $userQuery);

if (!$result) {
    exit("Database error");
}

$user = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["image"]["name"])) {
    $id = $user["id"];
    $name = $user["name"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/font_1.css">
    <link rel="stylesheet" href="css/sidebar.css">
	<link rel="stylesheet" href="css/profile.css">
	<link rel="stylesheet" href="css/notif.css">
	<link rel="stylesheet" href="css/button.css">
	<link rel="stylesheet" href="css/form_profile.css">
	<link rel="stylesheet" href="css/add_profile.css">
	<link rel="stylesheet" href="css/styles.css">
	<style>
		ul.links a[href="profile_admin.php"] li {
			background-color: rgba(140, 195, 220, 1);
			color: #000;
			border-radius: 0 35px 35px 0;
		}
	</style>
</head>
<body>
	<div class="loader">
		<div class="wrapper">
			<div class="circle"></div>
			<div class="circle"></div>
			<div class="circle"></div>
			<div class="shadow"></div>
			<div class="shadow"></div>
			<div class="shadow"></div>
		</div>
	</div>
	<div class="contain">
		<aside class="sidebar">
		  <div class="logo">
		  	<img src="img/icon.png" alt="logo">
		  </div>
		  	<ul class="links">
			  	<a href="homepage_admin.php" class="hover-effect">
					<li>
						<span class="material-symbols-outlined">
							<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 576 512">
								<path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" fill="white"/>
							</svg>
						</span><h6>Home</h6>
					</li>
				</a>
				<hr>
				<a href="profile_admin.php" class="hover-effect">
					<li>
						<span class="material-symbols-outlined">
							<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 576 512">
								<path d="M512 80c8.8 0 16 7.2 16 16V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V96c0-8.8 7.2-16 16-16H512zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM208 256a64 64 0 1 0 0-128 64 64 0 1 0 0 128zm-32 32c-44.2 0-80 35.8-80 80c0 8.8 7.2 16 16 16H304c8.8 0 16-7.2 16-16c0-44.2-35.8-80-80-80H176zM376 144c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376z"/>
							</svg>
						</span><h6>Profile</h6>
					</li>
				</a>
				<hr>
				<a href="members_admin.php" class="hover-effect">
					<li>
						<span class="material-symbols-outlined">
							<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 640 512">
								<path d="M211.2 96a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM32 256c0 17.7 14.3 32 32 32h85.6c10.1-39.4 38.6-71.5 75.8-86.6c-9.7-6-21.2-9.4-33.4-9.4H96c-35.3 0-64 28.7-64 64zm461.6 32H576c17.7 0 32-14.3 32-32c0-35.3-28.7-64-64-64H448c-11.7 0-22.7 3.1-32.1 8.6c38.1 14.8 67.4 47.3 77.7 87.4zM391.2 226.4c-6.9-1.6-14.2-2.4-21.6-2.4h-96c-8.5 0-16.7 1.1-24.5 3.1c-30.8 8.1-55.6 31.1-66.1 60.9c-3.5 10-5.5 20.8-5.5 32c0 17.7 14.3 32 32 32h224c17.7 0 32-14.3 32-32c0-11.2-1.9-22-5.5-32c-10.8-30.7-36.8-54.2-68.9-61.6zM563.2 96a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM321.6 192a80 80 0 1 0 0-160 80 80 0 1 0 0 160zM32 416c-17.7 0-32 14.3-32 32s14.3 32 32 32H608c17.7 0 32-14.3 32-32s-14.3-32-32-32H32z" fill="white"/>
							</svg>
						</span><h6>Departments</h6>
					</li>
				</a>
				<hr>
				<a href="calendar_admin.php" class="hover-effect">
					<li>
						<span class="material-symbols-outlined">
							<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 448 512">
								<path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z" fill="white"/>
							</svg>
						</span><h6>Calendar</h6>
					</li>
				</a>
				<hr>
				<a href="logout.php" class="hover-effect">
					<li>
						<span class="material-symbols-outlined">
							<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 512 512">
								<path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" fill="white"/>
							</svg>
						</span><h6>Logout</h6>
					</li>
				</a>
				<hr>
				<h4>‎ </h4>
				<a href="about_admin.php" class="hover-effect">
					<li>
						<span class="material-symbols-outlined">
							<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
								<path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" fill="white"/>
							</svg>
						</span><h6>About Us</h6>
					</li>
				</a>
		  	</ul>
		</aside>
	</div>
	<div class="contains">
		<section class="userProfile">
			<div class="background">
				<div class="notify">
					<button class="button">
						<svg viewBox="0 0 448 512" class="bell"><path d="M224 0c-17.7 0-32 14.3-32 32V49.9C119.5 61.4 64 124.2 64 200v33.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V200c0-75.8-55.5-138.6-128-150.1V32c0-17.7-14.3-32-32-32zm0 96h8c57.4 0 104 46.6 104 104v33.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V200c0-57.4 46.6-104 104-104h8zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z"></path></svg>
					</button>		
				</div>	
				<div class="profile">
					<form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
						<div class="upload">
							<?php
							$id = $user["id"];
							$name = $user["name"];
							$image = $user["image"];
							?>
							<img src="img/<?php echo $image; ?>" width="200" height="200">
							<div class="round">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="hidden" name="name" value="<?php echo $name; ?>">
							<input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png">
							<img src="icon/photo.png">
							</div>
						</div>
					</form>
					<script type="text/javascript">
					document.getElementById("image").onchange = function(){
						document.getElementById("form").submit();
					};
					</script>
					<?php
						if(isset($_FILES["image"]["name"])){
						$id = $_POST["id"];
						$name = $_POST["name"];
						
						$imageName = $_FILES["image"]["name"];
						$imageSize = $_FILES["image"]["size"];
						$tmpName = $_FILES["image"]["tmp_name"];
						
						$validImageExtension = ['jpg', 'jpeg', 'png'];
						$imageExtension = explode('.', $imageName);
						$imageExtension = strtolower(end($imageExtension));
						if (!in_array($imageExtension, $validImageExtension)){
							echo "<script>alert('Invalid Image Extension');</script>";
						}
						elseif ($imageSize > 1200000){
							echo "<script>alert('Image Size Is Too Large');</script>";
						}
						else{
							$newImageName = $name . '.' . $imageExtension;
							$query = "UPDATE user_form SET image = '$newImageName' WHERE id = $id";
							mysqli_query($conn, $query);
							move_uploaded_file($tmpName, 'img/' . $newImageName);
							echo "<script>window.location.href = 'profile_admin.php';</script>";
						}
						}
					?>
				</div>	
			</div>
			<div class="profile-container">
				<div class="profile-info">
					<div class="info-item">						
						<div class="info-label">Name:</div>		
						<div class="card_1">
							<div class="info-value_1"><?php echo $_SESSION['user_name']; ?></div>	
						</div>			
					</div>
					<div class="info-item">
						<div class="info-label">Email:</div>
						<div class="card_2">
							<div class="info-value_2"><?php echo $_SESSION['user_email']; ?></div>
						</div>
					</div>
					<div class="info-item">
						<div class="info-label">Role:</div>
						<div class="card_3">
							<div class="info-value_3"><?php echo $_SESSION['user_type']; ?></div>
						</div>
					</div>
					<div class="info-item">
						<div class="info-label">Department:</div>
						<div class="card_4">
							<div class="info-value_4">
							<?php
								// Check the department code and display the appropriate label
								$departmentCode = $_SESSION['user_department'];

								if ($departmentCode === 'DIT') {
									echo 'Department of Information Technology';
								} elseif ($departmentCode === 'DIET') {
									echo 'Department of Industrial Engineering and Technology';
								} elseif ($departmentCode === 'DCEE') {
									echo 'Department of Computer and Electronics Engineering';
								} elseif ($departmentCode === 'DCEA') {
									echo 'Department of Civil Engineering and Architecture';
								} elseif ($departmentCode === 'DAFE') {
									echo 'Department of Agricultural and Food Engineering';
								} else {
									echo $departmentCode; // Display the department code for other cases
								}
							?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="attendance">
			<div class="attendance-list">
				<table class="table">
					<thead>
						<tr>
							<th>TIME</th>
							<th>END</th>
							<th>DATE</th>
							<th>ACTIVITY</th>
							<th>LOCATION</th>
						</tr>
					</thead>
					<tbody>
					<div class="center">
						<input type="checkbox" id="show">
						<label for="show" class="button">
							<svg xmlns="http://www.w3.org/2000/svg" width="50" viewBox="0 0 20 20" height="20" fill="none" class="svg-icon">
								<g stroke-width="1.5" stroke-linecap="round" stroke="#000">
									<circle r="7.5" cy="10" cx="10"></circle>
									<path d="m9.99998 7.5v5"></path>
									<path d="m7.5 9.99998h5"></path>
								</g>
							</svg>
						</label>
						<div class="container">
							<form action="add_data_admin.php" method="post" id="myForm">
								<div class="data">
									<label>Start Time: </label>
									<input type="time" name="start_time" required>
								</div>
								<div class="data">
									<label>End Time: </label>
									<input type="time" name="end_time" required>
								</div>
								<div class="data">
									<label>Date: </label>
									<input type="date" name="date" required>
								</div>
								<div class="data">
									<label>Activity: </label>
									<input type="text" name="activity" required>
								</div>
								<div class="data">
									<label>Location: </label>
									<input type="text" name="location" required>
								</div>
								<div class="btn">
									<div class="inner"></div>
									<button class="buttons" type="submit">
										<span class="span">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 23 21" height="18" width="33" class="svg-icon">
												<path stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="black" d="M1.97742 19.7776C4.45061 17.1544 7.80838 15.5423 11.5068 15.5423C15.2053 15.5423 18.5631 17.1544 21.0362 19.7776M16.2715 6.54229C16.2715 9.17377 14.1383 11.307 11.5068 11.307C8.87535 11.307 6.74212 9.17377 6.74212 6.54229C6.74212 3.91082 8.87535 1.77759 11.5068 1.77759C14.1383 1.77759 16.2715 3.91082 16.2715 6.54229Z"></path>
											</svg>
										</span>
										<span class="lable">Add</span>
									</button>
								</div>
							</form>
						</div>
					</div>

					<?php
						date_default_timezone_set('Asia/Manila');
						$currentDateTime = date("Y-m-d H:i:s");

						$user_email = $_SESSION['user_email'];

						$sql = "SELECT start_time, end_time, date, activity, location, available_status FROM table_sched WHERE user_email = '$user_email'";
						$result = $conn->query($sql);

						
							if ($result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
									$start_time = new DateTime($row['start_time']);
									$current_time = new DateTime($currentDateTime);
									
									$schedule_date = new DateTime($row['date']);
									
									// Check if the date is in advance
									if ($schedule_date > $current_time) {
										$available_status = 'Available';
									} elseif ($current_time >= $start_time) {
										// The current time is equal to or after the start_time, mark it as "Occupied" in the database
										$available_status = 'Occupied';
										
										// The schedule is currently occupied, so you can update it in the database
										$sqlUpdate = "UPDATE table_sched SET available_status = ? WHERE start_time = ?";
										
										// Prepare and execute the update query
										$stmt = $conn->prepare($sqlUpdate);
										$stmt->bind_param("ss", $available_status, $row['start_time']);
										$stmt->execute();
										
										// Check for errors
										if ($stmt->error) {
											echo "Error updating available_status: " . $stmt->error;
										}
										
										// Don't forget to close the prepared statement after use
										$stmt->close();
									} else {
										$available_status = 'Available';
									}

									// Continue with displaying your activity information
									echo "<tr>";
									$start_time = date("h:i A", strtotime($row['start_time']));
									$end_time = date("h:i A", strtotime($row['end_time']));

									echo "<td>" . $start_time . "</td>";
									echo "<td>" . $end_time . "</td>";
									echo "<td>" . $row['date'] . "</td>";
									echo "<td>" . $row['activity'] . "</td>";
									echo "<td>" . $row['location'] . "</td>";
									echo "</tr>";
								}
							} else {
								echo "<tr><td colspan='5'>No records found</td></tr>";
							}

						$sql = "DELETE FROM table_sched WHERE date <= CURDATE() AND end_time < '$currentDateTime'";
						if ($conn->query($sql) === TRUE) {
						} else {
							echo "Error: " . $sql . "<br>" . $conn->error;
						}
						$conn->close();
					?>
					</tbody>					
				</table>
			</div>
		</section>
	</div>
	<script>
		window.addEventListener("load", () => {
			const loader = document.querySelector(".loader");

			loader.classList.add("loader--hidden");

			setTimeout(() => {
				document.body.removeChild(loader);
			}, 3000);
		});
	</script>
</body>

</html>
