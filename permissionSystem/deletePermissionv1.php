<?php
session_start();
include("./connection/include.php");


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'directorOfstuService') {
    header('location:index.php');
    exit; // Ensure script execution stops after redirection
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs (not implemented in this example)

    $fullName = $_POST['fullName'];
    $regNo = $_POST['regNo'];

    // Delete data from resultsleep_tbl
    $deleteQuery = mysqli_query($connect, "DELETE FROM `permission_tbl` WHERE `fullName` = '$fullName' AND `regNo` = '$regNo'");

    if ($deleteQuery) {
        header('Location: aproveLevelv1.php');
        exit();
    } else {
        echo "Error deleting sleep record.";
    }
}
?>

