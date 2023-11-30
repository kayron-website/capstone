<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header('location: index.php');
    exit;
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scheduler";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="icon-title">SCHEDULER</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
	<link href="/CAPSTONE/PAGES/css/fullcalendar.min.css" rel="stylesheet" />
	<script src="/CAPSTONE/PAGES/javascript/jquery.min.js"></script>
	<script src="/CAPSTONE/PAGES/javascript/moment.min.js"></script>
	<script src="/CAPSTONE/PAGES/javascript/fullcalendar.min.js"></script>
	<script src="/CAPSTONE/PAGES/javascript/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/sidebar.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/calendar.css">
	<script src="javascript/fetch_department_members.js"></script>
	<script>
		$(document).ready(function () {
			$('[data-dismiss="department-modal"]').click(function () {
				$(this).closest('.modal').modal('hide');
			});
		});
	</script>
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
								<path d="M512 80c8.8 0 16 7.2 16 16V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V96c0-8.8 7.2-16 16-16H512zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM208 256a64 64 0 1 0 0-128 64 64 0 1 0 0 128zm-32 32c-44.2 0-80 35.8-80 80c0 8.8 7.2 16 16 16H304c8.8 0 16-7.2 16-16c0-44.2-35.8-80-80-80H176zM376 144c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376z"  fill="white"/>
							</svg>
						</span><h6>Profile</h6>
					</li>
				</a>
				<hr>
				<a href="members_admin.php" class="hover-effect">
					<li>
						<span class="material-symbols-outlined">
							<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 640 512">
								<path d="M211.2 96a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM32 256c0 17.7 14.3 32 32 32h85.6c10.1-39.4 38.6-71.5 75.8-86.6c-9.7-6-21.2-9.4-33.4-9.4H96c-35.3 0-64 28.7-64 64zm461.6 32H576c17.7 0 32-14.3 32-32c0-35.3-28.7-64-64-64H448c-11.7 0-22.7 3.1-32.1 8.6c38.1 14.8 67.4 47.3 77.7 87.4zM391.2 226.4c-6.9-1.6-14.2-2.4-21.6-2.4h-96c-8.5 0-16.7 1.1-24.5 3.1c-30.8 8.1-55.6 31.1-66.1 60.9c-3.5 10-5.5 20.8-5.5 32c0 17.7 14.3 32 32 32h224c17.7 0 32-14.3 32-32c0-11.2-1.9-22-5.5-32c-10.8-30.7-36.8-54.2-68.9-61.6zM563.2 96a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM321.6 192a80 80 0 1 0 0-160 80 80 0 1 0 0 160zM32 416c-17.7 0-32 14.3-32 32s14.3 32 32 32H608c17.7 0 32-14.3 32-32s-14.3-32-32-32H32z"  fill="white"/>
							</svg>
						</span><h6>Departments</h6>
					</li>
				</a>
				<hr>
				<a href="calendar_admin.php" class="hover-effect">
					<li>
						<span class="material-symbols-outlined">
							<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 448 512">
								<path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z"/>
							</svg>
						</span><h6>Calendar</h6>
					</li>
				</a>
				<hr>
				<a href="logout.php" class="hover-effect">
					<li>
						<span class="material-symbols-outlined">
							<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 512 512">
								<path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"  fill="white"/>
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
								<path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"  fill="white"/>
							</svg>
						</span><h6>About Us</h6>
					</li>
				</a>
		  	</ul>
		</aside>
	</div>
	<div class="row">
		<div class="col-lg-13">
			<div id="calendar"></div>
		</div>
	</div>
	<div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalLabel">Create Event</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="img-container">
						<div class="form-group">
							<label for="event_name">Event Name</label>
							<input type="text" name="event_name" id="event_name" class="form-control" placeholder="Enter event name">
						</div>
						<div class="rows">
							<div class="col-sm-6">  
								<div class="form-group">
								  <label for="date"></label>
								  <input type="hidden" name="date" id="date" class="form-control onlydatepicker" placeholder="Event start date">
								 </div>
							</div>
							<div class="col-sm-6">  
								<div class="form-group">
								  <label for="end_date"></label>
								  <input type="hidden" name="end_date" id="end_date" class="form-control onlydatepicker" placeholder="Event end date">
								</div>
							</div>
						</div>
						<div class="rows">
							<div class="col-sm-6">  
								<div class="form-group">
								  <label for="start_time">Event Time</label>
								  <input type="time" name="start_time" id="start_time" class="form-control " placeholder="Start Time">
								 </div>
							</div>
							<div class="col-sm-6">  
								<div class="form-group">
								  <label for="end_time">End</label>
								  <input type="time" name="end_time" id="end_time" class="form-control" placeholder="End Time">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="location">Event Place</label>
							<input type="text" name="location" id="location" class="form-control" placeholder="Enter event place">
						</div>
						<div class="form-group">
							<label for="activity">Event Topic</label>
							<input type="text" name="activity" id="activity" class="form-control" placeholder="Enter event topic">
						</div>
						<?php

						// Fetch the list of members
						$members = array();
						$sql = "SELECT user_email FROM user_form";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								$members[] = $row["user_email"];
							}
						}
						?>
						<div class="col-md-10">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalDIT">DIT</button>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalDIET">DIET</button>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalDCEE">DCEE</button>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalDCEA">DCEA</button>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalDAFE">DAFE</button>
						</div>
						<div class="modal fade" id="myModalDIT" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">DIT Department List</h4>
									</div>
									<div class="modal-body">
									<label><input type="checkbox" id="selectAllDIT"> Select All</label>
										<ul>
											<?php
											$sql = "SELECT user_email FROM user_form WHERE department = 'DIT'";
											$result = $conn->query($sql);

											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													$user_email = $row["user_email"];
													echo "<input type='checkbox' class='dit-checkbox' name='user_emails[]' value='$user_email'>$user_email<br>";
												}
											}
											?>
										</ul>
									</div>
									<button type="button" class="btn btn-default" data-dismiss="department-modal">Close</button>
								</div>
							</div>
						</div>
						<div class="modal fade" id="myModalDIET" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">DIET Department List</h4>
									</div>
									<div class="modal-body">
									<label><input type="checkbox" id="selectAllDIET"> Select All</label>
										<ul>
											<?php
											$sql = "SELECT user_email FROM user_form WHERE department = 'DIET'";
											$result = $conn->query($sql);

											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													$user_email = $row["user_email"];
													echo "<input type='checkbox' class='diet-checkbox' name='user_emails[]' value='$user_email'>$user_email<br>";
												}
											}
											?>
										</ul>
									</div>
									<button type="button" class="btn btn-default" data-dismiss="department-modal">Close</button>
								</div>
							</div>
						</div>
						<div class="modal fade" id="myModalDCEE" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">DCEE Department List</h4>
									</div>
									<div class="modal-body">
									<label><input type="checkbox" id="selectAllDCEE"> Select All</label>
										<ul>
											<?php
											$sql = "SELECT user_email FROM user_form WHERE department = 'DCEE'";
											$result = $conn->query($sql);

											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													$user_email = $row["user_email"];
													echo "<input type='checkbox' class='dcee-checkbox' name='user_emails[]' value='$user_email'>$user_email<br>";
												}
											}
											?>
										</ul>
									</div>
									<button type="button" class="btn btn-default" data-dismiss="department-modal">Close</button>
								</div>
							</div>
						</div>
						<div class="modal fade" id="myModalDCEA" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">DCEA Department List</h4>
									</div>
									<div class="modal-body">
									<label><input type="checkbox" id="selectAllDCEA"> Select All</label>
										<ul>
											<?php
											$sql = "SELECT user_email FROM user_form WHERE department = 'DCEA'";
											$result = $conn->query($sql);

											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													$user_email = $row["user_email"];
													echo "<input type='checkbox' class='dcea-checkbox' name='user_emails[]' value='$user_email'>$user_email<br>";
												}
											}
											?>
										</ul>
									</div>
									<button type="button" class="btn btn-default" data-dismiss="department-modal">Close</button>
								</div>
							</div>
						</div>
						<div class="modal fade" id="myModalDAFE" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">DAFE Department List</h4>
									</div>
									<div class="modal-body">
									<label><input type="checkbox" id="selectAllDAFE"> Select All</label>
										<ul>
											<?php
											$sql = "SELECT user_email FROM user_form WHERE department = 'DAFE'";
											$result = $conn->query($sql);

											if ($result->num_rows > 0) {
												while ($row = $result->fetch_assoc()) {
													$user_email = $row["user_email"];
													echo "<input type='checkbox' class='dafe-checkbox' name='user_emails[]' value='$user_email'>$user_email<br>";
												}
											}
											?>
										</ul>
									</div>
									<button type="button" class="btn btn-default" data-dismiss="department-modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" onclick="save_event()">Save Event</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="eventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalLabel">Event Details</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<p><strong>Event Name:</strong> <span id="event_name_details"></span></p>
					<p><strong>Date:</strong> <span id="date_details"></span></p>
					<p><strong>Start Time:</strong> <span id="start_time_display"></span></p>
					<p><strong>End Time:</strong> <span id="end_time_display"></span></p>
					<p><strong>Location:</strong> <span id="location_display"></span></p>
					<p><strong>Activity:</strong> <span id="activity_display"></span></p>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
