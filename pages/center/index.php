<?php include ("../common/header.php"); ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="alert alert-warning">
            <!-- Page Heading -->
            <div class="row">
                <!-- add new enquary button -->

                <div style='float:right;'>
                    <a href="add_center.php">
                        <button type="button" class="btn btn-success">Add new Center</button>
                    </a>
                </div>
                <div class="col-lg-12">
                    <h1 class="page-header" align="center">
                        Manage Center
                    </h1>

                </div>
            </div>
            <!-- /.enquiry detail-->
            <form method="post">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr class="success">
                                <th>s no.</th>
                                <th> center name</th>
                                <th>Action</th>
                                <?php
                                global $link;
                                $query = "select * from tbl_center";
                                $row = mysqli_query($link, $query);
                                $count = 1;
                                while ($data = mysqli_fetch_array($row)) {
                                    ?>



                                </tr>
                            </thead>
                            <tbody>
                                <tr class="danger">
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $data["center_name"]; ?></td>


                                    <td><a href="delete_center.php?xyz=<?php echo $data['id']; ?>">delete</a>/
                                        <a href="edit_center.php?edi=<?php echo $data['id']; ?>"> edit</a>
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
   include "../common/footer.php";
   ?>