<?php

session_start();

include '../../../database.php';

if(isset($_GET['subCode'])){
    $subCode = $_GET['subCode'];
} else {
    header("Location:viewSubject.php?calling");
    exit();
}

if(isset($_POST['updateStudent'])){
    $subID = $_POST['chooseSubID'];
    $subName = $_POST['chooseSubName'];
    $faculty = $_POST['chooseFac'];
    $department = $_POST['chooseDep'];
    $semester = $_POST['chooseSem'];
}

$sql = "UPDATE subject SET subCode=? , subName=? , semester=? , depID=? WHERE subCode=?";
try {
    if ($stmt = mysqli_prepare($connect, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssss", $subID, $subName, $semester, $department, $subCode);
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
