<?php

include "../../config/config.php";
global $con;
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
global $link;
?>

<style>
      
        @media (max-width: 768px) {
            .alert{
                margin-top: 40px;
            }
        }

    </style>
<div id="page-wrapper">

    <div class="container-fluid">
        <div class="alert alert-success">
            <!-- Page Heading -->
            <div class="row">
                <!-- add new enquary button -->

                <div style='float:right;'>
                    <a href="new.php">
                        <button type="button" class="btn btn-success">Add new Course</button>
                    </a>
                </div>
                <div class="col-lg-12">
                    <h1 class="page-header" align="center">
                        Courses
                    </h1>

                </div>
            </div>
            <!-- /.enquiry detail-->
            <form method="post">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr class="btn-lg btn-primary">
                                <th>s no.</th>
                                <th> course name</th>
                                <th>Action</th>
                                <?php
                                $query = "select * from tbl_course";
                                $row = mysqli_query($link, $query);
                                $count = 1;
                                while ($data = mysqli_fetch_array($row)) {
                                    ?>



                                </tr>
                            </thead>
                            <tbody>
                                <tr class="danger">
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $data["course_name"]; ?></td>


                                    <td><a href="delete.php?xyz=<?php echo $data['id']; ?>">delete</a>/
                                        <a href="edit.php?edi=<?php echo $data['id']; ?>"> edit</a>
                                    </td>
                                </tr>


                            </tbody>
                            <?php
                            $count++;
                                }
                                ?>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php
   include("../common/footer.php");
?>
