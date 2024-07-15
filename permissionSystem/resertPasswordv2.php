<?php
include("./connection/include.php");
session_start(); 

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'HOD') {
    header('location:index.php');
    exit; // Ensure script execution stops after redirection
}


if (isset($_POST['resert-function'])) {
    $email = $_POST['email'];
    $oldPassword = md5($_POST['old-password']);
    $newPassword = md5($_POST['new-password']);

    // Validate inputs (you can add more validation as needed)
    if (empty($email) || empty($oldPassword) || empty($newPassword)) {
        $errorMessage = "Please fill in all fields.";
    } else {
        // Check if the provided email and old password match an existing user
        $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$oldPassword'");
        $row = mysqli_fetch_assoc($query);

        if ($row) {
            // Update password with the new one
            $updateQuery = mysqli_query($connect, "UPDATE `users` SET `password` = '$newPassword' WHERE `email` = '$email'");
            if ($updateQuery) {
                $successMessage = "Password resert successfully.";
            } else {
                $errorMessage = "Failed to reset password. Please try again.";
            }
        } else {
            $errorMessage = "Invalid email or old password.";
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
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
            
                    <hr>
                    <li><a  href="./HOD.php"><i
                                class="fa fa-home"></i><span class="nav-text">Home</span></a>
                    </li>
                    <li><a  href="./resertPasswordv2.php"><i
                                class="fa fa-list"></i><span class="nav-text">Resert-Password</span></a>
                    </li>
            
            <li><a  href="./approveLevelv2.php"><i
                class="fa fa-list"></i><span class="nav-text">Permissions</span></a>
    </li>

        <li><a  href="./approvedPermissionV2.php"><i
                class="fa fa-list"></i><span class="nav-text">Sent</span></a>
    </li>

     <li><a href="./approvedPermissionV7.php"><i
                class="fa fa-list"></i><span class="nav-text">Granted</span></a>
    </li>

  <li><a  href="./approvedPermissionV8.php"><i
                class="fa fa-list"></i><span class="nav-text">Not granted</span></a>
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
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Resert Password </h4>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                                <div class="basic-form">
                                    <form class="form-inline" action="" method="POST">
                        </div>


                        <div class="card">
                            <div class="card-header">
                    <?php if (isset($errorMessage)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php } ?>
            <?php if (isset($successMessage)) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $successMessage; ?>
                </div>
            <?php } ?>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
    
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input name="email" type="text" class="form-control" placeholder="Email">
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
                                            <div class="col-sm-6">
                                                <input type="text" name="old-password" class="form-control" placeholder="Old Password">
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input type="text" class="form-control" name="new-password" placeholder="New password">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>
                       
                        <div class="card">
                          
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <button type="submit" name="resert-function" class="btn btn-primary mb-2">resert now</button>
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