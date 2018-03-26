<div id='final'>
<?php
session_start();
include 'connect.php';
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