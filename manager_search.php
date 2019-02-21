<?php
// pass database connection
include("database_connection.php");

// variable declaration
$id = "";
$fname = "";
$lname = "";
$phone = "";
$email = "";
$position = "";
$department = "";
$username = "";
$password = "";
$usertype = "";
$wrongInput = "";


// array to get values from the form
function getPosts(){
    $posts = array();
    $posts[0] = $_POST['id'];
    $posts[1] = $_POST['fname'];
    $posts[2] = $_POST['lname'];
	$posts[3] = $_POST['phone'];
	$posts[4] = $_POST['email'];
    $posts[5] = $_POST['position'];
	$posts[6] = $_POST['department'];
	$posts[7] = $_POST['username'];
	$posts[8] = $_POST['password'];
	$posts[9] = $_POST['usertype'];
	return $posts;
}

// search record
if(isset($_POST['search'])){
    $data = getPosts();    
    $search_Query = "SELECT employee.*, user.username, user.password, user.user_type 
	FROM employee 
	INNER JOIN user ON employee.emp_ID = user.login_ID
	WHERE employee.emp_ID = '$data[0]' OR employee.emp_fname = '$data[1]' OR employee.emp_lname = '$data[2]'";
    $search_Result = mysqli_query($conn, $search_Query);
    
    if($search_Result)    {
        if(mysqli_num_rows($search_Result))        {
            while($row = mysqli_fetch_array($search_Result))            {
                $id = $row['emp_ID'];
                $fname = $row['emp_fname'];
                $lname = $row['emp_lname'];
				$phone = $row['emp_phone'];
				$email = $row['emp_email'];
                $position = $row['emp_position'];
				$department = $row['emp_department'];
				$username = $row['username'];
				$password = $row['password'];
				$usertype = $row['user_type'];				
            }
        }else{ // error handling
			$wrongInput = "No Data For This Input";
        }
    }else{// error handling
        echo 'Result Error';
    }
}

// delete record
if(isset($_POST['delete'])){
    $data = getPosts();
    $delete_Query = "DELETE employee.*, user.*
	FROM employee 
	JOIN user ON employee.emp_ID = user.login_ID
	WHERE emp_ID = '$data[0]'";
	// error handling
    try{
        $delete_Result = mysqli_query($conn, $delete_Query);
        
        if($delete_Result)
        {
            if(mysqli_affected_rows($conn) > 0)
            {
                $wrongInput = "Data Deleted";
            }else{// error handling
                echo 'Data Not Deleted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Delete '.$ex->getMessage();
    }
}

// update records
if(isset($_POST['update'])){
    $data = getPosts();
    $update_Query = "UPDATE `employee` SET 
	`emp_fname` = '$data[1]', `emp_lname` = '$data[2]', `emp_phone` = '$data[3]', `emp_email` = '$data[4]',
	`emp_position` = '$data[5]', `emp_department` = '$data[6]' 
	WHERE `emp_ID` = $data[0]";	
	// error handling
    try{
        $update_Result = mysqli_query($conn, $update_Query);
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
	
	$update_Query2 = "UPDATE `user` SET `username` = '$data[7]', `password` = '$data[8]', `user_type` = '$data[9]'
	WHERE `login_ID` = $data[0]";	
	// error handling
    try{
        $update_Result2 = mysqli_query($conn, $update_Query2);
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}
?>