<?php
// Start the session
session_start();
// connect to database
include("database_connection.php");

// variable declaration
$id = $_SESSION["employee_id"];
$fname = "";
$lname = "";
$phone = "";
$email = "";
$position = "";
$department = "";
$username = "";
$password = "";
$usertype = "";
	// query database to get data
    $search_Query = "SELECT employee.*, user.username, user.password, user.user_type 
	FROM employee 
	INNER JOIN user ON employee.emp_ID = user.login_ID
	WHERE employee.emp_ID = '{$_SESSION["employee_id"]}'";
    $search_Result = mysqli_query($conn, $search_Query);    
    if($search_Result){
        if(mysqli_num_rows($search_Result)){
            while($row = mysqli_fetch_array($search_Result)){
                $id = $row['emp_ID'];
                $fname = $row['emp_fname'];
                $lname = $row['emp_lname'];
				$phone = $row['emp_phone'];
				$email = $row['emp_email'];
                $position = $row['emp_position'];
				$department = $row['emp_department'];
				$username = $row['username'];
				$password = $row['password'];
				if ($row['user_type'] == 2) {
					$usertype = 'employee';
				}
				else {
					$usertype = 'manager';
				}
            }
        }else{ // error handling
            echo 'No Data For This Id';
        }
    }else{ // error handling
        echo 'Result Error';
    }
?>