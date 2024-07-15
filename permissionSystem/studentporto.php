<?php
session_start();
include("./connection/include.php");
if (!isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit; // Make sure to exit after redirecting
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>STUDENT</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="./vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">



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
        <div class="nav-header" style="background-color:#094469">
            <div class="nav-control">
                <div class="hamburger" style="background-color: white;">
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
        <div class="header" style="background-color:orangered">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left" style="background-color: #094469;">
                            <div class="search_bar dropdown" style="background-color: #094469;">
                                <div class="dropdown-menu p-0 m-0" style="background-color: #094469;">
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown" style="color:white">
                                    <?php   $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `user_id`='$_SESSION[user_id]'") or die(mysqli_connect_error());
                                   $fetch = mysqli_fetch_array($query);
                                  echo "" . $fetch['email'] . " "; ?><i class="mdi mdi-account"></i>
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
        <div class="quixnav" style="background-color: #094469;">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">

                    <hr>
                    <li><a href="./studentporto.php"><i class="fa fa-home"></i><span class="nav-text">Home</span></a>
                    </li>
                    <li><a href="./resertPasswordv1a.php"><i class="fa fa-list"></i><span
                                class="nav-text">Resert-Password</span></a>
                    </li>
                    <li><a href="./createNewPermission.php"><i class="fa fa-list"></i><span class="nav-text">Apply for
                                permission</span></a>
                    </li>
                    <li><a href="./report.php"><i class="fa fa-list"></i><span class="nav-text">Report</span></a>
                    </li>
                </ul>
            </div>


        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid shadow">
                <div class="row">
                    <div class="col-lg-4 col-sm-4">
                        <div class="card" style="height:250px">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text"><b>Director Of StudentService level</b></div>

                                    <?php 
$select_all_users = "SELECT permission_tbl.id,permission_tbl.fullName,permission_tbl.regNo,permission_tbl.yearOfStudy,permission_tbl.approved1_at,permission_tbl.approveForDirOfStuService,permission_tbl.Course,permission_tbl.Dept,permission_tbl.School,permission_tbl.days,permission_tbl.departingOn,permission_tbl.returningOn,permission_tbl.reasonFor,permission_tbl.phoneNumber,permission_tbl.date,permission_tbl.cForDirOfStuService,permission_tbl.approved2_at,permission_tbl.approveForHoD,permission_tbl.cForHoD,permission_tbl.approveForDeanOfSchl,permission_tbl.approveForDeanOfSchl,permission_tbl.created_at, users.School FROM permission_tbl JOIN users ON permission_tbl.fullName = users.fullName WHERE user_id=$_SESSION[user_id] and approveForDirOfStuService='already_forwarded'";
$result = mysqli_query($connect, $select_all_users);
$number = mysqli_num_rows($result);
if ($number > 0) {
    while($row = mysqli_fetch_assoc($result)) { 
        if ($row['approveForDirOfStuService'] == 'already_forwarded') { ?>
                                    <div class="stat-digit"> <i class="fa fa-check"
                                            style="color:green;font-size:20px"></i>
                                        <?php echo $row['approveForDirOfStuService']; ?>
                                    </div>
                                    <?php }
        }
    } else { ?>
                                    <div class="stat-digit">
                                        <i class="fa fa-danger" style="color:black;font-size:30px"></i>
                                        <p style="color:black">On-Pending <i class="fas fa-spinner fa-spin"></i>
                                            Loading...
                                        <p>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-sm-4">
                        <div class="card" style="height:250px">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text"><b>HOD Level</b></div>
                                    <?php 
$select_all_users = "SELECT permission_tbl.id,permission_tbl.fullName,permission_tbl.regNo,permission_tbl.yearOfStudy,permission_tbl.approved1_at,permission_tbl.approveForDirOfStuService,permission_tbl.Course,permission_tbl.Dept,permission_tbl.School,permission_tbl.days,permission_tbl.departingOn,permission_tbl.returningOn,permission_tbl.reasonFor,permission_tbl.phoneNumber,permission_tbl.date,permission_tbl.cForDirOfStuService,permission_tbl.approved2_at,permission_tbl.approveForHoD,permission_tbl.cForHoD,permission_tbl.approveForDeanOfSchl,permission_tbl.approveForDeanOfSchl,permission_tbl.created_at, users.School FROM permission_tbl JOIN users ON permission_tbl.fullName = users.fullName WHERE user_id=$_SESSION[user_id] and approveForHoD='already_forwarded'";
$result = mysqli_query($connect, $select_all_users);
$number = mysqli_num_rows($result);
if ($number > 0) {
    while($row = mysqli_fetch_assoc($result)) { 
        if ($row['approveForHoD'] == 'already_forwarded') { ?>
                                    <div class="stat-digit"> <i class="fa fa-check"
                                            style="color:green;font-size:20px"></i>
                                        <?php echo $row['approveForHoD']; ?>
                                    </div>
                                    <?php }
        }
    } else { ?>
                                    <div class="stat-digit">
                                        <i class="fa fa-danger" style="color:black;font-size:30px"></i>
                                        <p style="color:black">On-Pending <i class="fas fa-spinner fa-spin"></i>
                                            Loading...
                                        <p>
                                    </div>
                                    <?php } ?>


                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-sm-4">
                        <div class="card" style="height:250px">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text"><b>Dean Level</b></div>
                                    <?php 
$select_all_users = "SELECT permission_tbl.id,permission_tbl.fullName,permission_tbl.regNo,permission_tbl.yearOfStudy,permission_tbl.approved1_at,permission_tbl.approveForDirOfStuService,permission_tbl.Course,permission_tbl.Dept,permission_tbl.School,permission_tbl.days,permission_tbl.departingOn,permission_tbl.returningOn,permission_tbl.reasonFor,permission_tbl.phoneNumber,permission_tbl.date,permission_tbl.cForDirOfStuService,permission_tbl.approved2_at,permission_tbl.approveForHoD,permission_tbl.cForHoD,permission_tbl.approveForDeanOfSchl,permission_tbl.approveForDeanOfSchl,permission_tbl.created_at, users.School FROM permission_tbl JOIN users ON permission_tbl.fullName = users.fullName WHERE user_id=$_SESSION[user_id] and approveForDeanOfSchl='Permission_granted'";
$result = mysqli_query($connect, $select_all_users);
$number = mysqli_num_rows($result);
if ($number > 0) {
    while($row = mysqli_fetch_assoc($result)) { 
        if ($row['approveForDeanOfSchl'] == 'Permission_granted') { ?>
                                    <div class="stat-digit"> <i class="fa fa-check"
                                            style="color:green;font-size:20px"></i>
                                        <?php echo $row['approveForDeanOfSchl']; ?>
                                    </div>
                                    <?php }
        }
    } else { ?>
                                    <div class="stat-digit">
                                        <i class="fa fa-danger" style="color:black;font-size:30px"></i>
                                        <p style="color:black">On-Pending <i class="fas fa-spinner fa-spin"></i>
                                            Loading...
                                        <p>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- /# column -->
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
    </div>
    <!--**********************************
            Content body end
        ***********************************-->




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


    <!-- Vectormap -->
    <script src="./vendor/raphael/raphael.min.js"></script>
    <script src="./vendor/morris/morris.min.js"></script>


    <script src="./vendor/circle-progress/circle-progress.min.js"></script>
    <script src="./vendor/chart.js/Chart.bundle.min.js"></script>

    <script src="./vendor/gaugeJS/dist/gauge.min.js"></script>

    <!--  flot-chart js -->
    <script src="./vendor/flot/jquery.flot.js"></script>
    <script src="./vendor/flot/jquery.flot.resize.js"></script>

    <!-- Owl Carousel -->
    <script src="./vendor/owl-carousel/js/owl.carousel.min.js"></script>

    <!-- Counter Up -->
    <script src="./vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="./vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="./vendor/jquery.counterup/jquery.counterup.min.js"></script>


    <script src="./js/dashboard/dashboard-1.js"></script>

</body>

</html>