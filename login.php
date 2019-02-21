<?php
// Start the session
session_start();
?>

<html>
<body>

<!-- this code eliminates error messages -->
<?php error_reporting (E_ALL ^ E_NOTICE); ?>

<?php 

$uname = $_GET['username']; // stores username entered in textbox
$pass = $_GET['password']; // stores password entered in textbox

// database connection file
include ("database_connection.php");

// SQL statement to fetch information from the database based on user input. 
$sql = "SELECT login_ID, user_type FROM user WHERE username = '{$uname}' 
        AND password = '{$pass}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		// stores value of login_ID (which is same as employee ID) of the user for further use in website 
		$_SESSION["employee_id"] = $row['login_ID']; 
		
			// redirects to user's page if based on user_type
			if($row['user_type'] == 2) {
				header("Location:user_attendance.php");
			}   
			// redirects to manager's page if based on user_type
			else if($row['user_type'] == 1) {
				header("Location:manager_search_employee.php");
			}
			// if user_type is wrong, redirects back to login page
			else{ 
				header("Location:login.html");
			}
    }
} else {
	// throws alert message
	echo "<script type='text/javascript'>alert(\"Wrong Username or Password\")</script>"; 
	include("login.html"); // redirects back to login page
	//header("Location:timeCard.html");
}

$conn->close();

?>

</body>
</html>