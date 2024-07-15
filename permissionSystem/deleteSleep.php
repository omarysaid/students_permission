<?php
session_start();
include("./connection/include.php");



if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('location:index.php');
    exit; // Ensure script execution stops after redirection
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs (not implemented in this example)

    $fullName = $_POST['fullName'];
    $indexNo = $_POST['indexNo'];

    // Delete data from resultsleep_tbl
    $deleteQuery = mysqli_query($connect, "DELETE FROM `resultsleep_tbl` WHERE `fullName` = '$fullName' AND `indexNo` = '$indexNo'");

    if ($deleteQuery) {
        header('Location: viewSleep.php');
        exit();
    } else {
        echo "Error deleting sleep record.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags, title, stylesheet links -->
</head>

<body>
    <!-- Header, navigation, etc. -->

    <!-- Form for deleting sleep record -->
    <form method="POST" action="">
        <input type="text" name="fullName" placeholder="Full Name" required>
        <input type="text" name="indexNo" placeholder="Index No" required>
        <button type="submit">Delete Sleep Record</button>
    </form>

    <!-- Footer, scripts, etc. -->
</body>

</html>
