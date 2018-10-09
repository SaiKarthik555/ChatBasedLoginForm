
<?php

include "connect.php";
session_start();

	$details=true;
	$info = getimagesize($_FILES['userfile']['tmp_name']);


	if ($_FILES['userfile']['error'] !== UPLOAD_ERR_OK   ||  $info === FALSE || ($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG) ) {
		//die("Upload failed with error code " . $_FILES['file']['error']);
?>
		<script>alert("Please select a valid GIF/JPEG/PNG Image")</script>
<?php
		echo "Go  Back xD";
		$details = false;
	}

		if($details)
		{
			$image = $_FILES['userfile']['tmp_name'];
			$img = file_get_contents($image);

		
			$query = $conn->prepare("Update users set Image=? where username=?");
			$query->bind_param('ss',$img,$_SESSION['user']);
			if($query->execute())
			{
				header("Location: profile.php");
				$_SESSION['picture']=$img;
				echo $img;
			}
			else{
					echo "Failed";
				}
	     }

?>