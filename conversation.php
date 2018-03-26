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

	<!--	<script> 
		function chat_ajax(){ 
			var req = new XMLHttpRequest(); 
			req.onreadystatechange = function() {
			 if(req.readyState == 4 && req.status == 200){ 
			 	document.getElementById('chat').innerHTML = req.responseText; 
			 }
		 } 
		 req.open('GET', 'conversation.php', true); 
		 req.send(); 
		} 
		setInterval(function(){chat_ajax()}, 1000) 
		</script>

*/
-->
	</head>

<body>


<div id="align">

		<div id="text">Hi' <a href="profile.php" ><?php echo $_SESSION['user']; ?></a>&nbsp;
			<button class="pass" align="center" onclick="updatepassword();" style="color:#660066;"><b>CHANGE PASSWORD</b></button>
		   <a class="pass" href="logout.php">SIGN OUT</a></div>
</div> 

<div id="position">
	<a href="conversation.php" class="style">Conversations</a>
	|	
	<a href="send.php" class="style">Start New Conversation</a>
</div>

<?php  $my_id = $_SESSION['user_id']; ?>
<br/>

<div id='final'>
<?php
$name1="";
if(isset($_GET['hash']) && !empty($_GET['hash'])){

	$hash = $_GET['hash'];
	$sql2="SELECT from_id,message FROM messages WHERE group_hash='$hash' ";
	$message_query=mysqli_query($conn,$sql2);

	while($run_message  = mysqli_fetch_array($message_query,MYSQLI_ASSOC)){
		$from_id = $run_message['from_id'];
		$message = $run_message['message'];

		$sql3="SELECT username FROM users WHERE id='$from_id'";
		$user_query=mysqli_query($conn,$sql3);
		$run_user=mysqli_fetch_array($user_query,MYSQLI_ASSOC);
		$from_username= $run_user['username'];

		if($name1!=$from_username){
		echo "<p><b>$from_username</b></p>";
		$name1=$from_username;
		}
		echo "<p>&nbsp$message</p>";
		
	}

?>
	<br/>

	<form method='post'>
	<?php 

		if(isset($_POST['message'])  && !empty($_POST['message'])){

				$new_message = $_POST['message'];
				
				$stmt=$conn->prepare("INSERT INTO messages (group_hash,from_id,message) VALUES (?, ?, ?) ");
				$stmt->bind_param('sss', $hash,$my_id, $new_message);   
				$stmt->execute();
		// Main
	



			header('location:conversation.php?hash='.$hash);

		}
		
	?>

	Enter Message  : <br/>
	<textarea name='message' rows='7' cols='50'></textarea>
	<br/><br/>
	<input type='submit'  value='Send Message' style="cursor:pointer;" />
	</form>
	<p id='chat' >hi</p>

<?php
}
else
{
	echo "<b>Select Conversation  :</b>";

	$sql="SELECT hash,user_one,user_two FROM message_group WHERE user_one='$my_id' OR user_two='$my_id' ";
	$get_con=mysqli_query($conn,$sql);


	while($run_con = mysqli_fetch_array($get_con,MYSQLI_ASSOC)){
			$hash = $run_con['hash'];
			$user_one=$run_con['user_one'];
			$user_two = $run_con['user_two'];

			if($user_one == $my_id){
				$select_id  = $user_two;
			}
			else{
				$select_id = $user_one;
			}

			$sql1="SELECT username FROM users WHERE id='$select_id' ";
			$gett_conn=mysqli_query($conn,$sql1);
			$runn_user = mysqli_fetch_array($gett_conn,MYSQLI_ASSOC);
			$select_username = $runn_user['username'];


		
			echo "<p><a href='Conversation.php?hash=$hash'>$select_username</a></p>";

	}
}
?>
</body>
</html>