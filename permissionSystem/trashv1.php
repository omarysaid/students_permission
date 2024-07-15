<?php
session_start();
include("./connection/include.php");

if (!isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Resert password </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">


            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">

                        </div>

                        <ul class="navbar-nav header-right">

                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">

                                    <a href="./logout.php" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav" style="background-color:#11517c;">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">RUEST byId</li><hr>
                    <!-- <li><a href="index.html"><i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                    </li> -->
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">Back-home</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./allRequets.php">Back-now</a></li>
                    </li>

                        </ul>
                    </li>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!-- Content body start -->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Request Details</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                // Check if the request ID is provided in the URL
                                if (isset($_GET['id'])) {
                                    $request_id = $_GET['id'];

                                    // Fetch the details of the request from the database
                                    $query = mysqli_query($connect, "SELECT * FROM `resultsleep_tbl` WHERE id = $request_id");
                                    $request = mysqli_fetch_assoc($query);

                                    // Display the details
                                    if ($request) {
                                        // Display request details here
                                        echo "<p style='color:teal'><b>Full Name:</b> " . $request['fullName'] . "</p>";
                                     echo "<p style='color:teal'><b>Wented AT: </b>" . $request['sleep_file'] . "</p>";
                                       echo "<p style='color:teal'><b>Index No:</b> " . $request['indexNo'] . "</p>";
                                        echo "<p style='color:teal'><b>Wented AT: </b>" . $request['status'] . "</p>";
                                         echo "<p style='color:teal'><b>Wented AT: </b>" . $request['approved'] . "</p>";
                                 echo "<p style='color:teal'><b>Clearance Form:</b> " . $request['clearanceForm'] . "</p>";
                                    } else {
                                        echo "<p>Request not found.</p>";
                                    }
                                } else {
                                    echo "<p>Request ID not provided.</p>";
                                }
                                ?>
                                <hr>
                                 <form action="downloadSleepv1.php" method="POST" style="display: inline;">
                                                            <input type="hidden" name="fullName" value="<?php echo $result['fullName']; ?>">
                                                            <input type="hidden" name="indexNo" value="<?php echo $result['indexNo']; ?>">
                                                            <button type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-download"></i></button>
                                                        </form>
                                <span><button class="btb btn-success btn-sm"><a href="./viewSleep.php" style="color:white">Approve</a></button><button class="btb btn-danger btn-sm"><a href="./allRequets.php" style="color:white">Cancel</a></button></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content body end -->



    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

</body>

</html>
