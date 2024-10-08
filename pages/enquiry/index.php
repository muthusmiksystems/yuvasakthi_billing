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

<!-- </nav> -->
<style>
      
        @media (max-width: 768px) {
            .alert{
                margin-top: 40px;
            }
        }

    </style>
<div id="page-wrapper">

    <div class="container-fluid">
        <div class="alert alert-info">
            <!-- Page Heading -->
            <div class="row">
                <!-- add new enquary button -->
                <div style='float:right;'>
                    <a href="new.php">
                        <button type="button" class="btn btn-success">Add new Enquiry</button>
                    </a>
                </div>
                <div class="col-lg-12">
                    <h1 class="page-header" align="center">
                        Manage Enquiry
                    </h1>

                </div>
            </div>
            <!-- /.enquiry detail-->
            <form method="post">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr class=" btn-lg btn-info">
                                <th>s no.</th>
                                <th>name</th>
                                <th>Father name</th>
                                <th>Contact no.</th>
                                <th>Email-Id</th>
                                <th>Total fee(rs.)</th>
                                <th>course</th>
                                <th>photo</th>
                                <th>Action</th>
                                <?php
                                $query = "select * from tbl_enquiry";
                                $row = mysqli_query($link, $query);
                                $count = 1;
                                while ($data = mysqli_fetch_array($row)) {
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="danger">
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $data["name"]; ?></td>
                                    <td><?php echo $data["father_name"]; ?></td>
                                    <td><?php echo $data["contact"]; ?></td>
                                    <td><?php echo $data["email"]; ?></td>
                                    <td><?php echo $data["fee"]; ?></td>
                                    <td><?php echo $data["course"]; ?></td>
                                    <td>

                                        <img src="../../uploads/<?php echo $data["image"]; ?>" width="50px" height="50px">


                                    </td>
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
<?php
include '../common/footer.php';
?>