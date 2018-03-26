<?php
	
	session_start();
	include 'connect.php';
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

<br/>

<div id='final'>
<?php
if(isset($_GET['user'])  && !empty($_GET['user'])){
	?>
	<form method="post">
		<?php 
		if(isset($_POST['message'])  && !empty($_POST['message'])){
				$my_id= $_SESSION['user_id'];
				$user = $_GET['user'];
				$random_number = rand();
				$message = $_POST['message'];

				$sql1 = "SELECT hash from message_group where (user_one='$my_id' AND user_two='$user') OR (user_one='$user' AND user_two='$my_id')";

				$check = $conn->query($sql1);
				if($check->num_rows == 1){
					echo "<p>Conversation Already Started !</p>";
				}
				else
				{
					$sql2 = "INSERT INTO message_group VALUES ('$my_id', '$user' , '$random_number')";
					$conn->query($sql2);

					$stmt=$conn->prepare("INSERT INTO messages (group_hash,from_id,message) VALUES (?, ?, ?) ");
					$stmt->bind_param('sss', $random_number,$my_id, $message);       //password is hashed by using sha1 encryption
					$stmt->execute();

					echo "<p>Conversation Started !</p>";
				}

		}

		?>
		Enter Message  : <br/> <br/>
		<textarea name="message" rows='10' cols='50'></textarea>
		<br/><br/>
		<input type="submit" value='Send Message' style="cursor:pointer;" />
	</form>
	<?php
}else{
	echo "<b>Select User</b>";

	$sql="SELECT id,name FROM users ORDER BY name";
	$user_list=mysqli_query($conn,$sql);


	while($run_user = mysqli_fetch_array($user_list,MYSQLI_ASSOC)){
		$user = $run_user['id'];
		$name = $run_user['name'];

		echo "<p ><a id='style1' href='send.php?user=$user'>$name</a></p>";
	}
}
?>

</div>
</body>
</html>