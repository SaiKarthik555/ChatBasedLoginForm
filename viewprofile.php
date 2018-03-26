<html>
	<head>
	<title><?php echo $_GET['username']; ?></title>
	<link rel="stylesheet" type="text/css" href="profile.css">
	</head>
	<body><?php
	session_start();
	
	if(!isset($_SESSION['user'])){
		header('Location:index.php');
	}
	if(empty($_GET['username'])||$_GET['username']==$_SESSION['user']){
		header('Location:profile.php');
	}
	$user = $_GET['username'];
	include('connect.php');
	$sql = "SELECT username,name,email,phone,image from users where username='$user'";
		$result = $conn->query($sql);
	if ($result->num_rows == 1) {
		$row1= $result->fetch_assoc();
	}
	else{
		header('Location:profile.php');
	}
	
?>

<div id="align">
		<div id="text">Hi' <a href="profile.php" style="color:white;"><?php echo $_SESSION['user']; ?></a>&nbsp;
			<button class="pass" align="center" onclick="updatepassword();" style="color:#660066;"><b>CHANGE PASSWORD</b></button>
		   <a class="pass" href="logout.php">SIGN OUT</a></div>
	</div> 


<input onkeyup="findmatch();" type="text" title="Enter username" id="search" placeholder="Search...">


<div  id="output"></div>

 <div id="img_disp">
<?php
include "connect.php";
echo '<img id="dp" src="data:image/jpeg;base64,'.base64_encode  ($row1['image'] ).'"/>';
?>
</div>



<div id="contents">
	<table id="position">
		<div>
		<tr>
			<td>Name :</td>
			<td id="valueName"><?php echo $row1['name']; ?></td>
		</tr>
		</div>
		<div >
		<tr>
			<td>User Name :</td>
			<td id="valueGender"><?php echo $row1['username']; ?></td>
		</tr>
		</div>
		<div>
		<tr>
			<td>Email :</td>
			<td id="valueEmail"><?php echo $row1['email']; ?></td>
		</tr>
		</div>
		<div>
		<tr>
			<td>Phone Number :</td>
			<td id="valuePhno"><?php echo $row1['phone']; ?></td>
		</tr>
		</div>
	</table>
</div>


	<script>
		function findmatch(){
		var search_text = document.getElementById('search').value;
		document.getElementById("output").style.display="block";
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 &&  xmlhttp.status == 200){
				document.getElementById("output").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open('GET','getuser.php?search_text='+search_text,true);
		xmlhttp.send();
	}
	</script>
	</body>
</html>