<?php
include "../../config/config.php";
global $con;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <!-- Bootstrap Core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        #table {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        .img-thumbnail {
            display: block;
            margin: auto;
        }

        @media (max-width: 768px) {
            #table {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div id="table" class="container">
        <form method="post" enctype="multipart/form-data">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">
                            <h1>SIGNUP</h1>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" placeholder="Name" name="na" class="form-control" required /></td>
                    </tr>
                    <tr>
                        <td><input type="number" placeholder="Contact No." name="cn" class="form-control" required /></td>
                    </tr>
                    <tr>
                        <td><input type="email" placeholder="Email-ID" name="em" class="form-control" required /></td>
                    </tr>
                    <tr>
                        <td><input type="password" placeholder="Password" name="pss" class="form-control" required /></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="file" name="image" class="form-control-file" />
                            <img class="img-thumbnail" src="http://placehold.it/400x400" alt="" width="50px" height="50px">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <input type="submit" name="sub" value="Sign Up" class="btn btn-primary" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <?php
    if (isset($_POST['sub'])) {
        $a = $_POST["na"];
        $c = $_POST["cn"];
        $d = $_POST["em"];
        $e = $_POST["pss"];
        $len = strlen($c);
        $tr1 = substr($a, 0, 3);
        $tr2 = substr($c, $len - 4, $len);
        $m = $tr1 . $tr2;
        // For image upload
        $img = $_FILES["image"]["name"];
        $type = $_FILES["image"]["type"];
        $size = $_FILES["image"]["size"];
        $store = $_FILES["image"]["tmp_name"];
        // Check image format
        $arr = explode('.', $img);
        $eb = end($arr);
        global $link;
        $format = array("jpg", "png", "jpeg");
        if (in_array("$eb", $format)) {
            move_uploaded_file($store, "uploads/" . $img);
            $query = "INSERT INTO tbl_admin (name, photo, contact, email, password, admin_id) VALUES ('$a', '$img', '$c', '$d', '$e', '$m')";
            $row = mysqli_query($link, $query);
            if ($row > 0) {
                echo "<script>alert('Successfully signed up')</script>";
                echo "<script>window.location.href='index.php'</script>";
            } else {
                echo "<script>alert('Error in signup')</script>";
            }
        } else {
            echo "<script>alert('Wrong image format')</script>";
        }
    }
    ?>

    <!-- jQuery and Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
