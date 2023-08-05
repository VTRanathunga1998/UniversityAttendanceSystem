<?php 

    session_start();

    if (!isset($_SESSION["userName"])) {
    header("Location: login/login.php");
    exit();
    }

    include_once '../../../database.php';

    if(isset($_GET['lecid'])){  
        $lecId = $_GET['lecid'];

        // To remove profile picture from serverside
        $sql = "SELECT profilePic FROM lecturer WHERE userName=?";
        try {
            if ($stmt = mysqli_prepare($connect, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $lecId);
                mysqli_stmt_execute($stmt);

                $result = $stmt->get_result(); // get the mysqli result
                $lecturer = $result->fetch_assoc();

                $filename = $lecturer['profilePic']; // replace with the path and filename of the file to be deleted

                if (file_exists($filename)) {
                    if (unlink($filename)) {
                        echo "File deleted successfully.";
                    } else {
                        echo "Error deleting file.";
                    }
                } else {
                    echo "File not found.";
                }

                // Close the statement and the database connection
                mysqli_stmt_close($stmt);


                // Remove user from database
                $sql = "DELETE FROM user WHERE userName=?";
                try {
                    if ($stmt = mysqli_prepare($connect, $sql)) {
                        mysqli_stmt_bind_param($stmt, "s", $lecId);
                        mysqli_stmt_execute($stmt);
                
                        // Close the statement and the database connection
                        mysqli_stmt_close($stmt);
                        header("Location:viewLecturer.php?showModal=true&status=success&message=Delete successful!");
                    } else {
                        throw new Exception(mysqli_error($connect));
                    }
                } catch (Exception $e) {
                    header("Location:viewLecturer.php?showModal=true&status=unsuccess&message=Delete unsuccessful! " . $e->getMessage());
                } 
            } else {
                throw new Exception(mysqli_error($connect));
            }
        } catch (Exception $e) {
            header("Location:viewLecturer.php?showModal=true&status=unsuccess&message=Delete unsuccessful! " . $e->getMessage());
        }    

                      
    } else{
        echo "None";
    }
?>



