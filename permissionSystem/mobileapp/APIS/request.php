<?php
// Enable CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

session_start();
include("./connection.php");

$permissionAddStatus = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $postData = json_decode(file_get_contents("php://input"), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        $response = array('status' => 'error', 'message' => 'Invalid JSON data');
        echo json_encode($response);
        exit();
    }

    $fullName = $postData['fullName'];
    $regNo = $postData['regNo'];
    $yearOfStudy = $postData['yearOfStudy'];
    $Course = $postData['Course'];
    $Dept = $postData['Dept'];
    $School = $postData['School'];
    $days = $postData['days'];
    $departingOn = $postData['departingOn'];
    $returningOn = $postData['returningOn'];
    $reasonFor = $postData['reasonFor'];
    $phoneNumber = $postData['phoneNumber'];
    $date = $postData['date'];

    $sql = "INSERT INTO permission_tbl (fullName, regNo, yearOfStudy, Course, Dept, School, days, departingOn, returningOn, reasonFor, phoneNumber, date) 
            VALUES ('$fullName', '$regNo', '$yearOfStudy', '$Course', '$Dept', '$School', '$days', '$departingOn', '$returningOn', '$reasonFor', '$phoneNumber', '$date')";

    if (mysqli_query($connect, $sql)) {
        $permissionAddStatus = "Permission request registered successfully";
        echo json_encode(["status" => "success", "message" => $permissionAddStatus]);
    } else {
        $permissionAddStatus = "Error occurred while adding permission request";
        echo json_encode(["status" => "error", "message" => $permissionAddStatus]);
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    echo json_encode($response);
}

mysqli_close($connect);
?>