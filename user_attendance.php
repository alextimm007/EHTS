<?php
// connect to database access file
include("user_attendance_php.php");
include("database_connection.php");
?>

<!Doctype html>
<html>
   <head>
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
      
       <title> My first website </title>
       <link rel="stylesheet" href="view_profile+pto_request.css">
	   <link rel="stylesheet" href="user_attendance_css.css">
   </head>

<body>
		<!-- disables form submission upon page refresh -->
		<script>
			if ( window.history.replaceState ) {
			  window.history.replaceState( null, null, window.location.href );
			}
		</script>

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
	
		<!-- wrapper class holds multiple div's for CSS Grid Layout -->
		<div class="wrapper">
			<!-- combined class holds multiple div's for CSS Grid Layout within wrapper -->
			<div class="combined">	
				<!-- display employee info -->
				<div class="employee_info">
					<tr><!-- label displays employee's first and last name -->
						<td>
							<label>Employee Name:</label> 
							</br>
							<label>							
								<?php echo $fname, " ", $lname;?>
							</label>						
						</td>
					</tr>
				</div>			
				<div class="total_hours">
					<label>
						<b>
							Total Hours Worked This Week
						</b>	
					</label>
					</br>
					<label>
						<b>
							<font size="8">
								<label> <!-- display total hours worked -->
									<?php displayWeekTotalHours($conn, $user_ID, $week_number); ?>
								</label>	
							</font>
						</b>
					</label>
				</div>
				
				<!-- buttons to clock in and out -->
				<div class="in_out_buttons">				
					<form action="user_attendance.php" align="center" method="post">
						<tr>
							<label>
								<b><font size="4"><?php echo $date_time;?></font></b>
							</label>
						</tr>
						<br>
						</br>
						<h3>Clock In or Out to Track Your Time</h3>
							<tr>
								<input type="submit" class="btn clock_out" name="somebutton" value="IN/OUT"/>
								<br>
								</br>	
								<label><!-- display if you are clocked in or out -->
									<b><font size="4"><?php echo $clockStatus;?></font></b>
								</label>
							</tr>
					</form>
				</div>
			</div>	
		
			<div class="image">
				<img src="EHTS.png" style="width:700px;height:400px;">
			</div>
			
			<!-- live_clock displays live clock -->
			<div class="live_clock">
			
			<canvas id="canvas" width="400" height="390" 
				style="background-color:#FFFFFF; border:5px solid #A0A0A0;">
			</canvas>
			
				<!-- script for live analog clock -->
				<script>
					var canvas = document.getElementById("canvas");
					var ctx = canvas.getContext("2d");
					var radius = canvas.height / 2;
					ctx.translate(radius, radius);
					radius = radius * 0.90
					setInterval(drawClock, 1000);

					function drawClock() {
					  drawFace(ctx, radius);
					  drawNumbers(ctx, radius);
					  drawTime(ctx, radius);
					}

					function drawFace(ctx, radius) {
					  var grad;
					  ctx.beginPath();
					  ctx.arc(0, 0, radius, 0, 2*Math.PI);
					  ctx.fillStyle = 'white';
					  ctx.fill();
					  grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
					  grad.addColorStop(0, '#333');
					  grad.addColorStop(0.5, 'white');
					  grad.addColorStop(1, '#333');
					  ctx.strokeStyle = grad;
					  ctx.lineWidth = radius*0.1;
					  ctx.stroke();
					  ctx.beginPath();
					  ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
					  ctx.fillStyle = '#333';
					  ctx.fill();
					}

					function drawNumbers(ctx, radius) {
					  var ang;
					  var num;
					  ctx.font = radius*0.15 + "px arial";
					  ctx.textBaseline="middle";
					  ctx.textAlign="center";
					  for(num = 1; num < 13; num++){
						ang = num * Math.PI / 6;
						ctx.rotate(ang);
						ctx.translate(0, -radius*0.85);
						ctx.rotate(-ang);
						ctx.fillText(num.toString(), 0, 0);
						ctx.rotate(ang);
						ctx.translate(0, radius*0.85);
						ctx.rotate(-ang);
					  }
					}

					function drawTime(ctx, radius){
						var now = new Date();
						var hour = now.getHours();
						var minute = now.getMinutes();
						var second = now.getSeconds();
						//hour
						hour=hour%12;
						hour=(hour*Math.PI/6)+
						(minute*Math.PI/(6*60))+
						(second*Math.PI/(360*60));
						drawHand(ctx, hour, radius*0.5, radius*0.07);
						//minute
						minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
						drawHand(ctx, minute, radius*0.8, radius*0.07);
						// second
						second=(second*Math.PI/30);
						drawHand(ctx, second, radius*0.9, radius*0.02);
					}

					function drawHand(ctx, pos, length, width) {
						ctx.beginPath();
						ctx.lineWidth = width;
						ctx.lineCap = "round";
						ctx.moveTo(0,0);
						ctx.rotate(pos);
						ctx.lineTo(0, -length);
						ctx.stroke();
						ctx.rotate(-pos);
					}
				</script>
			</div>		
			
			<!-- display attendance table -->		
			<div class="attendance_table">	
				<form action="user_attendance.php" align="center" method="post">
					<tr>
						<b>
							<font size="4">
								<p align="center">
									<input type="submit" class="back" name="back" value=" << "/>	
									<label><?php echo "Monday", " ", $start_week, " ", "to", " ", "Sunday", " ", $end_week;?></label>
									<input type="submit" class="front" name="front" value=" >> "/>
								</p>
							</font>
						<b>
					</tr>
					<!-- table to display results -->
					<table>
						<tr> 
							<th>Monday</th>
							<th>Tuesday</th>
							<th>Wednesday</th>
							<th>Thursday</th>
							<th>Friday</th>
							<th>Saturday</th>
							<th>Sunday</th>
						</tr>
						<!-- get results from database-->						
						<tr>
							<th><?php monday($conn, $user_ID, $week_number); ?></th>
							<th><?php tuesday($conn, $user_ID, $week_number); ?></th>
							<th><?php wednesday($conn, $user_ID, $week_number); ?></th>
							<th><?php thursday($conn, $user_ID, $week_number); ?></th>
							<th><?php friday($conn, $user_ID, $week_number); ?></th>
							<th><?php saturday($conn, $user_ID, $week_number); ?></th>
							<th><?php sunday($conn, $user_ID, $week_number); ?></th>
						</tr>
					</table>
					
					<label>
						<center>
							Total Time For Each Day		
						</center>			
					</label>
					
					<table>
						<tr>
							<th><?php displayMonday($conn, $user_ID, $week_number);?></th>
							<th><?php displayTuesday($conn, $user_ID, $week_number);?></th>
							<th><?php displayWednesday($conn, $user_ID, $week_number);?></th>
							<th><?php displayThursday($conn, $user_ID, $week_number);?></th>
							<th><?php displayFriday($conn, $user_ID, $week_number);?></th>
							<th><?php displaySaturday($conn, $user_ID, $week_number);?></th>
							<th><?php displaySunday($conn, $user_ID, $week_number);?></th>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>   
</body>
</html>

























