<?php
	
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Welcome <?php echo $_SESSION['user'] ?> </title>
		<link rel='stylesheet' type='text/css' href='profile.css'>
		<link rel='stylesheet' type='text/css' href='chat.css'>
	</head>

<body>


<div id="align">

		<div id="text">Hi' <a href="profile.php"><?php echo $_SESSION['user']; ?></a>&nbsp;
			<button class="pass" align="center" onclick="updatepassword();" style="color:#660066;"><b>CHANGE PASSWORD</b></button>
		   <a class="pass" href="logout.php">SIGN OUT</a></div>
</div> 



<div id="position">
	<a href="conversation.php" class="style">Conversations</a>
	|	
	<a href="send.php" class="style">Start New Conversation</a>
</div>

</body>
</html>