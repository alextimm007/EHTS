<?php
// Start the session
session_start();
?>

<?php
// variable declaration
$user_ID = $_SESSION["employee_id"];
$month_start = $_POST['month_start'];
$day_start = $_POST['day_start'];
$year_start = $_POST['year_start'];
$time_start = $_POST['time_start'];
$ampm_start = $_POST['ampm_start'];

$month_end = $_POST['month_end'];
$day_end = $_POST['day_end'];
$year_end = $_POST['year_end'];
$time_end = $_POST['time_end'];
$ampm_end = $_POST['ampm_end'];
$pto_notes = $_POST['comments'];

// file with database connection
include ("database_connection.php");

// SQL statement to insert information from user's input into database 
$sql = "INSERT INTO pto_request (emp_ID, month_start, day_start, year_start, time_start, ampm_start,
                                 month_end, day_end, year_end, time_end, ampm_end, pto_notes) 
		VALUES ('$user_ID', '$month_start', '$day_start', '$year_start', '$time_start', '$ampm_start', 
		        '$month_end', '$day_end', '$year_end', '$time_end', '$ampm_end', '$pto_notes')";
$result = $conn->query($sql);

if ($result === TRUE) {
    //echo "New record created successfully";
	header("Location:user_pto.php");
} else {
}

$conn->close();
?>

