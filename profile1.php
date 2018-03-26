<?php
	session_start();
	?>
<html>
<head>
	<title>Welcome <?php echo $_SESSION['user'] ?> </title>
	<link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body id="body">
	<?php 
		global $row;
		$row= new StdClass;
		$row->name = "";
		$row->username="";
		$row->email="";
		$row->phone="";
		$row->password = "";
		$row->image="";
		if(!isset($_SESSION['user']))
		header("Location: index.php");
		else
		{	
			include "connect.php";
			$sql=$conn->prepare("SELECT name,username,email,phone,password,image from users where username=?");
			$sql->bind_param('s',$_SESSION['user']);
			$sql->execute();
			$sql->store_result();
			$sql->bind_result($row->name,$row->username,$row->email,$row->phone,$row->password,$row->image);
			$sql->fetch();
		}
	?>

	<div id="align">

		<div id="text">Hi' <?php echo $_SESSION['user']; ?>&nbsp;
			<button class="pass" align="center" onclick="updatepassword();" style="color:#660066;"><b>CHANGE PASSWORD</b></button>
		   <a class="pass" href="logout.php">SIGN OUT</a></div>
	</div> 




<input onkeyup="findmatch();" type="text" title="Enter username" id="search" placeholder="Search...">


<div  id="output"></div>



 <div id="img_disp">

<?php
include "connect.php";
echo '<img src="data:image/jpeg;base64,'.base64_encode( $row->image ).'"/>';
?>

</div>

<div><button type="button" id = "Edit"  onClick="updatedp();">Update Profile Picture</button></div>


	<div id="id01" class="modal">      <!-- for displaying box when tried to update the details-->
	<div class="modal-content" id="change">
	</div>
	</div>


<div id="contents">
	<table>
		<div>
		<tr>
			<td>Name :</td>
			<td id="valueName"><?php echo $row->name;?></td>
			<td ><button type="button" class="pass" onclick = "updatename();">EDIT</button></td>
		</tr>
		</div>
		<div >
		<tr>
			<td>UserName :</td>
			<td id="valueusername"><?php echo $row->username;?></td>
			<td ><button type="button" class="pass" onclick = "updateusername();">EDIT</button></td>
		</tr>
		</div>
		<div >
		<tr>
			<td>Email :</td>
			<td id="valueEmail"><?php echo $row->email;?></td>
			<td><button type="button" class="pass" onclick="updatemail();">EDIT</button></td>
		</tr>
		</div>
		<div>
		<tr>
			<td>Phone Number :</td>
			<td id="valuePhone"><?php echo $row->phone;?></td>
			<td><button type="button" class="pass" onclick="updatephno();"> EDIT</button></td>
		</tr>
	
		</div>

		<div >
		<tr>
			<td  style="float:right;"><button type="button" class="pass" onclick = "update();">EDIT</button></td>
		</tr>
		</div>

	</table>

</div>


	<div id="bottom"><a href="openchat.php" style="text-decoration:none; color:white;"><center>GROUP CHAT</center></a></div>
	<div id="bottom1"><a href="closechat.php" style="text-decoration:none; color:white;"><center>PERSONAL CHAT</center></a></div>

