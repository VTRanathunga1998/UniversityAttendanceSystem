<?php

session_start();

if (!isset($_SESSION["userName"])) {
  header("Location: login/login.php");
  exit();
}

include '../../../database.php';

if(isset($_GET['oldDepid'])){
    $depId = $_GET['oldDepid'];
} else {
    header("Location:viewSubject.php?calling");
    exit();
}

if(isset($_POST['updateStudent'])){
    $depID = $_POST['chooseDepID'];
    $depName = $_POST['chooseDepName'];
    $facId = $_POST['choosefacID'];
    $depUrl = $_POST['chooseDepUrll'];
    $faculty = $_POST['chooseFac'];
}

$sql = "UPDATE department SET depName=? , facID=? , depURL=? WHERE depID=?";
try {
    if ($stmt = mysqli_prepare($connect, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssss", $depName, $facId, $depUrl, $depId);
        mysqli_stmt_execute($stmt);

        // Close the statement and the database connection
        mysqli_stmt_close($stmt);
        mysqli_close($connect);

        header("Location:viewSubject.php?showModal=true&status=success&message=Subject updated successfully");
        exit();
    } else {
        throw new Exception(mysqli_error($connect));
    }
} catch (Exception $e) {
    header("Location:viewSubject.php?showModal=true&status=unsuccess&message=Update unsuccessful! " . $e->getMessage());
}               
?>        
