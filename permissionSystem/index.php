<?php
session_start();
include './connection/include.php';

$errorMessage = ''; // Initialize error message variable

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
  
        $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'") or die(mysqli_connect_error());
        $fetch = mysqli_fetch_array($query);
        $row = mysqli_num_rows($query);

        if ($row > 0) {
            $_SESSION['user_id'] = $fetch['user_id'];
             $_SESSION['role'] = $fetch['role'];
            $role = $fetch['role'];

            if ($role == 'administrator') {
                echo "<script>alert('You are  Successfully! login')</script>";
                echo "<script>window.location='dashboard.php'</script>";
            }  
            else if ($role == 'directorOfstuService') {
                echo "<script>alert('You are  Successfully! login')</script>";
                echo "<script>window.location='directorOfstuService.php'</script>";
            }
            
             else if ($role == 'HOD') {
                echo "<script>alert('You are  Successfully! login')</script>";
                echo "<script>window.location='HOD.php'</script>";
            }
             else if ($role == 'DeanOfSchl') {
                echo "<script>alert('You are  Successfully! login')</script>";
                echo "<script>window.location='DeanOfSchl.php'</script>";
            }
            else if ($role == '') {
                echo "<script>alert('You are  Successfully! login')</script>";
                echo "<script>window.location='studentporto.php'</script>";
            }
        } else {
            $errorMessage = "Wrong! invalid username or password";
        }
    }
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./css/style.css" rel="stylesheet">

</head>

<body class="h-100 " style="background-color: #0A2D54;">
    <div class="container-fluid" style="height:110px; background-color:orangered">
        <div class="row">
            <div class="col-md-4"><img src="./images/logo.png"
                    style="height:100px; border-radius:30px; margin-left:450px"></div>
            <div class="col-md-4">
                <center>
                    <h5
                        style="color:white; font-size:30px; font-family:Georgia, 'Times New Roman', Times, serif; margin-top:30px">
                        ARDHI
                        UNIVERSIRY</h5>
                </center>
            </div>
            <div class="col-md-4"><img src="./images/logo2.png" style="height:100px; border-radius:30px;"></div>
        </div>
    </div>
    <div class="authincation h-40 w-70" style="margin-left:240px; margin-top:30px">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content" style="border-radius:2%; height:130px; background-color:white">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <br>
                                <center>
                                    <p style="box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px">
                                    <h2 style="color:#0A2D54; font-size:25px">STUDENT EMERGENCY PERMISSION MANAGEMENT
                                        SYSTEM<b><br>

                                            </p>
                                </center>

                                <div class="auth-form">
                                    <?php if (!empty($errorMessage)) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $errorMessage; ?>
                                    </div>

                                    <?php } ?>
                                    <div style="text-align: center;"><img src="images/login.jpg" width="120px"
                                            height="100px" alt="logo" style="border-radius: 30px;"></div><br>
                                    <h4 class="mb-4 text-center" style="color:white">User Login</h4>
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" name="email" required class="form-control" value=""
                                                style="height:50px">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control" required
                                                value="" style="height:50px">
                                        </div>
                                        <div class="mt-4 mb-2 form-row d-flex justify-content-between">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="login" class="btn btn-secondary btn-block"
                                                style="background-color: orangered;">Login</button>
                                        </div>
                                    </form>
                                    <div class="mt-3 new-account">
                                        <p>Don't have an account? <a class="text-primary"
                                                href="./register.php">Register</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

</body>

</html>