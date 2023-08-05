<?php 

    session_start();

    if (!isset($_SESSION["userName"])) {
    header("Location: login/login.php");
    exit();
    }

    include_once '../../../database.php';

    if(isset($_GET['batch'])){  
        $batch = $_GET['batch'];

        $sql = "DELETE FROM batch WHERE batch=?";
        try {
            if ($stmt = mysqli_prepare($connect, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $batch);
                mysqli_stmt_execute($stmt);
        
                // Close the statement and the database connection
                mysqli_stmt_close($stmt);
                unset($_SESSION['oldStdid']);
                header("Location:viewBatch.php?showModal=true&status=success&message=Delete successful!");
            } else {
                throw new Exception(mysqli_error($connect));
            }
        } catch (Exception $e) {
            header("Location:viewBatch.php?showModal=true&status=unsuccess&message=Delete unsuccessful! " . $e->getMessage());
        }
    }
?>