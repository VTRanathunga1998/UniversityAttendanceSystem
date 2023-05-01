<?php 

    session_start();

    include_once '../../../database.php';

    if(isset($_GET['subCode'])){  
        $subCode = $_GET['subCode'];

        $sql = "DELETE FROM subject WHERE subCode=?";
        try {
            if ($stmt = mysqli_prepare($connect, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $subCode);
                mysqli_stmt_execute($stmt);
        
                // Close the statement and the database connection
                mysqli_stmt_close($stmt);
                header("Location:viewSubject.php?showModal=true&status=success&message=Deleted successful!");
                exit();
            } else {
                throw new Exception(mysqli_error($connect));
            }
        } catch (Exception $e) {
            header("Location:viewSubject.php?showModal=true&status=unsuccess&message=Deleted unsuccessful! " . $e->getMessage());
            exit();
        }
        
    } else{
        header("Location:viewSubject.php?showModal=true&status=unsuccess&message=Deleted unsuccessful! ");
        exit();
    }
?>