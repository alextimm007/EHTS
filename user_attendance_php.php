<?php
// Start the session
session_start();
?>
<?php
// file with database connection
include ("database_connection.php");
date_default_timezone_set('America/Chicago');

// variable declaration
$user_ID = $_SESSION["employee_id"]; // user ID to identify user. Global, passed from login.html
$fname = ""; // display user's first name
$lname = ""; // display user's last name
$displayDayTotal = "";
$month = date("F"); // display current month
$day_of_week = date("l"); // display current day
$year = date("Y"); // display current year
$date_time = date("l jS \of F Y"); // date for HTML "div in/out" 
$week_total_hours = ""; // total hours worked per week
$now_time = date("G:i:s a");
$week_number = date("W");
$total_time = 0;
$calculatedDayTotal = 0;
$recalculatedWeekTotalTime = 0;
$timeInOnePeriod = 0;
$displayWeekTotal = 0;
$clockStatus = "";
$start_end_date = Start_End_Date_of_a_week($week_number, $year); // print start and end date of the certain week in year
$start_week = $start_end_date[0]; // beginning of week
$end_week = $start_end_date[1]; // end of week

	// get first and last name for display purposes
	$sql = "SELECT emp_fname, emp_lname 
		FROM employee
		WHERE emp_ID = '{$user_ID}'";	
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$fname = $row['emp_fname'];
			$lname = $row['emp_lname'];
		}
	} else {}

// button to clock IN and OUT
if(isset($_POST['somebutton'])) {
	$buttonValue = inoutButton($conn, $user_ID, $day_of_week, $week_number);
	if($buttonValue == 'in'){
		$clockStatus = "You're Clocked OUT";
		$in = timeIN($conn, $day_of_week, $week_number, $user_ID); // time in DB after clocking in
		$out = convertTOseconds($now_time); // time in DB after clocking out
		$timeInOnePeriod = timeInPeriod($in, $out); // calculated difference between clocking IN and OUT
		calculateDayTime($conn, $timeInOnePeriod, $user_ID, $week_number, $day_of_week);
		clockOUT($user_ID, $conn, $now_time, $day_of_week, $week_number);		
	}
	elseif($buttonValue == 'out' || $buttonValue == NULL){
		$clockStatus = "You're Clocked IN";
		clockIN($user_ID, $conn, $now_time, $day_of_week, $week_number, $total_time);		
	}
	else {}
}

if(isset($_POST['back'])){
	$week_number = $week_number - 1;
	displayWeekTotalHours($conn, $user_ID, $week_number);
	$start_end_date = Start_End_Date_of_a_week($week_number, $year); // print start and end date of the certain week in year
	$start_week = $start_end_date[0]; // beginning of week
	$end_week = $start_end_date[1]; // end of week
}
elseif(isset($_POST['front'])){
	$week_number = $week_number + 1;
	displayWeekTotalHours($conn, $user_ID, $week_number);
	$start_end_date = Start_End_Date_of_a_week($week_number, $year); // print start and end date of the certain week in year
	$start_week = $start_end_date[0]; // beginning of week
	$end_week = $start_end_date[1]; // end of week
}
else{}

// returns last value of current day clock IN or OUT to determine if user should be clocked IN or OUT
function inoutButton($conn, $user_ID, $day_of_week, $week_number) {
	$dayofweek = strtolower($day_of_week);
	$sql = "SELECT in_out from $dayofweek WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}' ORDER BY day_ID DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			// stores value of login_ID (which is same as employee ID) of the user for further use in website 
			$inOUT = $row['in_out'];
			return $inOUT;
		}
	} else {}	
}

// displays total amount of hours worked per week on front page
function displayWeekTotalHours($conn, $user_ID, $week_number){
	$sql = "SELECT weekTotalTime FROM weeklytotal WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}' ORDER BY weekTotalTime DESC LIMIT 1";	
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {		
		echo "<table>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$displayWeekTotal = $row['weekTotalTime'];
			$displayWeekTotal = gmdate("H:i:s", $displayWeekTotal);
			echo $displayWeekTotal;
		}
		echo "</table>";
	} else {}	
}

// function to record time into database
function clockIN($user_ID, $conn, $now_time, $day_of_week, $week_number, $total_time)
{	
    $dayofweek = strtolower($day_of_week);
    $in = "in";
    // SQL statement to insert information from user's input into database 
	$sql = "INSERT INTO $day_of_week (emp_ID, in_out, timeIN_OUT, week_number, total_time) 
			VALUES ('$user_ID', '$in', '$now_time', '$week_number', '$total_time')";
	$result = $conn->query($sql);
}

