<?php
// access file
include ("user_profile.php");
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
	<h2>View Profile</h2>	
	<!-- form to display employee information -->
	<form action="user_view_profile.php" method="post">		
		<table bgcolor="#C4C4C4" align="center" width="500" border="0">	  
			<tr>		
			<td align="center"colspan="2">
				<font color="#0000FF" size="4">Employee's Information</font>
			</td>	  
			</tr>				
			<tr>		
			<td>ID</td>		
			<td><label><?php echo $id;?></label></td>	  
			</tr>	
			<tr>		
			<td>First Name</td>	
			<td><label><?php echo $fname;?></label></td>			
			</tr>	
			<tr>		
			<td>Last Name</td>		
			<td><label><?php echo $lname;?></label></td>	  
			</tr>
			<tr>		
			<td>Phone</td>		
			<td><label><?php echo $phone;?></label></td>	  
			</tr>		
			<tr>		
			<td>Email </td>		
			<td><label><?php echo $email;?></label></td>	  
			</tr>
			<tr>		
			<td>Position</td>		
			<td><label><?php echo $position;?></label></td>	  
			</tr>
			<tr>		
			<td>Department</td>		
			<td><label><?php echo $department;?></label></td>	  
			</tr>		
			<tr>		
			<td>Username</td>		
			<td><label><?php echo $username;?></label></td>	  
			</tr>	  
			<tr>		
			<td>Password</td>		
			<td><label><?php echo $password;?></label></td>	  
			</tr>
			<tr>		
			<td>User Type</td>
			<td><label><?php echo $usertype;?></label></td>	  
			</tr>			
		</table>			
	</form>	
	<!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>   	
</body>
</html>