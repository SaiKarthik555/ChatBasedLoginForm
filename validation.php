<?php

$error = false;
include 'connect.php';


if (isset($_POST['submit'])) {
	session_start();
	$fullname = mysqli_real_escape_string($conn, $_POST['name']);    //preventing sql injection
	$name = mysqli_real_escape_string($conn, $_POST['uname']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$phno = mysqli_real_escape_string($conn, $_POST['phno']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);
	$cpass = mysqli_real_escape_string($conn, $_POST['cpass']);
	//name can contain only alpha characters and space
	if (!preg_match("/^[a-zA-Z ]+$/",$fullname)) {
		echo "Name must contain only alphabets and space<br>";
		$error = true;
	}
	

	if(!(preg_match('/[a-zA-Z][a-zA-Z ]+|[a-zA-Z]/',$name))){
		echo 'Username must not be empty';
		$error = true;
	}
	if(strlen(trim($name)) == 0){
		echo 'Username must contain atleast 1 non-whitespace character';
		$error = true;
	}


	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		echo "Please Enter Valid Email ID<br>";
		$error = true;
	}
	
	if(!strcmp($phno,'')){
		echo 'Phone number must not be empty';
		$error = true;
	}
	if(strlen(trim($phno)) == 0){
		echo 'Phone number must contain atleast 1 non-whitespace character';
		$error = true;
	}
	if(!(preg_match("/^[0-9]{10}$/",$phno))){
		echo "Invalid phone number";
		$error = true;
	}

	if(!(preg_match('/\S/',$pass))){
		echo 'Password must not be empty and must contain atleast 1 non-whitespace character';
		$error = true;
	}
	

	if(strcmp($pass,$cpass)){
		echo 'Confirm Password must be same as Password';
		$error = true;
	}

	$details=true;

	if ($_FILES['userfile']['error'] !== UPLOAD_ERR_OK) {
		//die("Upload failed with error code " . $_FILES['file']['error']);
		echo "Upload failed with error code ". $_FILES['userfile']['error'];
		$error= true;
		$details = false;
	}

	$info = getimagesize($_FILES['userfile']['tmp_name']);
	if ($info === FALSE) {
		//die("Unable to determine image type of uploaded file");
		echo "Unable to determine image type of uploaded file<br>";
		$error=true;
		$details=false;
	}

	if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
		//die("Not a gif/jpeg/png");

		echo "Not a gif/jpeg/png<br>";
		$error =  true;
		$details=false;
	}

		if($details)
		{
			$image = $_FILES['userfile']['tmp_name'];
			$img = file_get_contents($image);
		}


	if (!$error) {
	include("connect.php");
		$query = $conn->prepare("SELECT username FROM users WHERE phone= ? or email=? or username=?");
		$query->bind_param('sss',$phno, $email, $name);
		$query->execute();
		$query->bind_result($name);
		$query->store_result();
		if($query->num_rows==0)
		{
			
			$stmt=$conn->prepare("INSERT INTO users (name,username,email,phone,password,image) VALUES (?, ?, ?, ?, ?, ? )");
			$stmt->bind_param('ssssss', $fullname,$name,$email, $phno, SHA1($pass), $img);       //password is hashed by using sha1 encryption
			if($stmt->execute())
			{
					header('Location: login.php');
					echo "saiaa";
					
			}
		}
		else{
			echo "The EmailId/Phone No:/Username is already registered";
		}
	}
	else
	{
		echo "Please correct all the errors";
	}
	
}


?>