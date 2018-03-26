<?php
include "connect.php";
session_start();
if(!isset($_SESSION)==1)
	header("Location: index.php");
$oldpass=SHA1($_POST['oldpass']);
$pass1="";
$error=0;
$newpass=$_POST['newpass'];
$confirmpass=$_POST['confirmpass'];
$sql=$conn->prepare("SELECT password,name from users where username=?");
$sql->bind_param('s',$_SESSION['user']);
$sql->execute();
$sql->bind_result($pass1,$name);
while (($status = $sql->fetch()) === true) 
	{ 
		if($pass1===$oldpass)
		{
			if($newpass===$confirmpass)
			{
						if(!(preg_match('/\S/',$newpass))){
						echo'Password must not be empty and must contain atleast 1 non-whitespace character';
						$error=1;
	      				}				
			}
			else 
				{
					$error=1;
					echo "The 2 passwords dont match";
				}
		}
		else
			{
				$error=1;
				echo "Enter current Password Properly";
			}
	}
	if($error==0)
	{
					
		$query=$conn->prepare("Update users set password=? where username=?");
		$query->bind_param('ss',SHA1($newpass),$_SESSION['user']);
		$query->execute();
		session_destroy();
		echo "Success.Please Login again";
	}
?>