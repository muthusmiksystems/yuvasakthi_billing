<?php
session_start();
include ("../common/header.php"); ?>
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
                        <button type="button" class="btn btn-success">Add new Admin</button>
                    </a>
                </div>
                <div class="col-lg-12">
                    <h1 class="page-header" align="center">
                        Manage Admin
                    </h1>

                </div>
            </div>
            <!-- /.enquiry detail-->
            <form method="post">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr class="danger">
                                <th>s no.</th>
                                <th>name</th>
                                <th>admin id</th>
                                <th>Contact no.</th>
                                <th>Email-Id</th>
                                <th>photo</th>
                                <th>Action</th>
                                <?php
                                $query = "select * from tbl_admin";
                                $row = mysqli_query($link, $query);
                                $count = 1;
                                while ($data = mysqli_fetch_array($row)) {
                                    ?>



                                </tr>
                            </thead>
                            <tbody>
                                <tr class="warning">
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $data["name"]; ?></td>
                                    <td><?php echo $data["admin_id"]; ?></td>
                                    <td><?php echo $data["contact"]; ?></td>
                                    <td><?php echo $data["email"]; ?></td>
                                    <td><img src="uploads/<?php echo $data["photo"]; ?>" width="50px" height="50px" /></td>

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

<?php include "../common/footer.php"; ?>