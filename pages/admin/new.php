<?php
include_once '../sqlquery.php';
$connection = new abc();
$table = "tbl_admin";
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

	<div class="alert alert-danger">
		<div class="container-fluid">
			<form method="post" enctype="multipart/form-data">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<u>
							<h1 class="page-header" ALIGN="CENTER">
								ADD NEW ADMIN
							</h1>
						</u>
					</div>
				</div>
				<!-- /ADD TRAINEE DETAIL -->
				<div style='display:flex;justify-content: center;align-items: center;'>
					<div class="col-lg-8">
						<!--  name-->

						<div class="form-group">
							<label>Name</label>
							<input class="form-control" placeholder="Name of new admin" name="na">
						</div>

						<!-- mobile no -->
						<div class="form-group">
							<label>contact no.</label>
							<input class="form-control" placeholder="contact number" type="number" name="num">
						</div>
						<!-- email -->
						<div class="form-group">
							<label>Email-ID</label>
							<input class="form-control" placeholder="Email-Id of admin" type="email" name="em">
						</div>
						<!--password  -->
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="pwd">
						</div>

						<!--  image-->
						<div class="form-group">
							<input type="file" name="image" />
							<img class="img-thumbnail" src="http://placehold.it/400x400" alt="">
						</div>

						<!--update or reset button  -->
						<div class="form-group">
							<button type="submit" class="btn btn-lg btn-primary" name="sub">Add Admin</button>
							&nbsp &nbsp &nbsp &nbsp &nbsp
							<a href="add_admin.php"> <button type="button"
									class="btn btn-lg btn-warning">Reset</button></a>
						</div>
					</div>
				</div>

			</form>
			<?php
			if (isset($_POST['sub'])) {
				$a = $_POST["na"];
				$b = $_POST["num"];
				$c = $_POST["em"];
				$d = $_POST["pwd"];
				$len = strlen($b);
				$tr1 = substr($a, 0, 3);
				$tr2 = substr($b, $len - 4, $len);
				$m = $tr1 . $tr2;

				// for image uploads
				$img = $_FILES["image"]["name"];
				$type = $_FILES["image"]["type"];
				$size = $_FILES["image"]["size"];
				$store = $_FILES["image"]["tmp_name"];
				//comditions for image format
				$arr = explode('.', $img);
				$en = end($arr);
				$format = array("png", "jpg", "jpeg", "gif", "JPG");
				if (in_array("$en", $format)) {
					move_uploaded_file($store, "../../uploads/" . $img);
					$result = $connection->add_admin($table, $m, $a, $b, $c, $d, $img);
					if ($result > 0) {
						echo "<script>alert(' new admin succesfully added ')</script>";
						echo "<script> window.location.href='index.php'</script>";
					} else {
						echo "<script>alert('error')</script>";
					}
				} else {
					echo "<script>alert(' wrong file format ')</script>";
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