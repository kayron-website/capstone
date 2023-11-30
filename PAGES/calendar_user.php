<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header('location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEIT SCHEDULER</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/sidebar.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/calendar.css">
	<style>
		ul.links a[href="calendar_user.php"] li {
			background-color: rgba(140, 195, 220, 1);
			color: #000;
			border-radius: 0 35px 35px 0;
		}
	</style>
</head>
<body>
	<div class="contain">
		<aside class="sidebar">
			<div class="logo">
				<img src="img/icon.png" alt="logo">
			</div>
			<ul class="links">
			  	<a href="homepage_user.php" class="hover-effect">
					<li>
						<span class="material-symbols-outlined">
							<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 576 512">
								<path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" fill="white"/>
							</svg>
						</span><h6>Home</h6>
					</li>
				</a>
				<hr>
				<a href="profile_user.php" class="hover-effect">
					<li>
						<span class="material-symbols-outlined">
							<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 576 512">
								<path d="M512 80c8.8 0 16 7.2 16 16V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V96c0-8.8 7.2-16 16-16H512zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM208 256a64 64 0 1 0 0-128 64 64 0 1 0 0 128zm-32 32c-44.2 0-80 35.8-80 80c0 8.8 7.2 16 16 16H304c8.8 0 16-7.2 16-16c0-44.2-35.8-80-80-80H176zM376 144c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376z" fill="white"/>
							</svg>
						</span><h6>Profile</h6>
					</li>
				</a>
				<hr>
				<a href="members_user.php" class="hover-effect">
					<li>
						<span class="material-symbols-outlined">
							<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 640 512">
								<path d="M211.2 96a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM32 256c0 17.7 14.3 32 32 32h85.6c10.1-39.4 38.6-71.5 75.8-86.6c-9.7-6-21.2-9.4-33.4-9.4H96c-35.3 0-64 28.7-64 64zm461.6 32H576c17.7 0 32-14.3 32-32c0-35.3-28.7-64-64-64H448c-11.7 0-22.7 3.1-32.1 8.6c38.1 14.8 67.4 47.3 77.7 87.4zM391.2 226.4c-6.9-1.6-14.2-2.4-21.6-2.4h-96c-8.5 0-16.7 1.1-24.5 3.1c-30.8 8.1-55.6 31.1-66.1 60.9c-3.5 10-5.5 20.8-5.5 32c0 17.7 14.3 32 32 32h224c17.7 0 32-14.3 32-32c0-11.2-1.9-22-5.5-32c-10.8-30.7-36.8-54.2-68.9-61.6zM563.2 96a64 64 0 1 0 -128 0 64 64 0 1 0 128 0zM321.6 192a80 80 0 1 0 0-160 80 80 0 1 0 0 160zM32 416c-17.7 0-32 14.3-32 32s14.3 32 32 32H608c17.7 0 32-14.3 32-32s-14.3-32-32-32H32z" fill="white"/>
							</svg>
						</span><h6>List of Members</h6>
					</li>
				</a>
				<hr>
				<a href="calendar_user.php" class="hover-effect">
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
								<path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" fill="white"/>
							</svg>
						</span><h6>Logout</h6>
					</li>
				</a>
				<hr>
				<h4>‎ </h4>
				<a href="about_user.php" class="hover-effect">
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
	<div class="row">
		<div class="col-lg-12">
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
							<label for="event_time">Event Name</label>
							<input type="text" name="event_name" id="event_name" class="form-control" placeholder="Enter event name">
						</div>
						<div class="rows">
							<div class="col-sm-6">  
								<div class="form-group">
								  <label for="event_start_date">Event start</label>
								  <input type="date" name="event_start_date" id="event_start_date" class="form-control onlydatepicker" placeholder="Event start date">
								 </div>
							</div>
							<div class="col-sm-6">  
								<div class="form-group">
								  <label for="event_end_date">Event end</label>
								  <input type="date" name="event_end_date" id="event_end_date" class="form-control" placeholder="Event end date">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="event_time">Event Time</label>
							<input type="time" name="event_time" id="event_time" class="form-control" placeholder="Enter event time">
						</div>
						<div class="form-group">
							<label for="event_place">Event Place</label>
							<input type="text" name="event_place" id="event_place" class="form-control" placeholder="Enter event place">
						</div>
						<div class="form-group">
							<label for="event_topic">Event Topic</label>
							<input type="text" name="event_topic" id="event_topic" class="form-control" placeholder="Enter event topic">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" onclick="save_event()">Save Event</button>
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
			 
		var result=response.data;
		$.each(result, function (i, item) {
			events.push({
				event_id: result[i].event_id,
				title: result[i].title,
				start: result[i].start,
				end: result[i].end,
				color: result[i].color,
				url: result[i].url
			}); 	
		})
		var calendar = $('#calendar').fullCalendar({
			defaultView: 'month',
			 timeZone: 'local',
			editable: false,
			selectable: false,
			selectHelper: false,
			events: events,
			header: {
						left: 'prev',
						center: 'title',
						right: 'next'
					},
			eventRender: function(event, element, view) { 

			}
			});
		  },
		  error: function (xhr, status) {
		  alert(response.msg);
		  }
		});
	}
</script>
</html>