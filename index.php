<?php
session_start();
$errormsg = "";
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    $errormsg = base64_decode($msg);
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

    <title>Yuva Sakthi Academy - Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="assets/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="page-wrapper">

        <div class="container-fluid">
            <div class="alert alert-danger">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h1 class="page-header" style="text-align:center">
                            Welcome to Yuva Sakthi Academy
                        </h1>

                    </div>
                </div>
                <!-- /.row -->


                <!-- /.main content -->

                <div class="row">
                    <div style='display:flex;justify-content: center;align-items: center;'>
                        <div class="col-lg-6 col-md-8">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <h3 class="panel-title" align="center">Admin login Panel</h3>
                                </div>
                                <div class="panel-body">
                                    <form name="frm" action="pages/action.php" method="post">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input class="form-control" placeholder="please enter your id"
                                                    name="username">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input class="form-control" placeholder="please enter password"
                                                    type="password" name="passwd">
                                            </div>
                                            <div class="form-group" style='margin-left:70px;'>
                                                <button type="submit" class="btn btn btn-primary">Login</button>
                                            </div>
                                            <div class="blink">
                                                <?php echo $errormsg; ?>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="">
                                        <img src="assets/images/10.jpg" width="250px" height="200px" />
                                    </div>

                                </div>
                            </div>
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
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="assets/js/plugins/morris/raphael.min.js"></script>
    <script src="assets/js/plugins/morris/morris.min.js"></script>
    <script src="assets/js/plugins/morris/morris-data.js"></script>


</body>

</html>