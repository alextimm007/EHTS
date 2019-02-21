<?php
// connect to database
include ("database_connection.php");
?>

<!Doctype html>
<html>
   <head>
        <title> My first website </title>
        <link rel="stylesheet" href="manager_time_off_list.css"> 
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
	
	<div class="offRequestBoxes">
		<h2>Time Off Requests</h2>
		<p>Please choose time off request by selecting a number</p>
		<!-- form to display all time off requests -->
		<form action="manager_display_pto.php" method='post'>				
					<select class="form-dropdown validate[required]" style="width:150px" id="input_43" name="display_pto">
						<!-- PHP to access database -->
						<?php						
							$sql2="SELECT pto_ID FROM pto_request ORDER BY pto_ID DESC"; //selection query
							$rs = mysqli_query($conn, $sql2);
							
							if (mysqli_num_rows($rs) > 0) {
								// output data of each row
								while($row = mysqli_fetch_assoc($rs)) {
									$menu .= "<option value=".$row['pto_ID'].">" . $row['pto_ID']. "</option>";
									}
							}
							echo $menu;		
						?>
					</select>
					<!-- select options -->
					<td>
						<select name ='pto_status' id='pto_status'>
							<option value='approved'>Approved</option>
							<option value='denied'>Denied</option>
							<option value='in progress'>In Progress</option>          
						</select>
					</td>
					<td>
						<input type="submit" name="button" value="Submit">
					</td>		
		</form>
	</div>
	
	<br>
	<!-- header of the table that displays results -->	
	<form action="manager_time_off_list.php">
		<div class="ics">
			<table>
				<tr>
					<th>Number</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>ID</th>
					<th>Month Start</th>
					<th>Day Start</th>
					<th>Year Start</th>
					<th>Time Start</th>
					<th>AM or PM Start</th>
					<th>Month End</th>
					<th>Day End</th>
					<th>Year End</th>
					<th>Time End</th>
					<th>AM or PM End</th>
					<th>Notes</th>
					<th>Status</th>
				</tr>
				<!-- get results from database -->
				<?php
					$sql = "SELECT pto_request.pto_ID, employee.emp_fname, employee.emp_lname, pto_request.emp_ID, pto_request.month_start, pto_request.day_start, 
							pto_request.year_start, pto_request.time_start, pto_request.ampm_start,
							pto_request.month_end, pto_request.day_end, pto_request.year_end, 
							pto_request.time_end, pto_request.ampm_end, pto_request.pto_notes, pto_request.pto_status 
							FROM employee
							INNER JOIN pto_request ON employee.emp_ID = pto_request.emp_ID
							ORDER BY pto_ID DESC";
					$result = $conn-> query($sql);
				
					if($result-> num_rows > 0) {
						while ($row = $result-> fetch_assoc()) {
							echo "<tr><td>". $row["pto_ID"] ."</td><td>". $row["emp_fname"] ."</td><td>". $row["emp_lname"] ."</td><td>". $row["emp_ID"] ."</td>
								  <td>". $row["month_start"] ."</td><td>". $row["day_start"] ."</td>
								  <td>". $row["year_start"] ."</td><td>". $row["time_start"] ."</td><td>". $row["ampm_start"] ."</td>
								  <td>". $row["month_end"] ."</td><td>". $row["day_end"] ."</td><td>". $row["year_end"] ."</td>
								  <td>". $row["time_end"] ."</td><td>". $row["ampm_end"] ."</td><td>". $row["pto_notes"] ."</td>
								  <td>". $row["pto_status"] ."</td></tr>";
								  }
								  echo "</table>";
								  }
								  else {
								  echo "0 result";
								  }
					$conn-> close();
				?>				
			</table>
		</div>
	</form>
	<!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>   
</body>
</html>