// clock out and record to database
function clockOUT($user_ID, $conn, $now_time, $day_of_week, $week_number)
{  
   $dayofweek = strtolower($day_of_week);
   $out = "out";
   // SQL statement to insert information from user's input into database 
	$sql = "INSERT INTO $day_of_week (emp_ID, in_out, timeIN_OUT, week_number) 
			VALUES ('$user_ID', '$out', '$now_time', '$week_number')";
	$result = $conn->query($sql);
}

// fetch results from database of last clock in 
function timeIN($conn, $day_of_week, $week_number, $user_ID) {
	$dayofweek = strtolower($day_of_week);
	$sql = "SELECT timeIN_OUT 
			FROM $day_of_week
			WHERE in_out LIKE 'in' AND emp_ID = '{$user_ID}'
			ORDER BY timeIN_OUT DESC LIMIT 1";	
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			// stores value of clockIN 
			$timeINdb = $row["timeIN_OUT"];
			$timeINdb = convertTOseconds($timeINdb);
			return $timeINdb;
		}
	} else {
		echo "Didn't Connect";
	}
}

// converting 24 hour time in seconds 
function convertTOseconds($time_sec) {
	$time_in = $time_sec;
	sscanf($time_in, "%d:%d:%d", $hours, $minutes, $seconds);
	$time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
	return $time_seconds;
}

// convert to normal time from seconds
function convertToNormalTime($normalTime) {
	echo gmdate("H:i:s", $normalTime);
}

// calculates total time from time in to time out	
function timeInPeriod($timeINsec, $timeOUTsec) {
	$diffPunch = $timeOUTsec - $timeINsec;
	return $diffPunch;
}

// get start and end date of certain week
function Start_End_Date_of_a_week($week_number, $year){
    $time = strtotime("1 January $year", time());
	$day = date('w', $time);
	$time += ((7*$week_number)-6-$day)*24*3600;
	$dates[0] = date('n-j-y', $time);
	$time += 6*24*3600;
	$dates[1] = date('n-j-Y', $time);
	return $dates;
}	

// calculate total time for a day
function calculateDayTime($conn, $timeInOnePeriod, $user_ID, $week_number, $day_of_week) {
	$sql = "SELECT total_time FROM $day_of_week WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}' ORDER by total_time DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$totalTimeinDB = $row['total_time']; // current total time in DB
			$calculatedDayTotal = $timeInOnePeriod + $totalTimeinDB; // sum of current time in DB and new clocked time
			// updates database with new total time for a day 
			$sql2 = "UPDATE $day_of_week SET total_time = '{$calculatedDayTotal}' WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}'";// ORDER BY week_number ASC LIMIT 1";
			$result2 = $conn->query($sql2);	
			totalForWeek($conn, $timeInOnePeriod, $user_ID, $week_number);			
		}
	} else {
		echo "SQL Didn't Connect";
	}
}

// total hours worked this week
function totalForWeek($conn, $timeInOnePeriod, $user_ID, $week_number) {
	$sql4 = "INSERT INTO weeklytotal (emp_ID, week_number) VALUES ('$user_ID', '$week_number')";
	$result4 = $conn->query($sql4);
	$sql3 = "SELECT weekTotalTime FROM weeklytotal WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}' ORDER by weekTotalTime DESC LIMIT 1";
			$result3 = $conn->query($sql3);
			if ($result3->num_rows >= 0) {
				// output data of each row3
				while($row3= $result3->fetch_assoc()) {
					// stores value of clockIN 
					$weekTotalTime = $row3["weekTotalTime"];
					$recalculatedWeekTotalTime = $weekTotalTime + $timeInOnePeriod; 
					$sql4 = "UPDATE weeklytotal SET weekTotalTime = '{$recalculatedWeekTotalTime}' WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}'";
					$result4 = $conn->query($sql4);
					return $recalculatedWeekTotalTime;
				}
			} else {}
}
 
// fetch timeIN_OUT column from database to display results on Attendance page
function monday($conn, $user_ID, $week_number) {
	$sql = "SELECT in_out, timeIN_OUT, total_time FROM monday WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {		
		echo "<table>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["in_out"],"&nbsp;", $row["timeIN_OUT"] ."</td></tr>";
			$displayDayTotal = $row["total_time"];
		}
		echo "</table>";
	} else {}	
}

// fetch timeIN_OUT column from database to display results on Attendance page
function tuesday($conn, $user_ID, $week_number) {
	$sql = "SELECT in_out,  timeIN_OUT, total_time FROM tuesday WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		echo "<table>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["in_out"],"&nbsp;", $row["timeIN_OUT"] ."</td></tr>";
			$displayDayTotal = $row["total_time"];
		}
		echo "</table>";
	} else {
	}	
}

