<?php
session_start();
include("./connection/include.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'DeanOfSchl') {
    header('location:index.php');
    exit; // Ensure script execution stops after redirection
}

//sent request logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if ID is provided
    if (isset($_POST['id'])) {
        // Sanitize input to prevent SQL injection
        $id = mysqli_real_escape_string($connect, $_POST['id']);
        $cForDeanOfSchl = mysqli_real_escape_string($connect, $_POST['cForDeanOfSchl']);
        $approveForDeanOfSchl = mysqli_real_escape_string($connect, $_POST['approveForDeanOfSchl']);
        $approved3_at = mysqli_real_escape_string($connect, $_POST['approved3_at']);

        // Check if student is already approved
        $check_query = "SELECT approveForDeanOfSchl FROM permission_tbl WHERE id = $id";
        $check_result = mysqli_query($connect, $check_query);
        $row = mysqli_fetch_assoc($check_result);
        if ($row['approveForDeanOfSchl'] === 'Permissioned_granted') {
            echo "<script>alert('permission already approved.');</script>";
        } else {
            // Update the request details in the database
            $query = "UPDATE `permission_tbl` SET cForDeanOfSchl='$cForDeanOfSchl', approveForDeanOfSchl='$approveForDeanOfSchl',  approved3_at='$approved3_at' WHERE id=$id";

            if (mysqli_query($connect, $query)) {
                // Redirect to the page where the request details are displayed
                header("Location: approvedPermissionV3.php?id=$id");
                exit();
            } else {
                echo "Error updating record: " . mysqli_error($connect);
            }
        }
    } else {
        echo "ID not provided.";
    }
} else {
    echo "Invalid request method.";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>approve panel </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">

</head>

<body>

    <!-- Main wrapper start -->
    <div id="main-wrapper">

        <!-- Nav header start -->
        <div class="nav-header">
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
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

        <!-- Sidebar start -->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <hr>
                    <li><a href="./DeanOfSchl.php"><i
                                class="fa fa-home"></i><span class="nav-text">Home</span></a>
                    </li>
                    <li><a href="./resertPasswordv3.php"><i
                                class="fa fa-list"></i><span class="nav-text">Resert-Password</span></a>
                    </li>

            
            <li><a  href="./approveLevelv3.php"><i
                class="fa fa-list"></i><span class="nav-text">Approve-permission</span></a>
    </li>

        <li><a  href="./approvedPermissionV3.php"><i
                class="fa fa-list"></i><span class="nav-text">Granted</span></a>
    </li>

    <li><a  href="./approvedPermissionV4.php"><i
                class="fa fa-list"></i><span class="nav-text">Not granted</span></a>

    </li>

                </ul>
            </div>


        </div>
        <!-- Sidebar end -->

        <!-- Content body start -->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Student permission detail</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                // Check if the request ID is provided in the URL
                                if (isset($_GET['id'])) {
                                    $request_id = $_GET['id'];

                                    // Fetch the details of the request from the database
                                    $query = mysqli_query($connect, "SELECT * FROM `permission_tbl` WHERE id = $request_id");
                                    $request = mysqli_fetch_assoc($query);

                                    // Display the details
                                    if ($request) {
                                        // Display request details here
                                ?>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $request_id; ?>">
                                            <div class="form-group">
                                                <label for="fullName">Full Name</label>
                                                <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo $request['fullName']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="indexNo">Registration Number</label>
                                                <input type="text" class="form-control" id="regNo" name="regNo" value="<?php echo $request['regNo']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="sleep_file">Year Of Study</label>
                                                <input type="text" class="form-control" id="yearOfStudy" name="yearOfStudy" value="<?php echo $request['yearOfStudy']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="status">Course Taken</label>
                                                <input type="text" class="form-control" id="Course" name="Course" value="<?php echo $request['Course']; ?>">
                                            </div>

                                             <div class="form-group">
                                                <label for="status">Department</label>
                                                <input type="text" class="form-control" id="Dept" name="Dept" value="<?php echo $request['Dept']; ?>">
                                            </div>

                                             <div class="form-group">
                                                <label for="status">School</label>
                                                <input type="text" class="form-control" id="School" name="School" value="<?php echo $request['School']; ?>">
                                            </div>
                                             <div class="form-group">
                                                <label for="status">Days taken</label>
                                                <input type="text" class="form-control" id="days" name="days" value="<?php echo $request['days']; ?>">
                                            </div>
                                             <div class="form-group">
                                                <label for="status">Departing-On</label>
                                                <input type="text" class="form-control" id="departingOn" name="departingOn" value="<?php echo $request['departingOn']; ?>">
                                            </div>
                                             <div class="form-group">
                                                <label for="status">Returning-On</label>
                                                <input type="text" class="form-control" id="returningOn" name="returningOn" value="<?php echo $request['returningOn']; ?>">
                                            </div>
                                             <div class="form-group">
                                                <label for="status">Reason for-permission</label>
                                                <input type="text" class="form-control" id="reasonFor" name="reasonFor" value="<?php echo $request['reasonFor']; ?>" Style="height:100px">
                                            </div>

                                             <div class="form-group">
                                                <label for="status">Phone Number</label>
                                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $request['phoneNumber']; ?>">
                                            </div>

                                             <div class="form-group">
                                                <label for="status">Permissioned AT</label>
                                                <input type="text" class="form-control" id="date" name="date" value="<?php echo $request['date']; ?>">
                                            </div>
                                              <br>
                                              <div class="form-group">
                                                <label for="status">Comments by the Director of Student Service</label>
                                                <input type="text" class="form-control" id="cForDirOfStuService" name="cForDirOfStuService" value="<?php echo $request['cForDirOfStuService']; ?>" Style="height:100px">
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Comments by Head Of Department</label>
                                                <input type="text" class="form-control" id="cForHoD" name="cForHoD" value="<?php echo $request['cForHoD']; ?>" Style="height:100px">
                                            </div>
                                               <hr>
                                               <p style="color:red"><b>Comment by Dean of School</b></p><b>
                                                
                                                <div class="form-group">
                                                <label for="status">Comment</label>
                                                <input type="text" class="form-control" id="cForDeanOfSchl" name="cForDeanOfSchl" value="" Style="height:100px">
                                            </div>

                                    
                                            <div class="form-group">
                                                <label for="approveForHoD">Grant Permission</label>
                                                <select type="text"  name="approveForDeanOfSchl" class="form-control" id="approveForDeanOfSchl" >
                                           <option value="None">--Select-----to---grant----</option>
                                              <option value="Permission_granted">Permission-granted</option>
                                       <option value="Not-approved">Not-granted</option> 
                                           </select>
                                            </div>

                                             <div class="form-group">
                                                <label for="status">Approved AT AT</label>
                                                <input type="date" class="form-control" id="approved3_at" name="approved3_at" value="approved2_at">
                                            </div>

                                            <button type="submit" class="btn btn-primary">Grant</button>
                                             <span><button class="btn btn-danger btn-sm"><a href="./approveLevelv3.php" style="color:white">Cancel</a></button></span>
                                        </form>
                                <?php
                                    } else {
                                        echo "<p>Request not found.</p>";
                                    }
                                } else {
                                    echo "<p>Request ID not provided.</p>";
                                }
                                ?>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content body end -->

    </div>
    <!-- Main wrapper end -->

    <!-- Scripts -->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

</body>

</html>
