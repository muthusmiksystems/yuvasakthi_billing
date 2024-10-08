<?php
session_start();
?>
<a?php
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
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="../assets/css/sb-admin.css" rel="stylesheet">

	<!-- Morris Charts CSS -->
	<link href="../assets/css/plugins/morris.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
            <!-- Brand and toggle get grouped for better mobile display -->
<?php
include './common/header.php'
?>
            
<?php
include './common/slidemenu.php';
?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
<div class="alert alert-danger">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Dashboard
                        </h1>
                         
                    </div>
                </div>
                <!-- /.row -->

                
                <!-- /.main content -->
                <?php
                                        global $baseUrl;
                                    ?>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    
                                    <div class="col-xs-9 text-left">
                                        <div class="huge">No. of Students</div>
                                        
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo $baseUrl; ?>/pages/trainee/index.php">
                                <div class="panel-footer">
                                    
                                    <span class="pull-left"><a href="<?php echo $baseUrl; ?>/pages/trainee/index.php">click here to manage trainee</a></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    
                                    <div class="col-xs-9 text-left">
                                        <div class="huge">Fees Collected</div>
                                        
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo $baseUrl; ?>/pages/course/fees.php">
                                <div class="panel-footer">
                                    <span class="pull-left"><a href="<?php echo $baseUrl; ?>/pages/course/fees.php">click here to manage fee</a></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    
                                    <div class="col-xs-9 text-left">
                                        <div class="huge">No. of Enquiry</div>
                                        
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo $baseUrl; ?>/pages/enquiry/index.php">
                                <div class="panel-footer">
                                    <span class="pull-left"><a href="<?php echo $baseUrl; ?>/pages/enquiry/index.php">click here to manage enquiry</a></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">

                                    <div class="col-xs-9 text-left">
                                        <div class="huge">Admin</div>
                                        
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo $baseUrl; ?>/pages/users/index.php.php">
                                <div class="panel-footer">
                                    <span class="pull-left"><a href="<?php echo $baseUrl; ?>/pages/admin/index.php">click here to manage admin</a></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

               
                    
                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../assets/js/plugins/morris/raphael.min.js"></script>
    <script src="../assets/js/plugins/morris/morris.min.js"></script>
    <script src="../assets/js/plugins/morris/morris-data.js"></script>

</body>

</html>
