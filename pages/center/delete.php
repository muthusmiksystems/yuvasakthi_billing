<?php
$link=mysqli_connect("localhost","root","","trainee");
//mysqli_select_db("main_project",$link);
$id=$_GET["xyz"];
$query="delete from tbl_center where id='$id'";
$data=mysqli_query($link,$query);
if($data > 0)
{
	echo "<script>alert('data is sucessfully deleted')</script>";
	echo "<script> window.location.href='display_center.php'</script>";
	
}
else
{
	echo "<script>alert('please enter the valid values')</script>";
}

?>