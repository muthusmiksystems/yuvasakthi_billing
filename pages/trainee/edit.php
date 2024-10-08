<?php
include "../../config/config.php";
global $con;
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	$query = "select * from tbl_trainee where id=" . $id;
	$row = mysqli_query($con, $query);
	$data = mysqli_fetch_array($row);
	//var_dump($data);
}
?>
<?php
session_start();
?>
<?php
if ($_SESSION["X"] == "") {
	header('location:index.php');
}
?>
<?php
include '../common/header.php';
?>



<div class="container-fluid">
	<div class="alert alert-danger">
		<!-- Page Heading -->

		<!-- content -->
		<div class="panel panel-info">

			<div class="alert alert-success">
				<div class="panel-body">
					<!--  trainee display table-->
					<div class="col-lg-12">
						<h3 class="page-header" align="center" color="red">
							<u> Edit Student</u>
						</h3>
					</div>
					<form method="post" enctype="multipart/form-data">
						<!-- add new trainee details-->
						<div class="col-lg-6">
							<!--  name-->
							<div class="form-group">
								<label>Name</label>
								<input class="form-control" placeholder="Name of new trainee" name="na"
									value="<?php echo $data["name"]; ?>">
							</div>
							<!--  father name-->
							<div class="form-group">
								<label>Father Name</label>
								<input class="form-control" placeholder=" Father Name of new trainee" name="fna"
									value="<?php echo $data["father_name"]; ?>">
							</div>
							<!-- mobile no -->
							<div class="form-group">
								<label>contact no.</label>
								<input class="form-control" placeholder="contact number" type="number" name="num"
									value="<?php echo $data["contact"]; ?>">
							</div>
							<!-- email -->
							<div class="form-group">
								<label>Email-ID</label>
								<input class="form-control" placeholder="Email-Id of trainee" type="email" name="em"
									value="<?php echo $data["email"]; ?>">
							</div>
							<!-- address -->
							<div class="form-group">
								<label>Address</label>
								<textarea class="form-control" rows="3"
									name="ad"><?php echo $data["address"]; ?></textarea>
							</div>
							<!--select course  -->
							<div class="form-group">
								<label>select course</label>
								<select multiple="" class="form-control" name="cou[]" >
									<?php
									$strarr = explode(",", $data['course']);
									$query = "select * from tbl_course";
									$row = mysqli_query($link, $query);
									$i = 0;
									while ($data1 = mysqli_fetch_array($row)) {
										if (in_array($data1["course_name"],$strarr)) {
											?>
											<option selected><?php echo $data1["course_name"]; ?></option>
											<?php
										} else {
											?>
											<option><?php echo $data1["course_name"]; ?></option>
											<?php
											
										}
									
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
								<input class="form-control" name="doj" type="date" value="<?php echo $data["doj"]; ?>">
							</div>
							<!-- d.o.b -->
							<div class="form-group">
								<label>D.O.B</label>
								<input class="form-control" name="dob" type="date" value="<?php echo $data["dob"]; ?>">
							</div>

							<div class="form-group">
								<label>Course Duration</label>
								<select class="form-control" name="dur">
									<?php
									$query = "select * from tbl_duration";
									$row = mysqli_query($link, $query);

									while ($data2 = mysqli_fetch_array($row)) {
										?>
										<option><?php echo $data2["course_duration"]; ?></option>
										<?php
										$count++;
									}
									?>
								</select>
							</div>
							<!--  image-->
							<div class="form-group">
								<input type="file" name="image" />
								<img class="img-thumbnail" src="<?php echo "../../uploads/" . $data["image"]; ?>"
									alt="">
							</div>
							<!--total fee  -->
							<div class="form-group">
								<label>Total fees</label>
								<div class="form-group input-group">
									<span class="input-group-addon">Rs.</span>
									<input type="text" class="form-control" name="fee"
										value="<?php echo $data["fee"]; ?>">
									<span class="input-group-addon">.00</span>
								</div>
							</div>
							<!--update or reset button  -->
							<div class="form-group">
								<button type="submit" name="sub" class="btn btn-lg btn-primary">Update</button>
								<a href="resetedit_trainee.php?edi=<?php echo $data['id']; ?>">
									<button type="button" class="btn btn-lg btn-warning">Reset</button>
								</a>
							</div>
						</div>
					</form>
					<?php
					if (isset($_POST['sub'])) {
						$a = $_POST["na"];
						$b = $_POST["fna"];
						$c = $_POST["num"];
						$d = $_POST["em"];
						$e = $_POST["ad"];
						$f = implode(",", $_POST["cou"]);
						$g = $_POST["ge"];
						$h = $_POST["doj"];
						$i = $_POST["dob"];
						$j = $_POST["dur"];
						$k = $_POST["fee"];
						$len = strlen($c);
						$tr1 = substr($a, 0, 3);
						$tr2 = substr($c, $len - 4, $len);
						$m = $tr1 . $tr2;
						//upload a mage
						if (isset($_FILES["image"]) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
							$img = $_FILES["image"]["name"];
							$type = $_FILES["image"]["type"];
							$size = $_FILES["image"]["size"];
							$store = $_FILES["image"]["tmp_name"];
							//select a fiel format
					
							$arr = explode('.', $img);
							$en = end($arr);
							$format = array("png", "jpg", "jpeg", "gif");
							if (in_array("$en", $format)) {
								move_uploaded_file($store, "../../uploads/" . $img);
							} else {
								echo "<script>alert(' wrong file format ')</script>";
							}
						}
						else{
						$img = $data["image"];
						} 
						$query = "update tbl_trainee set name='$a',father_name='$b',contact='$c',email='$d',address='$e',course='$f',gender='$g',doj='$h'
			,dob='$i',duration='$j',fee='$k',image='$img',trainee_id='$m' where id='$id' ";

						$row = mysqli_query($link, $query);
						if ($row > 0) {
							echo "<script>alert(' data updated succesfully ')</script>";
							echo "<script> window.location.href='index.php'</script>";
						} else {
							echo "<script>alert('error')</script>";
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->


<!-- /#wrapper -->

<?php
include "../common/footer.php";

?>