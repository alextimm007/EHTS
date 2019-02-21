<?php
include("database_connection.php");
include("manager_attendance_php.php");
?>

<!Doctype html>
<html>
   <head>
       <title> My first website </title>
	   <link rel="stylesheet" href="manager_attendance.css">
	   <link rel="stylesheet" href="managerHeader.css">
   </head>
<body>
<header> 
	<div class="tit">
		<h1><b>Employee Hours Tracking System</b></h1>       
	</div>  
</header>
		<!-- navigation bar -->
		<div>
		   <ul class="nav">
				<li><a href="manager_create_employee.html">Create A Profile</a></li>
				<li><a href="manager_search_employee.php">Search Employee</a></li>
				<li><a href="manager_time_off_list.php">Time Off Requests</a></li>
				<li><a href="manager_attendance.php">Employee's Attendance</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>        
		</div>
	
	<div class="attendance">
		<h2>			
			Check Employee's Attendance		
		</h2>		
	</div>	
	<!-- the layout of the page is in wrapper  -->
	<div class="wrapper">		
		<div class="selectEmployee" id="selectEmployee">
			<!-- form to select employee from the drop down menu and click submit button to display results -->
			<form action="manager_attendance.php" method='post'>
				<label>					
					Select Employee From the Menu						
					<td>
						<select name ='selectEmployee' id='selectEmployee'>
							<option value='approved'></option>
							<?php selectEmployee($conn); ?>
						</select>
					</td>
					<td>
						<input type="submit" id="myButton" name="button" value="Submit" onclick="showDiv()" />
					</td>
				</label>
			</form>		
		</div>
		<!-- image with company's logo -->		
		<div class="image">
				<img src="EHTS.png" style="width:700px;height:400px;">
		</div>
		<!-- display employee first and last name -->
		<div class="combined">
			<div class="showEmployeeName">
				<form action="manager_attendance.php" align="center" method="post">
				<label>
					<?php displayEmpInfo($conn, $user_ID); ?>
				</label>
				</form>
			</div>
			<!-- display employee hours worked this week -->
			<div class="empWeekTotalHours">
				<label>This Week Worked</label>
				<?php displayWeekTotalHours($conn, $user_ID, $week_number); ?>
				<label>Hours</label>
			</div>
		</div>
		
		<!-- display employee's attendance table -->
		<div class="showTable">
			<form action="manager_attendance.php" align="center" method="post">
				<tr>
					<b>
						<font size="4">
							<p align="center">
								<label><?php echo "Monday", " ", $start_week, " ", "to", " ", "Sunday", " ", $end_week;?></label>
							</p>
						</font>
					<b>
				</tr>
			
				<table class="table1">
					<tbody>
					<tr> 
						<th>Monday</th>
						<th>Tuesday</th>
						<th>Wednesday</th>
						<th>Thursday</th>
						<th>Friday</th>
						<th>Saturday</th>
						<th>Sunday</th>
					</tr>
											
					<tr>
						<td><?php monday($conn, $user_ID, $week_number); ?></td>
						<td><?php tuesday($conn, $user_ID, $week_number); ?></td>
						<td><?php wednesday($conn, $user_ID, $week_number); ?></td>
						<td><?php thursday($conn, $user_ID, $week_number); ?></td>
						<td><?php friday($conn, $user_ID, $week_number); ?></td>
						<td><?php saturday($conn, $user_ID, $week_number); ?></td>
						<td><?php sunday($conn, $user_ID, $week_number); ?></td>
					</tr>				
				<tr>
					<td>Total For Each Day</td>		
					<td>Total For Each Day</td>
					<td>Total For Each Day</td>
					<td>Total For Each Day</td>
					<td>Total For Each Day</td>
					<td>Total For Each Day</td>
					<td>Total For Each Day</td>					
				</tr>
					<tr>
						<td><?php displayMonday($conn, $user_ID, $week_number);?></td>
						<td><?php displayTuesday($conn, $user_ID, $week_number);?></td>
						<td><?php displayWednesday($conn, $user_ID, $week_number);?></td>
						<td><?php displayThursday($conn, $user_ID, $week_number);?></td>
						<td><?php displayFriday($conn, $user_ID, $week_number);?></td>
						<td><?php displaySaturday($conn, $user_ID, $week_number);?></td>
						<td><?php displaySunday($conn, $user_ID, $week_number);?></td>
					</tr>
					</tbody>
				</table>
			</form>	
		</div>	
	</div>
	<!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>   
</body>
</html>