   <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

    <?php $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';



    // Get the server name

    $host = $_SERVER['HTTP_HOST'];



    // If you're using a specific port other than 80 for HTTP or 443 for HTTPS

// Include the port number, but check to avoid default ports

    $port = $_SERVER['SERVER_PORT'];

    $portString = ($port == '80' && $scheme == 'http') || ($port == '443' && $scheme == 'https') ? '' : ':' . $port;



    // Construct the base URL

    $baseUrl = $scheme . '://' . $host . $portString;



    //echo "Base URL: " . $baseUrl; ?>



      <!-- Additional CSS for the sidebar -->

   

    <div id="wrapper">

        <!-- Sidebar Toggle Button for Small Screens -->

        <button id="sidebar-toggle" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#sidebar">

            <i class="fa fa-chevron-right ms-5"></i>

        </button>



        <!-- Sidebar -->

        <div id="sidebar" class="collapse navbar-collapse">

            <ul class="nav navbar-nav side-nav">

                <li>

                    <a href="<?php echo $baseUrl; ?>/pages/home.php"><i class="fa fa-fw fa-dashboard"></i> Home</a>

                </li>

                <li>

                    <a href="<?php echo $baseUrl; ?>/pages/course/index.php"><i class="fa fa-fw fa-desktop"></i> Courses</a>

                </li>

                <li>

                    <a href="<?php echo $baseUrl; ?>/pages/trainee/index.php"><i class="fa fa-fw fa-bar-chart-o"></i> Student</a>

                </li>

                <li>

                    <a href="<?php echo $baseUrl; ?>/pages/course/fees.php"><i class="fa fa-fw fa-table"></i> Fees</a>

                </li>

                <li>

                    <a href="<?php echo $baseUrl; ?>/pages/enquiry/index.php"><i class="fa fa-fw fa-edit"></i> Enquiry</a>

                </li>

                <li>

                    <a href="<?php echo $baseUrl; ?>/pages/admin/index.php"><i class="fa fa-fw fa-desktop"></i> Users</a>

                </li>

            </ul>

        </div>

    </div>



    <!-- Rest of your HTML -->

