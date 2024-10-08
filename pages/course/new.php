<?php
include_once '../sqlquery.php';
$connection = new abc();
$table = "tbl_course";
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
            <form method="post">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <u>
                            <h1 class="page-header" ALIGN="CENTER">
                                ADD NEW COURSE
                            </h1>
                        </u>
                    </div>
                </div>
                <!-- /ADD TRAINEE DETAIL -->
                <div style='display:flex;justify-content: center;align-items: center;'>
                    <div class="col-lg-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Add new Course</h3>
                            </div>
                            <div class="panel-body">


                                <!--  name-->

                                <div class="form-group">
                                    <label>Course_name</label>
                                    <input class="form-control" placeholder="Enter the name of new course" name="cou">
                                </div>


                                <!--update or reset button  -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary" name="sub">Add Course</button>
                                    &nbsp &nbsp &nbsp &nbsp &nbsp
                                    <a href="add_course.php"> <button type="button"
                                            class="btn btn-lg btn-warning">Reset</button></a>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <?php
            if (isset($_POST['sub'])) {
                $a = $_POST["cou"];
                $result = $connection->add_course($table, $a);
                if ($result > 0) {
                    echo "<script>alert(' new course is succesfully added ')</script>";
                    echo "<script> window.location.href='index.php'</script>";
                } else {
                    echo "<script>alert('error')</script>";
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
include '../common/footer.php';
?>