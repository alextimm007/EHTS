<?php
// Start the session
session_start();
?>

<?php
// database connection file
include ("database_connection.php");

// store employee information entered in textboxes
$week_number = date("W");
$firstname = $_GET['firstname']; 
$lastname = $_GET['lastname']; 
$phone = $_GET['phone'];
$email = test_input($_GET['email']);
// check if email is valid
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$emailERR = "Invalid Email Format";
}
$position = $_GET['position'];
$department = $_GET['department'];
$username = $_GET['username'];
$password = $_GET['password'];
$user_type = $_GET['user_type'];
if($user_type == 'manager') {
	$user_type = 1;
}
else {
	$user_type = 2;
}

// SQL statement to insert information from user's input into database 
$sql = "INSERT INTO user (username, password, user_type) 
		VALUES ('$username', '$password', '$user_type')";
$result = $conn->query($sql);
		
$sql2 = "INSERT INTO employee (emp_fname, emp_lname, emp_phone, emp_email, emp_position, emp_department, login_ID_FK) 
		VALUES ('$firstname', '$lastname', '$phone', '$email', '$position', '$department', (SELECT MAX(login_ID) FROM user))";
$result = $conn->query($sql2);

if ($result === TRUE) {
	header("Location:manager_create_employee.html");
} else {
}

$conn->close();

// function to validate email
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>