<?php

$link=mysqli_connect("localhost","root","","trainee");
//mysqli_select_db("main_project",$link);
$id=$_GET["edi"];
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
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Yuva Sakthi Academy</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<?php
include 'header.php';
?>

<?php
include 'slidemenu.php';
?>
        </nav>

        <div id="page-wrapper">
<div class="alert alert-success">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" align="center">
                           <u> Present courses Duration</u>
                        </h1>
                    </div>
				</div>
          
								<!-- content -->
					<div class="panel panel-danger">
                            <div class="panel-heading">
                                <h2 class="panel-title">Present course Duration &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
								&nbsp &nbsp &nbsp &nbsp<button type="button" class="btn btn btn-info">select new Duration</button></h2>
                            </div>
						<div class="alert alert-info">
                            <div class="panel-body">
                                <!--  trainee display table-->
								<div style='margin-left:350px;'>
								<div class="col-lg-6">
								<form method="post">
									<table class="table table-bordered table-hover table-striped">
									<thead>
										<tr class="success">
											
											<th> present course Duration Type</th>
											
										</tr>
									</thead>
									<?php
										$query="select * from tbl_duration where id='$id'";
										$row=mysqli_query($link,$query);
										$data=mysqli_fetch_array($row);
									?>
									<tbody class="warning">
										<tr>
										
                                        <td><?php echo $data["course_duration"];?></td>
                                     
										</tr>
									</tbody>
									</table>
									</form>
									</div>
								</div>
										    <div class="col-lg-12">
												<h3 class="page-header" align="center" color="red">
													<u> Edit Course Duration</u>
												</h3>
											</div>
								<form method="post">
								
									<!-- add new trainee details-->
								<div style='margin-left:350px;'>
									<div class="col-lg-6">
									<!--  name-->
										<div class="form-group">
											<label>Edit prievious course Duration</label>
											<input class="form-control" placeholder="Name of center " name="na" >
										</div>
									
									
									
										
									<!--update or reset button  -->
										<div class="form-group">
											<button type="submit" name="sub" class="btn btn-lg btn-primary">Update</button>
											<a href="resetedit_duration.php?edi=<?php echo $data['id'];?>">
											<button type="button" class="btn btn-lg btn-warning">Reset</button>
											</a>
										</div>
									</div>
								</div>
								</form>
<?php
if(isset($_POST['sub']))
{
	$a=$_POST["na"];

	
$query="update tbl_duration set course_duration='$a' where id='$id' ";
$row=mysqli_query($link,$query);
if($row > 0)
{
	echo "<script>alert(' data updated succesfully ')</script>";
	echo "<script> window.location.href='display_duration.php'</script>";
}
else
{
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

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