// fetch timeIN_OUT column from database to display results on Attendance page
function wednesday($conn, $user_ID, $week_number) {
	$sql = "SELECT in_out, timeIN_OUT, total_time FROM wednesday WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		echo "<table>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["in_out"],"&nbsp;", $row["timeIN_OUT"] ."</td></tr>";
			$displayDayTotal = $row["total_time"];
		}
		echo "</table>";
	} else {
	}	
}

// fetch timeIN_OUT column from database to display results on Attendance page
function thursday($conn, $user_ID, $week_number) {
	$sql = "SELECT in_out, timeIN_OUT, total_time FROM thursday WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		echo "<table>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["in_out"],"&nbsp;", $row["timeIN_OUT"] ."</td></tr>";
			$displayDayTotal = $row["total_time"];
		}
		echo "</table>";
	} else {
	}	
}

// fetch timeIN_OUT column from database to display results on Attendance page
function friday($conn, $user_ID, $week_number) {
	$sql = "SELECT in_out, timeIN_OUT, total_time FROM friday WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		echo "<table>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["in_out"],"&nbsp;", $row["timeIN_OUT"] ."</td></tr>";
			$displayDayTotal = $row["total_time"];
		}
		echo "</table>";
	} else {
	}	
}

// fetch timeIN_OUT column from database to display results on Attendance page
function saturday($conn, $user_ID, $week_number) {
	$sql = "SELECT in_out, timeIN_OUT, total_time FROM saturday WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		echo "<table>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["in_out"],"&nbsp;", $row["timeIN_OUT"] ."</td></tr>";
			$displayDayTotal = $row["total_time"];
		}
		echo "</table>";
	} else {
	}	
}

// fetch timeIN_OUT column from database to display results on Attendance page
function sunday($conn, $user_ID, $week_number) {
	$sql = "SELECT in_out, timeIN_OUT, total_time FROM sunday WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		echo "<table>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["in_out"],"&nbsp;", $row["timeIN_OUT"] ."</td></tr>";
			$displayDayTotal = $row["total_time"];
		}
		echo "</table>";
	} else {
	}	
}

// display total hours for the whole day in attendance page
function displayMonday($conn, $user_ID, $week_number) {
	$sql = "SELECT total_time FROM monday WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}'
			ORDER BY total_time DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		echo "<table>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$dayResult = $row["total_time"];
			$dayResult = convertToNormalTime($dayResult);
			echo $dayResult;
		}
		echo "</table>";
	} else {
	}		
}

// display total hours for the whole day in attendance page
function displayTuesday($conn, $user_ID, $week_number) {
	$sql = "SELECT total_time FROM tuesday WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}'
			ORDER BY total_time DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		echo "<table>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$dayResult = $row["total_time"];
			$dayResult = convertToNormalTime($dayResult);
			echo $dayResult;
		}
		echo "</table>";
	} else {
	}		
}

// display total hours for the whole day in attendance page
function displayWednesday($conn, $user_ID, $week_number) {
	$sql = "SELECT total_time FROM wednesday WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}'
			ORDER BY total_time DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		echo "<table>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$dayResult = $row["total_time"];
			$dayResult = convertToNormalTime($dayResult);
			echo $dayResult;
		}
		echo "</table>";
	} else {
	}		
}

// display total hours for the whole day in attendance page
function displayThursday($conn, $user_ID, $week_number) {
	$sql = "SELECT total_time FROM thursday WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}'
			ORDER BY total_time DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		echo "<table>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$dayResult = $row["total_time"];
			$dayResult = convertToNormalTime($dayResult);
			echo $dayResult;
		}
		echo "</table>";
	} else {
	}		
}

// display total hours for the whole day in attendance page
function displayFriday($conn, $user_ID, $week_number) {
	$sql = "SELECT total_time FROM friday WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}'
			ORDER BY total_time DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		echo "<table>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$dayResult = $row["total_time"];
			$dayResult = convertToNormalTime($dayResult);
			echo $dayResult;
		}
		echo "</table>";
	} else {
	}		
}

// display total hours for the whole day in attendance page
function displaySaturday($conn, $user_ID, $week_number) {
	$sql = "SELECT total_time FROM saturday WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}'
			ORDER BY total_time DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		echo "<table>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$dayResult = $row["total_time"];
			$dayResult = convertToNormalTime($dayResult);
			echo $dayResult;
		}
		echo "</table>";
	} else {
	}		
}

// display total hours for the whole day in attendance page
function displaySunday($conn, $user_ID, $week_number) {
	$sql = "SELECT total_time FROM sunday WHERE emp_ID = '{$user_ID}' AND week_number = '{$week_number}'
			ORDER BY total_time DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		echo "<table>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$dayResult = $row["total_time"];
			$dayResult = convertToNormalTime($dayResult);
			echo $dayResult;
		}
		echo "</table>";
	} else {
	}		
}
?>
