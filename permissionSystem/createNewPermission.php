<?php
session_start();
include("./connection/include.php");

if (!isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit();
}

$errors = []; // Array to store validation errors

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs
    $fullName = $_POST['fullName'];
    $regNo = $_POST['regNo'];
    $yearOfStudy = $_POST['yearOfStudy'];
    $Course = $_POST['Course'];
     $Dept = $_POST['Dept'];
      $School = $_POST['School'];
       $days = $_POST['days'];
        $departingOn = $_POST['departingOn'];
        $returningOn = $_POST['returningOn'];
         $reasonFor = $_POST['reasonFor'];
          $phoneNumber = $_POST['phoneNumber'];
           $date = $_POST['date'];

  

    // Check if indexNo already exists
    $checkIndexNoQuery = mysqli_query($connect, "SELECT * FROM `permission_tbl` WHERE `reasonFor` = '$reasonFor'");
    if (mysqli_num_rows($checkIndexNoQuery) > 0) {
        $errors[] = "Error: Permission already exist.";
    }

    // If no errors, insert data into request_tbl
    if (empty($errors)) {
        $insertQuery = mysqli_query($connect, "INSERT INTO `permission_tbl` (`fullName`, `regNo`,`yearOfStudy`, `Course`, `Dept`, `School`, `days`, `departingOn`, `returningOn`, `reasonFor`, `phoneNumber`,`date`) VALUES ('$fullName', '$regNo','$yearOfStudy', '$Course', '$Dept', '$School', '$days', '$departingOn', '$returningOn', '$reasonFor', '$phoneNumber', '$date')"); 

        if ($insertQuery) {
            header('Location: successMessage.php');
            exit();
        } else {
            $errors[] = "Error creating permission record.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>create permission </title>
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
            <div class="container-fluid">
                <div class="row page-titles mx-0 shadow" style="background-color:#094469">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 style="color:white">Create new application here</h4>
                            <!-- Error alert -->
                            <?php if (!empty($errors)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php foreach ($errors as $error) { ?>
                                <p><?php echo $error; ?></p>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12 shadow">
                        <div class="basic-form">
                            <form class="form-inline" action="" method="POST" enctype="multipart/form-data">
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-success">This field already filled </h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <div class="form-row">

                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <input name="fullName" required type="text" <?php 
                                          $select_all_roles = "select fullName from users  WHERE `user_id`='$_SESSION[user_id]'" or die(mysqli_error($connect));
                                          $result = mysqli_query($connect,$select_all_roles);
                                          $number = mysqli_num_rows($result);
                                             if ($number > 0) {
                                           while($row = mysqli_fetch_assoc($result)) { ?>
                                                value="<?php echo $row['fullName']; ?>" <?php } } ?>
                                                class="form-control">
                                        </div>


                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <input name="regNo" required type="text" class="form-control"
                                                placeholder="Enter registration number eg. 26990/T.2021">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <div class="basic-form">

                                    <div class="form-row">
                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <select name="yearOfStudy" required class="form-control">
                                                <option value="">--Select year of study---</option>
                                                <option value="Year-one">Year One</option>
                                                <option value="Year-two">Year Two</option>
                                                <option value="Year-three">Year Three</option>
                                                <option value="Year-four">Year Four</option>
                                                <option value="Year-five">Year Five</option>
                                            </select>

                                        </div>

                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <input name="Course" required type="text" class="form-control"
                                                placeholder=" Enter your course eg. CSN">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">

                                    <div class="form-row">
                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <select name="Dept" required class="form-control">
                                                <option value="">Select Department</option>
                                                <option value="Building Economics">Building Economics</option>
                                                <option value="Architecture">Architecture</option>
                                                <option value="Interior Design">Interior Design</option>
                                                <option value="Geospatial Sciences and Technology">Geospatial Sciences
                                                    and Technology</option>
                                                <option value="Computer Systems and Mathematics">Computer Systems and
                                                    Mathematics</option>
                                                <option value="Business Studies">Business Studies</option>
                                                <option value="Land Management and Valuation">Land Management and
                                                    Valuation</option>
                                                <option value="Civil and Environmental Engineering">Civil and
                                                    Environmental Engineering</option>
                                                <option value="Environmental Science and Management">Environmental
                                                    Science and Management</option>
                                                <option value="Urban and Regional Planning">Urban and Regional Planning
                                                </option>
                                                <option value="Economics and Social Studies">Economics and Social
                                                    Studies</option>
                                            </select>

                                        </div>

                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <select name="School" required class="form-control">
                                                <option value="">--Select School---</option>
                                                <option value="SACEM">SACEM</option>
                                                <option value="SSPSS">SSPSS</option>
                                                <option value="SERBI">SERBI</option>
                                                <option value="SEES">SEES</option>
                                                <option value="Year-five">Others</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">

                                    <div class="form-row">
                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for=""></label>
                                            <input name="days" required type="text" class="form-control"
                                                placeholder=" Enter days for permission">
                                        </div>

                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="departingOn" class="text-success">Departing on*</label>
                                            <input name="departingOn" required type="date" class="form-control"
                                                placeholder=" Enter departing On">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">

                                    <div class="form-row">
                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="returningOn" class="text-success">Returning on*</label>
                                            <input name="returningOn" required type="date" class="form-control"
                                                placeholder=" Enter returning On">
                                        </div>

                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header text-warning">Please fill your reason here</div>
                            <div class="card-body">
                                <div class="basic-form">

                                    <div class="form-row">
                                        <div class="col-sm-12 mt-2 mt-sm-0">
                                            <textarea name="reasonFor" required type="text" class="form-control"
                                                placeholder=" Enter yor reason here"></textarea>
                                        </div>

                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <div class="basic-form">

                                    <div class="form-row">

                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="returningOn" class="text-success"></label>
                                            <input type="text" class="form-control" name="phoneNumber"
                                                placeholder="Enter contact number">
                                        </div>

                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="returningOn" class="text-success">Permission date*</label>
                                            <input type="date" class="form-control" name="date"
                                                placeholder="Enter date/time for permission">
                                            <!-- Changed attribute name to "clearanceForm" -->
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card">

                            <div class="card-body">
                                <div class="basic-form">

                                    <button type="submit" class="btn btn-primary mb-2">Submit request</button>
                                    </form>
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

</body>

</html>