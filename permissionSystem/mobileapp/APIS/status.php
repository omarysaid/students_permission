<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

session_start();
include("./connection.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["fullName"])) {
        $fullName = $_GET["fullName"];
        
        // Fetch permissions based on fullName
        $select_permissions = "SELECT approveForDirOfStuService, approveForHoD, approveForDeanOfSchl 
                               FROM permission_tbl WHERE fullName = ? ORDER BY id DESC";
        $stmt_permissions = $connect->prepare($select_permissions);
        $stmt_permissions->bind_param("s", $fullName);
        
        if ($stmt_permissions->execute()) {
            $result_permissions = $stmt_permissions->get_result();
            $permissions = $result_permissions->fetch_all(MYSQLI_ASSOC);
            
            $response = array("success" => true, "permissions" => $permissions);
            echo json_encode($response);
        } else {
            $response = array("success" => false, "message" => "Error fetching permissions: " . $stmt_permissions->error);
            echo json_encode($response);
        }
        
        $stmt_permissions->close();
    } else {
        $response = array("success" => false, "message" => "Missing fullName parameter.");
        echo json_encode($response);
    }
} else {
    $response = array("success" => false, "message" => "Unsupported request method.");
    echo json_encode($response);
}

$connect->close();