<script>
	$(document).ready(function() {
		display_events();
	});

	function display_events() {
		var events = new Array();

		$.ajax({
			url: 'display_event.php',
			dataType: 'json',
			success: function (response) {
				var result = response.data;
				$.each(result, function (i, item) {
					events.push({
						event_id: result[i].event_id,
						title: result[i].title,
						start: result[i].start,
						end: result[i].end,
						color: result[i].color,
						url: result[i].url,
						event_name: result[i].title,
                   		date: moment(result[i].start).format('YYYY-MM-DD'),
						start_time: result[i].start_time,
						end_time: result[i].end_time,
						location: result[i].location,
						activity: result[i].activity,
					});
				})

				var calendar = $('#calendar').fullCalendar({
					defaultView: 'month',
					timeZone: 'local',
					editable: true,
					selectable: true,
					selectHelper: true,
					select: function (start, end) {
						var currentDate = moment(); // Get the current date
						if (start.isBefore(currentDate) && !start.isSame(currentDate, 'day')) {
							return;
						}
						$('#date').val(moment(start).format('YYYY-MM-DD'));
						$('#end_date').val(moment(end).format('YYYY-MM-DD'));
						$('#event_entry_modal').modal('show');
					},
					events: events,
					header: {
						left: 'prev',
						center: 'title',
						right: 'next'
					},
					eventClick: function (calEvent, jsEvent, view) {
						$('#eventDetailsModal').modal('show');
						$('#event_name_details').text(calEvent.event_name);
            			$('#date_details').text(calEvent.date);
						$('#start_time_display').text(calEvent.start_time);
						$('#end_time_display').text(calEvent.end_time);
						$('#location_display').text(calEvent.location);
						$('#activity_display').text(calEvent.activity);
					},
				});
			},
			error: function (xhr, status) {
				alert(response.msg);
			}
		});
	}

	function save_event() {
		var event_name = $("#event_name").val();
		var date = $("#date").val();
		var end_date = $("#end_date").val();
		var start_time = $("#start_time").val() + ":00";
		var end_time = $("#end_time").val() + ":00";
		var location = $("#location").val();
		var activity = $("#activity").val();

		// Collect the selected user emails
		var selectedUserEmails = [];

		$(".dit-checkbox:checked").each(function() {
			selectedUserEmails.push($(this).val());
		});

		$(".diet-checkbox:checked").each(function() {
			selectedUserEmails.push($(this).val());
		});

		$(".dcee-checkbox:checked").each(function() {
			selectedUserEmails.push($(this).val());
		});

		$(".dcea-checkbox:checked").each(function() {
			selectedUserEmails.push($(this).val());
		});

		$(".dafe-checkbox:checked").each(function() {
			selectedUserEmails.push($(this).val());
		});

		// Add the selected user emails to the form data
		var formData = {
			event_name: event_name,
			date: date,
			end_date: end_date,
			start_time: start_time,
			end_time: end_time,
			location: location,
			activity: activity,
			user_emails: selectedUserEmails // Add the selected user emails here
		};

		$.ajax({
			url: "save_event.php",
			type: "POST",
			dataType: 'json',
			data: formData,
			success: function(response) {
				$('#event_entry_modal').modal('hide');
				if (response.status === true) {
					alert(response.msg);
					location.reload();
				} else {
					alert(response.msg);
				}
			},
			error: function(xhr, status) {
				console.log('ajax error = ' + xhr.statusText);
				alert(response.msg);
			}
		});
		return false;
	}

</script>
</html>
