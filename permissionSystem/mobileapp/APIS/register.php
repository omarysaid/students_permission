<?php
// Enable CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

session_start();
include("./connection.php");

// Initialize variable to hold role addition status
$userAddStatus = "";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fetch POST data
    $postData = json_decode(file_get_contents("php://input"), true);

    $fullName = $postData['fullName'];
    $email = $postData['email'];
    $password = md5($postData['password']); // Using MD5 for password hashing
  

    // Insert user into database
    $insert_new = "INSERT INTO users (fullName, email, password) 
                        VALUES ('$fullName','$email', '$password')";

    if (mysqli_query($connect, $insert_new)) {
        // Set success message
        $userAddStatus = " registered successfully";
        echo json_encode(["status" => "success", "message" => $userAddStatus]);
    } else {
        // Set error message
        $userAddStatus = "Error occurred while adding user";
        echo json_encode(["status" => "error", "message" => $userAddStatus]);
    }
}