<script>
var param="";
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
	function update()
	{
				param="Name";
		var modal=document.getElementById("id01");
		modal.style.display="block";
		document.getElementById("change").innerHTML="<button onclick=document.getElementById('id01').style.display='none';>x</button><center><table><tr><td>Enter Name:</td><td><input type='text' id='changedvalue'></td><td><button onclick='send()'>Submit</button></td></tr></table></center>";



	}
	function updatename()
	{
		param="Name";
		var modal=document.getElementById("id01");
		modal.style.display="block";
		document.getElementById("change").innerHTML="<button onclick=document.getElementById('id01').style.display='none';>x</button><center><table><tr><td>Enter Name:</td><td><input type='text' id='changedvalue'></td><td><button onclick='send()'>Submit</button></td></tr></table></center>";
	}

	function updateusername()
	{
		param="username";
		var modal=document.getElementById("id01");
		modal.style.display="block";
		document.getElementById("change").innerHTML="<button onclick=document.getElementById('id01').style.display='none';>x</button><center><table><tr><td>Enter UserName:</td><td><input type='text' id='changedvalue'></td><td><button onclick='send()'>Submit</button></td></tr></table></center>";
	}
	
	function updatemail()
	{
		param="Email";
		var modal=document.getElementById("id01");
		modal.style.display="block";
		document.getElementById("change").innerHTML="<button onclick=document.getElementById('id01').style.display='none';>x</button><center><table><tr><td>Email Id:</td><td><input type='email' id='changedvalue'></td><td><button onclick='send()'>Submit</button></td></tr></table></center>";
	}
	function updatephno()
	{
		param="Phone";
		var modal=document.getElementById("id01");
		modal.style.display="block";
		document.getElementById("change").innerHTML="<button onclick=document.getElementById('id01').style.display='none';>x</button><center><table><tr><td>Phone Number:</td><td><input type='text' id='changedvalue'></td><td><button onclick='send()'>Submit</button></td></tr></table></center>";
	}
  
	function updatedp()
	{
		param="Image";
		var modal=document.getElementById("id01");
		modal.style.display="block";
		document.getElementById("change").innerHTML="<button onclick=document.getElementById('id01').style.display='none';>x</button><center><form enctype='multipart/form-data' action='upload.php' method='post'><table><tr><td>Profile Picture:</td><td><input type='file' id='changedvalue' name='userfile'></td><td><button type='submit' name='submit' value='Submit'>Submit</button></td></tr></table></form></center>";
	}
	function updatepassword() {
		var modal=document.getElementById("id01");
		modal.style.display="block";
		var text="<button onclick=document.getElementById('id01').style.display='none';>x</button><center>";
		text+="<table><tr><td>Enter old Password:</td><td><input type='password' name='oldpass' id='oldpass'></td></tr>";
		text+="<tr><td>Enter New Password:</td><td><input type='password' name='newpass' id='newpass'></td></tr>";
		text+="<tr><td>Confirm New Password:</td><td><input type='password' name='confirmpass' id='confirmpass'></td></tr>";
		text+="<tr><td></td><td><button onclick='AjaxChangePass();'>Submit</button>";
		document.getElementById("change").innerHTML=text;
	}
	function AjaxChangePass(){
		var xmlHttp = new XMLHttpRequest();
		var url="updatepassword.php";
		var parameters = "oldpass="+document.getElementById('oldpass').value+"&newpass="+document.getElementById('newpass').value+"&confirmpass="+document.getElementById('confirmpass').value;
		xmlHttp.open("POST", url, true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.setRequestHeader("Content-length", parameters.length);
		xmlHttp.setRequestHeader("Connection", "close");
		xmlHttp.onreadystatechange = function() {
			if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			alert(xmlHttp.responseText);
			if(xmlHttp.responseText=="Success.Please Login again")
				{
				document.location.href='login.php';
			document.getElementById("id01").style.display="none";
				}
			
		}
	}
		xmlHttp.send(parameters);
	}
	function send()
	{
		var newvalue=document.getElementById("changedvalue").value;

		if(param=="Name")
		{
			if (!( /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/.test(newvalue))) {
			alert( 'Name Should contain only alphabets and space.First character should start with letter!');
			return;
			}
		}


		else if(param=="username")
		{
			if(!(/^\w+$/.test(newvalue))){
				alert("Username must contain only letters, numbers and underscores!");
				return;
			}
		}


		else if(param=="Phone")
		{
			
				if(!(/\d/.test(newvalue))){
		alert( "Phone must contain only digits");
			return;
	}
	if(newvalue.length !== 10){
		alert( "Mobile number must contain 10 digits");
		return;
	}
	 
}

else if(param=="Email"){


	if(newvalue === ""){
		alert("Email must not be empty");
		return;
	}
	if(!(/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9-]+\.+[a-zA-Z]{2,4}$/.test(newvalue))){
		alert("Invalid mail address");
	return;
	}
}


		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			if(xhttp.responseText=="Given Email/Phone number is already taken")
			{
				alert("Given Email id/Phone number is already taken");
				return;
			}
			if(xhttp.responseText=="Given UserName already taken"){
				alert("Given UserName already taken");
				return;
			}
					
				document.getElementById("value"+param).innerHTML=xhttp.responseText;
				document.getElementById("id01").style.display="none";
	           	window.location.href = 'profile.php';  //This is for making username to change in title tag and in header portion
		}
		};
		xhttp.open("GET", "update.php?"+param+"="+newvalue, true);
		xhttp.send();
	}
	
</script>

</body>
</html>
