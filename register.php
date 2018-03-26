<?php
session_start();
if(isset($_SESSION['user'])){
	header("location:profile.php");
}
?>

<html>
<head>
	<title>SignUp and SignIn Page</title>
	<link rel="stylesheet" type="text/css" href="register-login.css">
</head>

<body>
	<center>
		<div id="login-form1">
				<form enctype="multipart/form-data" action="validation.php" method="post" id="fields">
					<table>
						<p id="kalyan"><b>Sign -  Up</b></p>   <!--  'kalyan' id is for style purpose whereas kalyan1,2,3,4,5,6,7 are used in validation.js -->
						   
						    <tr>
								<td><input type="text" name="name" id="name" placeholder="Full Name" required /></td>	
					    	</tr>
								
							<tr>
								<td id="kalyan1"></tr>   <!-- for displaying error messages-->
							</tr>
								
							<tr>	
								<td><input type="text" name="uname" id="uname" placeholder="User Name" required /></td>
							</tr>
					
							<tr>
								<td id="kalyan2"> </tr>
							</tr>
						
							<tr>
								<td><input type="email" name="email" id="email" placeholder="Email"required></td>				
							</tr>
						
							<tr>
								<td id="kalyan3"></tr>
							</tr>
					
							<tr>
								<td><input type="number" name="phno" id="phone" placeholder="Phone Number" required></td>		
							</tr>
							
							<tr>
								<td id="kalyan4"></tr>
							</tr>
							
							<tr> 			
				            	<td><input type="password" name="pass" id="pass" placeholder="Password" required></td>
							</tr>
						
							<tr>
								<td id="kalyan5"></tr>
							</tr>

							<tr>				
								<td><input type="password" name="cpass" id="cpass" placeholder="Confirm Password" required></td>	
							</tr>
							
					     	<tr>
								<td id="kalyan6"></tr>
							</tr>

					    	<tr>			
								<input type="hidden" name="MAX_FILE_SIZE" value="10000000"/>
								<td><input name="userfile" type="file" id="files" required/></td>	
							</tr>

							<tr>
								<td id="kalyan7"></tr>
							</tr>

							<tr>
								<td><button type="submit" name="submit" onclick="return validateForm();">Sign Me Up</button></td>
							</tr>
		
							<tr><td></td></tr>
	
							<tr>
								<td><a href="login.php">Sign In Here</a></td>
							</tr>
					</table>

				</form>
			<p id="demo"></p>
			<script  src="validation.js" type="text/javascript" ></script>
					    
</body>

</html>
