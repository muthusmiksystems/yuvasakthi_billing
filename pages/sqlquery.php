<?php
define('DB_SERVER','localhost');
define('DB_USER','muthu');
define('DB_PASS','yyuZ%Wwr=!DRkiel#u87%78u@');
define('DB_NAME','trainee');

class abc
{
	public $conn;
	public function __construct()
	{
		 $this->conn=mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME) or die('UNALBLE TO CONNECT TO SERVER'.mysqli_error());
		//mysqli_select_db(DB_NAME,$conn);
	}
	public function add_trainee($table,$trainee_id,$name,$father_name,$contact,$email,$address,$course,$gender,$doj,$dob,$duration,$image,$fee)
	{
		$result=mysqli_query($this->conn,"insert into $table set trainee_id='$trainee_id', name='$name',father_name='$father_name'
							,contact='$contact',email='$email',address='$address',course='$course',gender='$gender',
							dob='$dob',doj='$doj',duration='$duration',image='$image',fee='$fee'");
		return $result;
	}
	public function add_admin($table,$x,$y,$z,$p,$q,$r)
	{
		$result=mysqli_query($this->conn,"insert into $table set admin_id='$x', name='$y',contact='$z',email='$p',password='$q',photo='$r'");
		return $result;
	}
	public function add_center($table,$x)
	{
		$result=mysqli_query($this->conn,"insert into $table set center_name='$x'");
		return $result;
	}
	public function add_course($table,$x)
	{
		$result=mysqli_query($this->conn,"insert into $table set course_name='$x'");
		return $result;
	}
	public function course_type($table,$x)
	{
		$result=mysqli_query($this->conn,"insert into $table set course_type='$x'");
		return $result;
	}
	public function course_duration($table,$x)
	{
		$result=mysqli_query($this->conn,"insert into $table set course_duration='$x'");
		return $result;
	}
	public function add_enquiry($table,$trainee_id,$name,$father_name,$contact,$email,$address,$course,$gender,$dob,$doj,$duration,$image,$fee)
	{
		$result=mysqli_query($this->conn,"insert into $table set trainee_id='$trainee_id', name='$name',father_name='$father_name'
							,contact='$contact',email='$email',address='$address',course='$course',gender='$gender',
							doj='$doj',dob='$dob',duration='$duration',image='$image',fee='$fee'");
		return $result;
	}
}
?>