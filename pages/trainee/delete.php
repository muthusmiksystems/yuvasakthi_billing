<?php
include "../../config/config.php";
global $con;
$id=$_GET["id"];
$query="delete from tbl_trainee where id='$id'";
$data=mysqli_query($con,$query);
if($data > 0)
{
	echo "<script>alert('data is sucessfully deleted')</script>";
	echo "<script> window.location.href='index.php'</script>";
	
}
else
{
	echo "<script>alert('please enter the valid values')</script>";
}

?>