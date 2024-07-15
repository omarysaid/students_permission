<?php
include("./connection/include.php");
session_start(); 

function addUser($connect, $fullName, $role,$School,$Dept, $email, $password) {
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    }

    // Check if the role is selected
    if ($role == "None-user") {
        return "Please select a role.";
    }

    // Check if email already exists
    $checkEmailQuery = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email'");
    if (mysqli_num_rows($checkEmailQuery) > 0) {
        return "Email already exists.";
    }

    // Check if password already exists (optional, depends on your application logic)
    // For example, you can check the password uniqueness if needed

    // Hash the password
    $hashedPassword = md5($password);

    // Insert user into database
    $insertQuery = mysqli_query($connect, "INSERT INTO `users` (`fullName`, `role`,`School`,`Dept`, `email`, `password`) VALUES ('$fullName', '$role','$School','$Dept', '$email', '$hashedPassword')");
    if ($insertQuery) {
        return "User added successfully.";
    } else {
        return "Failed to add user.";
    }
}


// Usage example
if (isset($_POST['add-function'])) {
    // Assuming $connect is your database connection
    $fullName = $_POST['fullName'];
    $role = $_POST['role']; // Corrected name attribute
    $School =$_POST['School'];
    $Dept = $_POST['Dept'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $result = addUser($connect, $name, $role,$School,$Dept, $email, $password);
    if (strpos($result, 'successfully') !== false) {
        $_SESSION['success_message'] = $result;
    } else {
        $_SESSION['error_message'] = $result;
    }
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>User registration </title>
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
                   <br>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">Back-home</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./users.php">Back-now</a></li>
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
                            <h4>Create new user</h4>
                                <!-- Success message -->
    <?php if(isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['success_message']; ?>
    </div>
    <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <!-- Error message -->
    <?php if(isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['error_message']; ?>
    </div>
    <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>
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
                           

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
    
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input name="fullName" required type="text" class="form-control" placeholder="fullname">
                                            </div>
                                             <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input name="email" required type="text" class="form-control" placeholder="Email">
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
                                          <div class="col-sm-6">
                                         <select type="text" name="role" class="form-control">
                                          <option value="None-user">--Selct-----role--------</option>
                                           <option value="administrator">administrator</option>
                                           <option value="directorOfstuService">Director of student service</option>
                                            <option value="HOD">Head of depertment(HOD)</option>
                                           <option value="DeanOfSchl">Dean of school</option>
                                           </select>
</div>

                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                 <select type="text" name="School" class="form-control">
                                          <option value="None-user">--Select-----School--------</option>
                                           <option value="SACEM">SACEM</option>
                                           <option value="SSPSS">SSPSS</option>
                                            <option value="SERBI">SERBI</option>
                                           <option value="SEES">SEES</option>
                                           </select>
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
                                          <div class="col-sm-6">
                                         <select type="text" name="Dept" class="form-control">
                                          <option value="None">--Select-----Dept--------</option>
                                           <option value="Building-Economics"Building-Economics</option>
                                           <option value="Architecture">Architecture</option>
                                            <option value="Interior-Design">Interior-Design</option>
                                           <option value="Geospatial-Sciences and Technology">Geospatial-Sciences and Technology</option>
                                           <option value="Computer-Systems and Mathematics">Computer-Systems and Mathematics</option>
                                           <option value="Business Studies">Business Studies</option>
                                            <option value="Land-Management and Valuation">Land-Management and valuation</option>
                                             <option value="Civil and Environmental-Engineering">Civil and Environmental-Engineering</option>
                                              <option value="Environmental-Science and Management">Environmental-Science and Management</option>
                                               <option value="Urban and Regional-Planning">Urban and Regional-Planning</option>
                                                <option value="Economics and Social-Studies">Economics and Social-Studies</option>
                                                   <option value="Others">Others</option>
                                           </select>
                                          
</div>

                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input type="text" class="form-control" name="password" placeholder="password">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>

                       
                        <div class="card">
                          
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <button type="submit" name="add-function" class="btn btn-primary mb-2">Create now</button>
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