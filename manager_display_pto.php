<?php
	// connect to database
	include ("database_connection.php");	
	
	$display_pto = $_POST["display_pto"]; // value of drop down menu 
	$pto_status = $_POST["pto_status"]; // value of drop down menu 
	
	$sql = "UPDATE pto_request 
			SET pto_status = '{$pto_status}'
			WHERE pto_ID = '{$display_pto}'";
	$result = $conn->query($sql);

if ($result === TRUE) {
    //echo "New record created successfully";
	header("Location:manager_time_off_list.php");
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>