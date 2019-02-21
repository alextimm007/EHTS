<?php
// pass database connection and default time
include("database_connection.php");
date_default_timezone_set('America/Chicago');
?>

<?php
$week_number = date("W");
$year = date("Y"); // display current year
$start_end_date = Start_End_Date_of_a_week($week_number, $year); // print start and end date of the certain week in year
$start_week = $start_end_date[0]; // beginning of week
$end_week = $start_end_date[1]; // end of week
$user_ID = "";

if(isset($_POST["selectEmployee"])){
	// this variable is holding selected employee's ID number
	$user_ID = $_POST["selectEmployee"];	
}

// displays employee on front page
function displayEmpInfo($conn, $user_ID){
	// get first and last name for display purposes
	$sql = "SELECT emp_fname, emp_lname 
		FROM employee
		WHERE emp_ID = '{$user_ID}'";	
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>". $row["emp_fname"],"&nbsp;", $row["emp_lname"] ."</td></tr>";
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

// selectin employee from the list
function selectEmployee($conn){
	$sql = "SELECT emp_ID, emp_fname, emp_lname FROM employee"; //selection query
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$user_ID .= "<option value=".$row['emp_ID'].">" . $row['emp_ID'] ." ". $row['emp_fname'] ." ". $row['emp_lname'] ."</option>";
		}
	}
	echo $user_ID;
}

// convert to normal time from seconds
function convertToNormalTime($normalTime) {
	echo gmdate("H:i:s", $normalTime);
}

// get start and end date of certain week
function Start_End_Date_of_a_week($week_number, $year)
{
    $time = strtotime("1 January $year", time());
	$day = date('w', $time);
	$time += ((7*$week_number)-6-$day)*24*3600;
	$dates[0] = date('n-j-y', $time);
	$time += 6*24*3600;
	$dates[1] = date('n-j-Y', $time);
	return $dates;
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