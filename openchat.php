<?php
	
	session_start();

	$dir="openchat";

	if(!file_exists($dir))
	{
		mkdir($dir,0777);
	}

	if(!empty($_POST['opentext']) && isset($_POST['subopentext']))
	{
	$username=$_SESSION['user'];
	$fname=fopen($dir."/openchat.txt","a+");
	echo fwrite($fname,"$username"."\r\n");
	fclose($fname);
	$fname=fopen($dir."/openchat.txt","a+");
	echo fwrite($fname,"$_POST[opentext]"."\r\n");
	fclose($fname);
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Welcome <?php echo $_SESSION['user'] ?> </title>
		<link rel="stylesheet" type="text/css" href="profile.css">
	</head>

<body>


<div id="align">

		<div id="text">Hi' <a href="profile.php" style="color:white;"><?php echo $_SESSION['user']; ?></a>&nbsp;
			<button class="pass" align="center" onclick="updatepassword();" style="color:#660066;"><b>CHANGE PASSWORD</b></button>
		   <a class="pass" href="logout.php">SIGN OUT</a></div>
</div> 
<div id = "chats">

<?php
if(file_exists($dir.'/openchat.txt'))
{
$fname=fopen($dir."/openchat.txt","r");
$name1=" ";
$i=0;

	while(!feof($fname))
	{
	$name=fgets($fname);
					if($i%2==0)
					{	
						if($name1!=$name)
						{
							echo '<div id="openarea1"><br />'.$name.'<br /></div>';
							$name1=$name;
						}
					}
					else echo  "&nbsp".$name."<br />";
					$i++;
	}
	fclose($fname);	
}

?>
</div>

<div id="chats1">
<form method="post" action="openchat.php">
<input type="text" name="opentext" id="typeee" />
<input type="submit" name="subopentext" style="cursor:pointer;"/>

</form>
</div>


</body>
</html>