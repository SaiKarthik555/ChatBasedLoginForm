<html>
<head>
	<title>SignUp and SignIn Page</title>
	<link rel="stylesheet" type="text/css" href="register-login.css">
</head>

<body>
<?php
	session_start();
	if(isset($_SESSION['user']))
	{
		header("Location: profile.php");
	}
	else
	{
		if($_SERVER['REQUEST_METHOD']=="POST" )
		{
			include "connect.php";
			$email=$_POST["email"];
			$inputpass=SHA1($_POST["password"]);
			$sql=$conn->prepare("SELECT id,username,password from users where email=?");
			$sql->bind_param('s',$email);
			$sql->execute();
			$sql->bind_result($id,$name,$pass1);
			while (($status = $sql->fetch()) === true) 
			{ 
				if($pass1===$inputpass)
				{
					$_SESSION["user"]=$name;
					$_SESSION["user_id"]=$id;
					header("Location: profile.php");
				}
			}
		if($status=$sql->fetch()==false || $pass!==$row->pass)
	?>
	<script>	alert("Invalid username or password");   </script>
<?php
		}	
	}

?>
<center>
<div id="login-form">
	<form action="" method="post"  id="signin">
		
		<table>
				<p id="kalyan"><b>Sign -  In</b></p>

		<tr>
			
			<td><input type="email" name="email" placeholder="Email Address" ></td>
		</tr>

		<tr><td></td></tr>
		
		<tr>
			<td><input type="password" name="password" placeholder="Password"></td>
		</tr>
		
		<tr><td></td></tr>
		
		<tr>
			<td><button  name="submit"  >Sign In</button></td>
		</tr>
		
		<tr><td></td></tr>
		
		<tr>
			<td><a href="register.php">Sign Up Here</a></td>
		</tr>
	
		</table>
	</form>
</div>

</center>
</body>
</html>