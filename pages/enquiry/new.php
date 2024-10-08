<?php
include_once '../sqlquery.php';
$connection=new abc();
$table="tbl_enquiry";
?>
<?php
session_start();
?>
<?php
if($_SESSION["X"]=="")
{
	header('location:index.php');
}
?> 
<?php
include '../common/header.php';
?>
 

        <div id="page-wrapper" >
		
		  <div class="alert alert-success">
            <div class="container-fluid">
				<form method="post" enctype="multipart/form-data">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                       <u> <h1 class="page-header" ALIGN="CENTER">
                            ADD NEW ENQUIRY
                        </h1></u>
                    </div>
                </div>
                <!-- /ADD TRAINEE DETAIL -->
									<div class="col-lg-6">
									<!--  name-->
									
										<div class="form-group">
											<label>Name</label>
											<input class="form-control" placeholder="Name of new trainee" name="na">
										</div>
									<!--  father name-->
										<div class="form-group">
											<label>Father Name</label>
											<input class="form-control" placeholder=" Father Name of new trainee" name="fna">
										</div>
									<!-- mobile no -->
										<div class="form-group">
											<label>contact no.</label>
											<input class="form-control" placeholder="contact number" type="number" name="num">
										</div>
									<!-- email -->
										<div class="form-group">
											<label>Email-ID</label>
											<input class="form-control" placeholder="Email-Id of trainee" type="email" name="em">
										</div>
									<!-- address -->
										<div class="form-group">
											<label>Address</label>
											<textarea class="form-control" rows="3" name="add"></textarea>
										</div>
									<!--select course  -->
										<div class="form-group">
											<label>select course</label>
											<select multiple="" class="form-control" name="cou">
												<?php
													$query="select * from tbl_course";
													$row=mysqli_query($link,$query);
													
													while($data=mysqli_fetch_array($row))
													{
												?>
													<option><?php echo $data["course_name"];?></option>
													<?php
														$count++;
														}
													?>
											</select>
										</div>
										
									</div>
									<div class="col-lg-6">
									<!--  gender-->
										<div class="form-group">
											<label>select gender</label>
											&nbsp &nbsp &nbsp &nbsp
											<label class="radio-inline">
												<input type="radio" name="ge" id="optionsRadiosInline1" value="male" checked="">male
											</label>
											<label class="radio-inline">
												<input type="radio" name="ge" id="optionsRadiosInline2" value="female">female
											</label>
											<label class="radio-inline">
												<input type="radio" name="ge" id="optionsRadiosInline3" value="other">other
											</label>
										</div>
									<!-- date of joining -->
										<div class="form-group">
											<label>Date of joining</label>
											<input class="form-control"  type="date" name="doj">
										</div>
									<!-- d.o.b -->
										<div class="form-group">
											<label>D.O.B</label>
											<input class="form-control"  type="date" name="dob">
										</div>
									<!-- select duration -->
									
									<div class="form-group">
											<label>Course Duration</label>
											<select class="form-control" name="dur">
													<?php
														$query="select * from tbl_duration";
														$row=mysqli_query($link,$query);
														
														while($data=mysqli_fetch_array($row))
														{
													?>
												<option><?php echo $data["course_duration"];?></option>
													<?php
														$count++;
														}
													?>
											</select>
									</div>
									<!--  image-->
										<div class="form-group">
											<input type="file" name="image" />
											<img class="img-thumbnail" id="previewimg" src="http://placehold.it/100x100" alt="" width="100px" height="150px">
										</div>
									<!--total fee  -->
										<div class="form-group">
											<label>Total fees</label>
											<div class="form-group input-group">
												<span class="input-group-addon">Rs.</span>
												<input type="text" class="form-control" name="fee">
												<span class="input-group-addon">.00</span>
											</div>
										</div>
									<!--update or reset button  -->
										<div class="form-group">
											<button type="submit" class="btn btn-lg btn-primary" name="sub">Add enquiry</button>
											&nbsp &nbsp &nbsp &nbsp &nbsp
										<a href="add_enquiry.php">	<button type="button" class="btn btn-lg btn-warning" >Reset</button></a>
										</div>
									</div>

				</form>
<?php
if(isset($_POST['sub']))
{
	$a=$_POST["na"];
	$b=$_POST["fna"];
	$c=$_POST["num"];
	$d=$_POST["em"];
	$e=$_POST["add"];
	$f=$_POST["cou"];
	$g=$_POST["ge"];
	$h=$_POST["doj"];
	$i=$_POST["dob"];
	$j=$_POST["dur"];
	
	$l=$_POST["fee"];
	$len=strlen($c);
	$tr1=substr($a,0,3);
	$tr2=substr($c,$len-4,$len);
	$m=$tr1.$tr2;
		//for image upload
	
	$img=$_FILES["image"]["name"];
	$type=$_FILES["image"]["type"];
	$size=$_FILES["image"]["size"];
	$store=$_FILES["image"]["tmp_name"];
	
	//conditions for image format
	$arr=explode('.',$img);
	$en=end($arr);
	$format=array("jpg","png","gif","jpeg");
	if(in_array("$en",$format))
	{
			move_uploaded_file($store,"../../uploads/".$img);
	
		$result=$connection->add_enquiry($table,$m,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$img,$l);

		if($result > 0)
		{
			echo "<script>alert(' data added succesfully ')</script>";
			echo "<script> window.location.href='index.php'</script>";
		}
		else
		{
			echo "<script>alert('error')</script>";
		}
	}
	
}
?>
			</div>
		   </div>
            <!-- /.container-fluid -->
		


        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php
	   include "../common/footer.php";
	   ?>