<?php
include "../../config/config.php";
global $con;
//$link = mysqli_connect("localhost", "root", "", "trainee");
//mysqli_select_db("main_project",$link);
 
if (isset($_GET["edi"])) {
	$id = $_GET["edi"];
	$query = "select * from tbl_admin where id=".$id;
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
		<div class="alert alert-warning">
			<!-- Page Heading -->
			 

			<!-- content -->
			<div class="panel panel-info">
				
				<div class="alert alert-info">
					<div class="panel-body">
						<!--  trainee display table-->

						
						<div class="col-lg-12">
							<h3 class="page-header" align="center" color="red">
								<u> Edit Admin</u>
							</h3>
						</div>
						<form method="post" enctype="multipart/form-data">
							<!-- add new trainee details-->
							<div style='margin-left:270px;'>
								<div class="col-lg-8">
									<!--  name-->
									<div class="form-group">
										<label>Name</label>
										<input class="form-control" placeholder="Name of admin " name="na"
											value="<?php echo $data["name"]; ?>">
									</div>

									<!-- mobile no -->
									<div class="form-group">
										<label>contact no.</label>
										<input class="form-control" placeholder="contact number" type="number"
											name="num" value="<?php echo $data["contact"]; ?>">
									</div>
									<!-- email -->
									<div class="form-group">
										<label>Email-ID</label>
										<input class="form-control" placeholder="Email-Id of Admin" type="email"
											name="em" value="<?php echo $data["email"]; ?>">
									</div>
									<!-- password -->
									<div class="form-group">
										<label>Password</label>
										<input class="form-control" placeholder="Password of Admin" type="password"
											name="pwd" value="<?php echo $data["password"]; ?>">
									</div>



									<!--  image-->
									<div class="form-group">
										<input type="file" name="img" />
										<img class="img-thumbnail" src="../../uploads/"+<?php echo $data["photo"]; ?> alt=""
											width="200px" height="200px">
									</div>


									<!--update or reset button  -->
									<div class="form-group">
										<button type="submit" name="sub" class="btn btn-lg btn-primary">Update</button>
										<a href="resetedit_admin.php?edi=<?php echo $data['id']; ?>">
											<button type="button" class="btn btn-lg btn-warning">Reset</button>
										</a>
									</div>
								</div>
							</div>
						</form>
						<?php
						if (isset($_POST['sub'])) {
							$a = $_POST["na"];
							$c = $_POST["num"];
							$d = $_POST["em"];
							$e = $_POST["pwd"];
							$len = strlen($c);
							$tr1 = substr($a, 0, 3);
							$tr2 = substr($c, $len - 4, $len);
							$m = $tr1 . $tr2;
							//uploade image
							$img = $_FILES["img"]["name"];
							$type = $_FILES["img"]["type"];
							$size = $_FILES["img"]["size"];
							$store = $_FILES["img"]["tmp_name"];
							$arr = explode('.', $img);
							$en = end($arr);
							$format = array("jpg", "png", "jpeg");
							if (in_array("$en", $format)) {
								move_uploaded_file($store, "../../uploads/" . $img);
								$query = "update tbl_admin set name='$a',contact='$c',email='$d',password='$e'
	,photo='$img',admin_id='$m' where id='$id' ";

								$row = mysqli_query($link, $query);
								if ($row > 0) {
									echo "<script>alert(' data updated succesfully ')</script>";
									echo "<script> window.location.href='index.php'</script>";
								} else {
									echo "<script>alert('error')</script>";
								}
							} else {
								echo "<script>alert(' wrong format ')</script>";
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
<?php
include "../common/footer.php";
?>