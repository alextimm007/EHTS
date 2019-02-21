<?php
session_start();
?>
<!Doctype html>
<html>
   <head>
       <title> My first website </title>
	   
	    <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	   
       <link rel="stylesheet" href="view_profile+pto_request.css">
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
			<li><a href="user_view_profile.php">View Profile</a></li>
            <li><a href="user_attendance.php">Attendance</a></li>
            <li><a href="user_pto.php">Request Time Off</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>        
    </div>
	<h2>Request Time Off</h2>
	<!-- form to request time off -->
    <form action="user_pto_request.php" method='post'>
		<div class="table">
		<table bg="#28B463  ">
		   <!-- column headers -->
		   <tr bgcolor="#F39C12">
			  <th></th>
			  <th>Month</th>
			  <th>Day</th>
			  <th>Year</th>
			  <th>Time</th>
			  <th>AM/PM</th>      
		   </tr>
		   
			<tr align="center" bgcolor="#F4D03F">
				<th>START</th>	
				<!-- months -->	
				<td> 
					<select name ='month_start' id='month'>
					  <option value='January'>January</option>
					  <option value='February'>February</option>
					  <option value='March'>March</option>
					  <option value='April'>April</option>
					  <option value='May'>May</option>
					  <option value='June'>June</option>
					  <option value='July'>July</option>
					  <option value='August'>August</option>
					  <option value='September'>September</option>
					  <option value='October'>October</option>
					  <option value='November'>November</option>
					  <option value='December'>December</option>
					</select>
				</td>				  
				<!-- days of the week --> 
				<td>
					<select name ='day_start' id='day'>
					  <option value='Monday'>Monday</option>
					  <option value='Tuesday'>Tuesday</option>
					  <option value='Wednesday'>Wednesday</option>
					  <option value='Thursday'>Thursday</option>
					  <option value='Friday'>Friday</option>
					  <option value='Saturday'>Saturday</option>
					  <option value='Sunday'>Sunday</option>
					</select>
				</td>
				<!-- year -->			
				<td>
					<select name ='year_start' id='month'>
					  <option value='2018'>2018</option>
					  <option value='2017'>2017</option>
					  <option value='2016'>2016</option>
					  <option value='2015'>2015</option>
					  <option value='2014'>2014</option>
					  <option value='2013'>2013</option>
					  <option value='2012'>2012</option>
					  <option value='2011'>2011</option>
					  <option value='2010'>2010</option>
					  <option value='2009'>2009</option>
					  <option value='2008'>2008</option>
					  <option value='2007'>2007</option>
					</select>
				</td>
				<!-- time -->
				<td>
					<select name ='time_start' id='month'>
						  <option value='12:00'>12:00</option>
						  <option value='01:00'>01:00</option>
						  <option value='02:00'>02:00</option>
						  <option value='03:00'>03:00</option>
						  <option value='04:00'>04:00</option>
						  <option value='05:00'>05:00</option>          
						  <option value='06:00'>06:00</option>
						  <option value='07:00'>07:00</option>
						  <option value='08:00'>08:00</option>
						  <option value='09:00'>09:00</option>
						  <option value='10:00'>10:00</option>
						  <option value='11:00'>11:00</option>
					</select>
				</td>
				<!-- AM/PM -->
				<td>
					<select name ='ampm_start' id='dayddl'>
						  <option value='AM'>AM</option>
						  <option value='PM'>PM</option>
					</select>
				</td>	   
			<tr align="center">
				<td>
				</td>
			</tr>				
			<!-- column headers -->	  
			<tr bgcolor="#F39C12">
				  <th></th>
				  <th>Month</th>
				  <th>Day</th>
				  <th>Year</th>
				  <th>Time</th>
				  <th>AM/PM</th>			  
			</tr>
			<tr align="center" bgcolor="#F4D03F">
					<th>END</th>
				<!-- months -->	
				 <td>
					<select name ='month_end' id='month'>
						  <option value='January'>January</option>
						  <option value='February'>February</option>
						  <option value='March'>March</option>
						  <option value='April'>April</option>
						  <option value='May'>May</option>
						  <option value='June'>June</option>
						  <option value='July'>July</option>
						  <option value='August'>August</option>
						  <option value='September'>September</option>
						  <option value='October'>October</option>
						  <option value='November'>November</option>
						  <option value='December'>December</option>
					</select>
				</td>
				<!-- days of week -->  
				<td> 
					<select name ='day_end' id='day'>
						  <option value='Monday'>Monday</option>
						  <option value='Tuesday'>Tuesday</option>
						  <option value='Wednesday'>Wednesday</option>
						  <option value='Thursday'>Thursday</option>
						  <option value='Friday'>Friday</option>
						  <option value='Saturday'>Saturday</option>
						  <option value='Sunday'>Sunday</option>
					</select>
				</td>
				<!-- year -->  
				<td> 
					 <select name ='year_end' id='year'>
						  <option value='2018'>2018</option>
						  <option value='2017'>2017</option>
						  <option value='2016'>2016</option>
						  <option value='2015'>2015</option>
						  <option value='2014'>2014</option>
						  <option value='2013'>2013</option>
						  <option value='2012'>2012</option>
						  <option value='2011'>2011</option>
						  <option value='2010'>2010</option>
						  <option value='2009'>2009</option>
						  <option value='2008'>2008</option>
						  <option value='2007'>2007</option>
					  </select>
				</td>
				<!-- time -->  
				<td>
					<select name ='time_end' id='timee>
						  <option value='12:00'>12:00</option>
						  <option value='01:00'>01:00</option>
						  <option value='02:00'>02:00</option>
						  <option value='03:00'>03:00</option>
						  <option value='04:00'>04:00</option>
						  <option value='05:00'>05:00</option>          
						  <option value='06:00'>06:00</option>
						  <option value='07:00'>07:00</option>
						  <option value='08:00'>08:00</option>
						  <option value='09:00'>09:00</option>
						  <option value='10:00'>10:00</option>
						  <option value='11:00'>11:00</option>
					</select>
				</td>
				<!-- AM/PM -->   
				<td>
					<select name ='ampm_end' id='dayddl'>
						<option value='AM'>AM</option>
						<option value='PM'>PM</option>
					</select>
				</td>			 
			</tr>
			<!-- textarea for messege -->	
			<tr bgcolor="#28B463">
			   <td>Comment</td>
				<td>
					<textarea cols="50" rows="5" name="comments" id="usrform">
						Enter text here...
					</textarea>
					<input type="submit" name="button" value="Submit">
				</td> 
			</tr>
		</tr>            
		</table>    
		</div>
