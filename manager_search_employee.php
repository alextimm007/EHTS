<?php
// access information from different page
include("manager_search.php");
?>

<!Doctype html>
<html>
   <head>
       <title> My first website </title>
	   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
       <link rel="stylesheet" href="managerHeader.css">
	   <link rel="stylesheet" href="manager_search_employee.css">
	   <script src="JavaScript/eraseText.js"></script>
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
			<li><a href="manager_create_employee.html">Create A Profile</a></li>
			<li><a href="manager_search_employee.php">Search Employee</a></li>
            <li><a href="manager_time_off_list.php">Time Off Requests</a></li>
            <li><a href="manager_attendance.php">Employee's Attendance</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>        
    </div>	
		<h2>Search Employee</h2>
		<!-- if employee not found display error message -->
		<div class="label">
			<label>
				<?php echo $wrongInput; ?>
			</label>
		</div>
		
	<!-- form to display employee's information -->
	<div class="employeeSearch">
		<form action="manager_search_employee.php" method="post">	
			<!-- table to display information -->
			<table bgcolor="#C4C4C4" align="center" width="500" border="0">	  
				<tr>		
				<td align="center"colspan="2">
					<font color="#0000FF" size="4">Enter Employee's: ID, First or Last Name to Search</font>
				</td>	  
				</tr>				
				<tr>		
				<td>ID</td>		
				<td><input type="number" id="id" name="id" value="<?php echo $id;?>" /></td>	  
				</tr>	
				<tr>		
				<td>First Name</td>		
				<td><input type="text" id="fname"  name="fname" value="<?php echo $fname;?>" /></td>	  
				</tr>	
				<tr>		
				<td>Last Name</td>		
				<td><input type="text" id="lname" name="lname" value="<?php echo $lname;?>" /></td>	  
				</tr>
				<tr>		
				<td>Phone</td>		
				<td><input type="number" name="phone" value="<?php echo $phone;?>" /></td>	  
				</tr>		
				<tr>		
				<td>Email </td>		
				<td><input type="email" name="email" value="<?php echo $email;?>" /></td>	  
				</tr>
				<tr>		
				<td>Position</td>		
				<td><input type="text" name="position" value="<?php echo $position;?>" /></td>	  
				</tr>
				<tr>		
				<td>Department</td>		
				<td><input type="text" name="department" value="<?php echo $department;?>" /></td>	  
				</tr>		
				<tr>		
				<td>Username</td>		
				<td><input type="text" name="username" value="<?php echo $username;?>" /></td>	  
				</tr>	  
				<tr>		
				<td>Password</td>		
				<td><input type="text" name="password" value="<?php echo $password;?>" /></td>	  
				</tr>
				<tr>		
				<td>User Type
					<ul>
						<li>1 for manager</li>
						<li>2 for employee</li>
					</ul>
				</td>
				<td><input type="number" min="1" max="2" name="usertype" value="<?php echo $usertype;?>" /></td>	  
				</tr>
				<!-- buttons to update, delete, search and refresh page -->
				<tr>
					<td align="center"colspan="2">
							<input type="submit" class="btn update" name="update" value="Update">
							<input type="submit" class="btn delete" name="delete" value="Delete">
							<input type="submit" class="btn search" name="search" value="Search">	
							<input type="submit" class="btn refresh" name="refresh" value="Refresh" onclick="javascript:eraseText();">	
					</td>
				</tr>			
			</table>			
		</form>
	</div>	
	<!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>   
</body>
</html>