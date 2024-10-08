<?php
session_start();
include '../config/config.php';
if(isset($_POST['username']))
{
	$query="select name,email,password,photo,contact from tbl_admin where name='".$_POST['username']."' and password='".sha1($_POST['passwd'])."'";
	//echo $query;
	$result=mysqli_query($con,$query);
	if (mysqli_num_rows($result)>0)
	{
		$msg=base64_encode("you have succesfuuly login");
		//echo $msg;
		$_SESSION['X'] = $msg;
		header("Location:home.php?msg=$msg");
	}
	else
	{
		$msg=base64_encode("wrong username or password");
		//echo $msg;
		header("Location:../index.php?msg=$msg");
	}
}
else
{
	$msg=base64_encode("Unable to Access this application");
	header("Location:index.php?msg=$msg");
}
?>