</form>
<br>
<!-- this table displays results from database -->
<div class="display_table">	
	<form action="display_table">	
		<table>		
			<tr>
				<th>ID</th>
				<th>Month Start</th>
				<th>Day Start</th>
				<th>Year Start</th>
				<th>Time Start</th>
				<th>AM/PM Start</th>
				<th>Month End</th>
				<th>Day End</th>
				<th>Year End</th>
				<th>Time End</th>
				<th>AM/PM End</th>
				<th>Notes</th>
				<th>Status</th>					
			</tr>		
					<!-- access database to get results -->
					<?php						
						$user_ID = $_SESSION["employee_id"];
						include ("database_connection.php");

						$sql = "SELECT emp_ID, month_start, day_start, year_start, time_start, ampm_start,
											 month_end, day_end, year_end, time_end, ampm_end, pto_notes, pto_status FROM pto_request WHERE emp_ID = '{$user_ID}'";
						$result = $conn-> query($sql);
						
						if($result-> num_rows > 0) {
							while ($row = $result-> fetch_assoc()) {
								echo "<tr><td>". $row["emp_ID"] ."</td><td>". $row["month_start"] ."</td><td>". $row["day_start"] ."</td>
										  <td>". $row["year_start"] ."</td><td>". $row["time_start"] ."</td><td>". $row["ampm_start"] ."</td>
										  <td>". $row["month_end"] ."</td><td>". $row["day_end"] ."</td><td>". $row["year_end"] ."</td>
										  <td>". $row["time_end"] ."</td><td>". $row["ampm_end"] ."</td><td>". $row["pto_notes"] ."</td><td>". $row["pto_status"] ."</td></tr>";
							}
							echo "</table>";
						}
						else {
							echo "0 result";
						}
						$conn-> close();
			        ?>
		</table>	
	</form>
</div>	
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>   

</body>
</html>