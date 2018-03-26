<?php


include "connect.php";
$field="";
$changedvalue="";
foreach($_GET as $param => $value){
$field=$param;
$changedvalue=$value;
}
session_start();
$_SESSION["idd"]=1;

if($field=="Email" || $field=="Phone")
{	
	$query = $conn->prepare("SELECT username FROM users WHERE {$field}=?");
	$query->bind_param('s',$changedvalue);
	$query->execute();
	$query->bind_result($name);
	$query->store_result();
		if($query->num_rows!=0)
		{
			echo 'Given Email/Phone number is already taken';
		}
			else{
			$query=$conn->prepare("Update users set {$field}=? where username=?");
			$query->bind_param('ss',$changedvalue,$_SESSION['user']);
			$query->execute();
			echo $changedvalue;
		}
	}

	if($field == "Name")
	{
			$query=$conn->prepare("Update users set {$field}=? where username=?");   //Username,email,phone is unique but not name
			$query->bind_param('ss',$changedvalue,$_SESSION['user']);
			$query->execute();
			echo $changedvalue;

	}
	if($field=="username")
	{
		$query = $conn->prepare("SELECT email FROM users WHERE {$field}=?");
		$query->bind_param('s',$changedvalue);    
		$query->execute();
		$query->bind_result($name);
		$query->store_result();
		if($query->num_rows!=0)
		{
			echo 'Given UserName already taken';
		}
			else{
			$query=$conn->prepare("Update users set {$field}=? where username=?");
			$query->bind_param('ss',$changedvalue,$_SESSION['user']);
			$query->execute();
			echo $changedvalue;
			$_SESSION['user']=$changedvalue;   //to use it, i had written seperately
		   }

	}
		
?>