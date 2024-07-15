<?php
session_start();
include("./connection/include.php");


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('location:index.php');
    exit; // Ensure script execution stops after redirection
}

$errors = []; // Array to store validation errors

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs
    $fullName = $_POST['fullName'];
    $indexNo = $_POST['indexNo'];
    $sleepFileName = $_FILES['sleep_file']['name'];
    $sleepFileTmpName = $_FILES['sleep_file']['tmp_name'];
    $sleepFileLocation = "./uploads/" . $sleepFileName;
    move_uploaded_file($sleepFileTmpName, $sleepFileLocation);
    $status = $_POST['status'];

  

    // Check if indexNo already exists
    $checkIndexNoQuery = mysqli_query($connect, "SELECT * FROM `resultsleep_tbl` WHERE `indexNo` = '$indexNo'");
    if (mysqli_num_rows($checkIndexNoQuery) > 0) {
        $errors[] = "Error: Index Number already taken.";
    }

    // If no errors, insert data into resultsleep_tbl
    if (empty($errors)) {
        $insertQuery = mysqli_query($connect, "INSERT INTO `resultsleep_tbl` (`fullName`, `indexNo`, `sleep_file`, `status`) VALUES ('$fullName', '$indexNo', '$sleepFileName', '$status')");

        if ($insertQuery) {
            header('Location: viewSleep.php');
            exit();
        } else {
            $errors[] = "Error creating sleep record.";
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
                    <li class="nav-label first">USERS-REGISTRATION-PANEL</li><hr>
                    <!-- <li><a href="index.html"><i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                    </li> -->
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">Back-home</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./viewSleep.php">Back-now</a></li>
                    </li>
                
                        </ul>
                    </li>
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
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Create new result-sleep</h4>
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
                    <div class="col-xl-6 col-xxl-12">
                                <div class="basic-form">
                                    <form class="form-inline" action="" method="POST" enctype="multipart/form-data">
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Form Row</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
    
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input name="fullName" required type="text" class="form-control" placeholder=" Enter fullName">
                                            </div>
                                             <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input name="indexNo" required type="text" class="form-control" placeholder="Enter index number eg. 0551.0072.2018">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Form Row</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                
                                        <div class="form-row">

                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                               <input type="file" class="form-control" name="sleep_file" placeholder="upload result sleep">
                                            </div>

                                             <div class="col-sm-6">
                                         <select type="text" name="status" class="form-control">
                                          <option value="Non">--Selct-----status--------</option>
                                    <option value="active">Active</option>
                                       <option value="inactive">Inactive</option> 
                                           </select>
</div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>
                       
                        <div class="card">
                          
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <button type="submit"  class="btn btn-primary mb-2">Create now</button>
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
