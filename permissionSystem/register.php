<?php
include("./connection/include.php");
session_start(); 

function signUpUser($connect, $fullName, $email, $password) {
    // Initialize validation messages
    $validationErrors = array();

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validationErrors[] = "Invalid email format.";
    }

    // Validate password strength
    if (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[A-Z]+#", $password)) {
        $validationErrors[] = "Password should be at least 8 characters long and contain at least one number and one uppercase letter.";
    }

    // Check if there are any validation errors
    if (!empty($validationErrors)) {
        return $validationErrors;
    }

    // Hash the password
    $hashedPassword = md5($password);
    $confirmPassword = md5($_POST['conf-password']); // New line to get confirm password

    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
        $errorMessage = "Password and Confirm Password do not match";
    } 

    // Insert user into database
    $insertQuery = mysqli_query($connect, "INSERT INTO `users` (`fullName`, `email`, `password`) VALUES ('$fullName', '$email', '$hashedPassword')");
    if ($insertQuery) {
        return "You are successfully create account.";
    } else {
        return "Failed to add user.";
    }
}

// Initialize $result variable
$result = '';

// Usage example
if (isset($_POST['signup'])) {
    // Assuming $connect is your database connection
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = signUpUser($connect, $fullName, $email, $password);
}

// Now $result is defined, you can safely check and use it
$errorMessages = '';
if (is_array($result)) {
    // If result is an array, it contains validation errors
    $errorMessages = implode("<br>", $result);
} else {
    // If result is a string, it contains success or failure message
    $errorMessages = $result;
}

?>


<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Registration panel </title>
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

                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">

                                <div style="text-align: center;"><img src="images/login.jpg" width="120px"
                                        height="100px" alt="logo" style="border-radius: 30px;"></div><br>
                                <h4 class="mb-4 text-center" style="color:white">User Registration</h4>
                                <?php if(isset($errorMessages)): ?>
                                <?php echo 
                                        $errorMessages
                                    ?>

                                <?php endif; ?>

                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label><strong>FullName</strong></label>
                                        <input type="text" name="fullName" required class="form-control" placeholder=""
                                            style="height:50px">
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Email</strong></label>
                                        <input type="email" class="form-control" required name="email" placeholder=""
                                            style="height:50px">
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Password</strong></label>
                                        <input type="password" class="form-control" name="password" required value=""
                                            placeholder="" style="height:50px">
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Confirm-Password</strong></label>
                                        <input type="password" name="conf-password" class="form-control" required
                                            value="" style="height:50px">
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" name="signup" class="btn btn-secondary btn-block"
                                            style="background-color: orangered;">Register</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>Already have an account? <a class="text-primary" href="index.php">Login</a>
                                    </p>
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
    <!--endRemoveIf(production)-->
</body>

</html>