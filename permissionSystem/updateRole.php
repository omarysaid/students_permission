<?php
include("./connection/include.php");
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'administrator') {
    header('location:index.php');
    exit;
}

function updateRole($connect,$role_id,$role,$description) {


    // Update role in the database
    $updateQuery = mysqli_query($connect, "UPDATE `role` SET `role`='$role',`description`='$description' WHERE `role`='$role'");
    if ($updateQuery) {
        return "User updated successfully.";
    } else {
        return "Failed to update role.";
    }
}

// Usage example
if (isset($_POST['update-function'])) {
     $role_id = $_GET['role_id'];
    $role = $_POST['role'];
    $description = $_POST['description'];

    $result = updateRole($connect, $role_id,$role,$description);
    if (strpos($result, 'successfully') !== false) {
        $_SESSION['success_message'] = $result;
    } else {
        $_SESSION['error_message'] = $result;
    }
    header("Location: roles.php");
    exit();
}
?>

 


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>update role </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">

</head>

<body>



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
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">Back-home</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./roles.php">Back-now</a></li>
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
                            <h4>Edit</h4>
                                <!-- Success message -->
 
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                                <div class="basic-form">
                                    <form class="form-inline" action="" method="POST">
                                    <?php
                $select_user = "select * from role where role_id = '" .$_GET['role_id']. "'";
                $result = mysqli_query($connect, $select_user);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        </div>


                        <div class="card">
                            <div class="card-header">
                            
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
    
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input name="role" value="<?php echo $row['role']; ?>" required type="text" class="form-control" placeholder="">
                                            </div>
                                             <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input name="description" value="<?php echo $row['description']; ?>" required type="text"  class="form-control" placeholder="">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>

                        
                    <?php }}?>
                       
                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">
                                        <button id="form_submit" type="submit" class="btn btn-secondary"  name="update-function" >Edit<i class="ti-arrow-right"></i></button>
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