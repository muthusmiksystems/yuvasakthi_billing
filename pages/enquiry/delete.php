<?php
//$link=mysqli_connect("localhost","root","","trainee");
include "../../config/config.php";
global $con;
////mysqli_select_db("main_project",$link);
$id=$_GET["xyz"];
$query="delete from tbl_enquiry where id='$id'";
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