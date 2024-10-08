<?php

include "../../config/config.php";
global $con;
////mysqli_select_db("main_project",$link);
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
include '../common/header.php'
    ?>

<style>
    @media (max-width: 768px) {
        .alert {
            margin-top: 40px;
        }
    }
</style>
<div id="page-wrapper">

    <div class="container-fluid">
        <div class="alert alert-success">
            <!-- Page Heading -->
            <div class="row">

                <div style='float:right;'>
                    <a href="new.php">
                        <button type="button" class="btn btn-success">New Student</button>
                    </a>
                    <a href="../import.php">
                        <button type="button" class="btn btn-success">Import Excel</button>
                    </a>
                </div>
                <div class="col-lg-6">
                    <h1 class="page-header" align="center">
                        List of Students
                    </h1>

                </div>
            </div>
            <!-- /.enquiry detail-->

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr class="btn-lg btn-warning">
                            <th>sno</th>
                            <th>Student name</th>
                            <th>Father name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Total fees</th>
                            <th>course</th>
                            <th>photo</th>
                            <th>Payment</th>
                            <th>Action</th>
                            <?php
                            $query = "select * from tbl_trainee";
                            $row = mysqli_query($link, $query);
                            $count = 1;
                            global $baseUrl;
                            while ($data = mysqli_fetch_array($row)) {
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="success">
                                <td><?php echo $count ?></td>
                                <td><?php echo $data["name"]; ?></td>
                                <td><?php echo $data["father_name"]; ?></td>
                                <td><?php echo $data["contact"]; ?></td>
                                <td><?php echo $data["email"]; ?></td>
                                <td style="text-align:right"><?php echo $data["fee"]; ?></td>
                                <td><?php echo $data["course"]; ?></td>
                                <td>

                                    <img src="../../uploads/<?php echo $data["image"]; ?>" width="50px" height="50px">

                                </td>
                                <td>
                                    <?php if ($data['feestatus'] == 0) { ?>
                                        <a
                                            href="<?php echo $baseUrl; ?>/pages/course/fees.php?tid=<?php echo $data['trainee_id']; ?>"><button
                                                onclick="">Pending</button></a>
                                    <?php }
                                    else {
                                    ?>
                                    <h6> Completed </h6>
                                    <?php } ?>
                                </td>
                                <td><a href="delete.php?id=<?php echo $data['id']; ?>">delete</a>/
                                    <a href="edit.php?id=<?php echo $data['id']; ?>"> edit</a>
                                </td>
                            </tr>


                        </tbody>
                        <?php
                        $count++;
                            }
                            ?>
                </table>
            </div>

        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->#page-wrapper
<?php
include "../common/footer.php";
?>