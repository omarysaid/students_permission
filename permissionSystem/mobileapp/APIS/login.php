<?php
// Enable CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

session_start();
include("./connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  
    $postData = json_decode(file_get_contents("php://input"), true);

   
    if (isset($postData['email']) && isset($postData['password'])) {
        $email = $postData['email'];
        $password = md5($postData['password']);

    
        $sql = "
            SELECT u.user_id, u.fullName, u.email, p.regNo, p.yearOfStudy, p.Course, p.Dept, p.School
            FROM users u
            LEFT JOIN permission_tbl p ON u.fullName = p.fullName
            WHERE u.email='$email' AND u.password='$password'
        ";
        $result = mysqli_query($connect, $sql);
        $number = mysqli_num_rows($result);
        if ($number > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['fullName'] = $row['fullName'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['regNo'] = $row['regNo'];
            $_SESSION['yearOfStudy'] = $row['yearOfStudy'];
            $_SESSION['Course'] = $row['Course'];
            $_SESSION['Dept'] = $row['Dept'];
            $_SESSION['School'] = $row['School'];

            // Construct JSON response
            $response = array();
            $response['success'] = true;
            $response['message'] = 'Login successful';
            $response['user_id'] = $row['user_id'];
            $response['fullName'] = $row['fullName'];
            $response['email'] = $row['email'];
            $response['regNo'] = $row['regNo'];
            $response['yearOfStudy'] = $row['yearOfStudy'];
            $response['Course'] = $row['Course'];
            $response['Dept'] = $row['Dept'];
            $response['School'] = $row['School'];
            echo json_encode($response);
        } else {
            // Construct JSON response for failed login
            $response = array();
            $response['success'] = false;
            $response['message'] = 'Wrong username or password. Please try again.';
            echo json_encode($response);
        }
    } else {
        // Return error response if email or password keys are missing
        $response = array();
        $response['success'] = false;
        $response['message'] = 'Email or password missing in request.';
        echo json_encode($response);
    }
}
?>