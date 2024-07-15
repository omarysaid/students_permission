<?php
session_start();
include("./connection/include.php");

if (!isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$query = "SELECT u.user_id, u.fullName AS user_fullName,  u.email,
                 p.id, p.fullName AS permission_fullName, p.regNo, p.yearOfStudy, p.Course, p.Dept, p.School AS permission_School,
                 p.days, p.departingOn, p.returningOn, p.reasonFor, p.phoneNumber, p.date,
                 p.cForDirOfStuService, p.approveForDirOfStuService, p.approved1_at,
                 p.cForHoD, p.approveForHoD, p.approved2_at,
                 p.cForDeanOfSchl, p.approveForDeanOfSchl, p.approved3_at,
                 p.created_at
          FROM users u
          LEFT JOIN permission_tbl p ON u.fullName = p.fullName
          WHERE u.user_id = '$user_id'";

$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_fullName = $row['user_fullName'];
    $email = $row['email'];
    $regNo = $row['regNo'];
    $yearOfStudy = $row['yearOfStudy'];
    $Course = $row['Course'];
    $Dept = $row['Dept'];
    $permission_School = $row['permission_School'];
    $days = $row['days'];
    $departingOn = $row['departingOn'];
    $returningOn = $row['returningOn'];
    $reasonFor = $row['reasonFor'];
    $phoneNumber = $row['phoneNumber'];
    $date = $row['date'];
    $cForDirOfStuService = $row['cForDirOfStuService'];
    $approveForDirOfStuService = $row['approveForDirOfStuService'];
    $approved1_at = $row['approved1_at'];
    $cForHoD = $row['cForHoD'];
    $approveForHoD = $row['approveForHoD'];
    $approved2_at = $row['approved2_at'];
    $cForDeanOfSchl = $row['cForDeanOfSchl'];
    $approveForDeanOfSchl = $row['approveForDeanOfSchl'];
    $approved3_at = $row['approved3_at'];
    $created_at = $row['created_at'];
} else {
    echo "No data found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
    <style>
    .strong-black {
        color: #000;
        font-weight: bold;
    }

    .form-section {
        margin-bottom: 20px;
    }

    .form-section h5 {
        border-bottom: 1px solid #000;
        padding-bottom: 10px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control-plaintext {
        font-weight: bold;
    }

    @media print {

        /* Set page size and orientation */
        @page {
            size: A4;
            /* Set page size to A4 */
            margin: 1.5cm;
            /* Reset default margin */
            orientation: portrait;
            /* Ensure portrait orientation */
        }

        /* Reset body styles for printing */
        body {
            background: none;
            /* No background color or image */
            margin-top: 1px;
            /* Space from the top */
            padding: 50px;
            /* Padding inside the body */
        }

        /* Hide unnecessary elements */
        .header,
        .quixnav,
        .footer {
            display: none !important;
            /* Hide header, navigation, and footer */
        }

        /* Hide the print button */
        .btn-print {
            display: none;
            /* Hide print button */
        }

        /* Ensure all content is visible */
        .content-body {
            display: block !important;
            /* Display content body */
        }

        /* Center content and adjust margins */
        .container {
            margin: 0 auto;
            /* Center content horizontally */
            max-width: 100%;
            /* Ensure content fits within printable area */
        }

        /* Adjust other specific elements as needed */
    }
    </style>
</head>

<body>
    <!-- Preloader start -->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!-- Preloader end -->

    <!-- Main wrapper start -->
    <div id="main-wrapper">
        <!-- Nav header start -->

        <!-- Nav header end -->

        <!-- Header start -->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left"></div>
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
        <!-- Header end -->
        <div class="container shadow" style="margin-top:100px">
            <center> <img src="./images/logo.png" style="height:200px;"></center><br>
            <div class="row page-titles mx-0 shadow" style="background-color:#094469">
                <div class="col-sm-12 p-md-0">
                    <div class="welcome-text ">
                        <h4 style="color:white;text-align:center">Student Permission Form</h4>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <form>
                        <div class="form-section">
                            <h5>User Details</h5>

                            <div class="form-group row">
                                <label for="user_fullName" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Full Name:</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="user_fullName"
                                        value="<?php echo $user_fullName; ?>" style="color:gray">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Email:</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="email" readonly class="form-control-plaintext" id="email"
                                        value="<?php echo $email; ?>" style="color:gray">
                                </div>
                            </div>
                        </div><br>
                        <div class="form-section">
                            <h5>Permission Details</h5>


                            <div class="form-group row">
                                <label for="regNo" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Registration No</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="regNo"
                                        value="<?php echo $regNo;?>" style="color:gray">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="yearOfStudy" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Year of Study</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="yearOfStudy"
                                        value="<?php echo $yearOfStudy; ?>" style="color:gray">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Course" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Course</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="Course"
                                        value="<?php echo $Course; ?>" style="color:gray">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Dept" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Depertment</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="Dept"
                                        value="<?php echo $Dept; ?>" style="color:gray">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="days" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Days of derparting</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="days"
                                        value="<?php echo $days; ?>" style="color:gray">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="departingOn" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Departing On</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="departingOn"
                                        value="<?php echo $departingOn; ?>" style="color:gray">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="returningOn" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Returning On</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="returningOn"
                                        value="<?php echo $returningOn; ?>" style="color:gray">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="reasonFor" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Reason</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="reasonFor"
                                        value="<?php echo $reasonFor; ?>" style="color:gray">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phoneNumber" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Phone Number</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="phoneNumber"
                                        value="<?php echo $phoneNumber; ?>" style="color:gray">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="date" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Date</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="date"
                                        value="<?php echo $date; ?>" style="color:gray">
                                </div>
                            </div><br>
                            <h5>Director Of Students Confirmation</h5>
                            <div class="form-group row">
                                <label for="cForDirOfStuService" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Director Of
                                        Students Service Comment</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="cForDirOfStuService"
                                        value="<?php echo $cForDirOfStuService; ?>" style="color:gray">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="approveForDirOfStuService" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Director Of
                                        Students Service approval</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext"
                                        id="approveForDirOfStuService" value="<?php echo $approveForDirOfStuService; ?>"
                                        style="color:gray">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="approved1_at" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Date</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="approved1_at"
                                        value="<?php echo $approved1_at; ?>" style="color:gray">
                                </div>
                            </div><br>
                            <h5>Head of Department Confirmation</h5>
                            <div class="form-group row">
                                <label for="cForHoD" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Head of Depertment
                                        Comment</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="cForHoD"
                                        value="<?php echo $cForHoD; ?>" style="color: gray">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="approveForHoD" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Head of Depertent
                                        approval</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="approveForHoD"
                                        value="<?php echo $approveForHoD; ?>" style="color: gray">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="approved2_at" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Date</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="approved2_at"
                                        value="<?php echo $approved2_at; ?>" style="color: gray">
                                </div>
                            </div><br>
                            <h5>Dean of school Confirmation</h5>
                            <div class="form-group row">
                                <label for="cForDeanOfSchl" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Dean of school
                                        Comment</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="cForDeanOfSchl"
                                        value="<?php echo $cForDeanOfSchl; ?>" style="color: gray">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="approveForDeanOfSchl" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Dean of school
                                        approval</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="approveForDeanOfSchl"
                                        value="<?php echo $approveForDeanOfSchl; ?>" style="color: gray">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="approved3_at" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Date</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="approved3_at"
                                        value="<?php echo $approved3_at; ?>" style="color: gray">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="created_at" class="col-sm-2 col-form-label">
                                    <h1 style="color:gray; font-size:17px">Generated Date and time</h1>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="created_at"
                                        value="<?php echo $created_at; ?>" style="color: gray">
                                </div>
                            </div>
                        </div>
                    </form>
                    <button class="btn btn-primary btn-print" " onclick=" printDetails()">Print
                        Details</button>
                    <a href="./studentporto.php"><button class="btn btn-danger btn-print" ">Cancel</button></a> 

                </div>
            </div>
        </div>
    </div>
    <!-- Content body end -->
    </div>
    <!-- Main wrapper end -->

    <!-- Scripts -->
    <script src=" ./vendor/global/global.min.js"></script>
                            <script src="./js/quixnav-init.js"></script>
                            <script src="./js/custom.min.js"></script>
                            <script>
                            function printDetails() {
                                window.print();
                            }
                            </script>
</body>

</html>