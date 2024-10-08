<?php
include "../../config/config.php";
global $con;
if (isset($_GET["edi"])) {
	$id = $_GET["edi"];
	$query = "select * from tbl_course where id=".$id;
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

<div id="page-wrapper">

	<div class="container-fluid">
		<div class="alert alert-danger">
			<!-- Page Heading -->
			 

			<!-- content -->
			<div class="panel panel-info">
				 
				<div class="alert alert-success">
					<div class="panel-body">
						<!--  trainee display table-->
						<div style='margin-left:350px;'>
							<div class="col-lg-6">
								 
							</div>
						</div>
						<div class="col-lg-12">
							<h3 class="page-header" align="center" color="red">
								<u> Edit Course</u>
							</h3>
						</div>
						<form method="post">

							<!-- add new trainee details-->
							<div style='margin-left:350px;'>
								<div class="col-lg-6">
									<!--  name-->
									<div class="form-group">
										<label>edit prievious course name</label>
										<input class="form-control" placeholder="Name of center " name="na"
											value="<?php echo $data["course_name"]; ?>">
									</div>




									<!--update or reset button  -->
									<div class="form-group">
										<button type="submit" name="sub" class="btn btn-lg btn-primary">Update</button>
										<a href="resetedit_course.php?edi=<?php echo $data['id']; ?>">
											<button type="button" class="btn btn-lg btn-warning">Reset</button>
										</a>
									</div>
								</div>
							</div>
						</form>
						<?php
						if (isset($_POST['sub'])) {
							$a = $_POST["na"];


							$query = "update tbl_course set course_name='$a' where id='$id' ";
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

</div>
<!-- /#wrapper -->
<?php
include '../common/footer.php';
?>