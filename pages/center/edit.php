<?php

$link = mysqli_connect("localhost", "root", "", "trainee");
//mysqli_select_db("main_project",$link);
$id = $_GET["edi"];
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

			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header" align="center">
						<u> Present center detail</u>
					</h1>
				</div>
			</div>

			<!-- content -->
			<div class="panel panel-info">
				<div class="panel-heading">
					<h2 class="panel-title">Present center detail &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
						&nbsp
						&nbsp &nbsp &nbsp &nbsp<button type="button" class="btn btn btn-info">select new center</button>
					</h2>
				</div>
				<div class="alert alert-success">
					<div class="panel-body">
						<!--  trainee display table-->
						<div style='margin-left:350px;'>
							<div class="col-lg-6">
								<form method="post">
									<table class="table table-bordered table-hover table-striped">
										<thead>
											<tr class="warning">

												<th> Old Center Name</th>

											</tr>
										</thead>
										<?php
										$query = "select * from tbl_center where id='$id'";
										$row = mysqli_query($link, $query);
										$data = mysqli_fetch_array($row);
										?>
										<tbody>
											<tr class="info">

												<td><?php echo $data["center_name"]; ?></td>

											</tr>
										</tbody>
									</table>
								</form>
							</div>
						</div>
						<div class="col-lg-12">
							<h3 class="page-header" align="center" color="red">
								<u> Edit Center</u>
							</h3>
						</div>
						<form method="post">

							<!-- add new trainee details-->
							<div style='margin-left:350px;'>
								<div class="col-lg-6">
									<!--  name-->
									<div class="form-group">
										<label>New Center name</label>
										<input class="form-control" placeholder="Name of center " name="na"
											value="<?php echo $data["center_name"]; ?>">
									</div>




									<!--update or reset button  -->
									<div class="form-group">
										<button type="submit" name="sub" class="btn btn-lg btn-primary">Update</button>
										<a href="resetedit_center.php?edi=<?php echo $data['id']; ?>">
											<button type="button" class="btn btn-lg btn-warning">Reset</button>
										</a>
									</div>
								</div>
							</div>
						</form>
						<?php
						if (isset($_POST['sub'])) {
							$a = $_POST["na"];


							$query = "update tbl_center set center_name='$a' where id='$id' ";
							$row = mysqli_query($link, $query);
							if ($row > 0) {
								echo "<script>alert(' data updated succesfully ')</script>";
								echo "<script> window.location.href='display_center.php'</script>";
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
   include "../common/footer.php";
   ?>