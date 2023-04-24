<?php 

    session_start();

    include_once '../../../database.php';

    if(isset($_GET['stdid'])){  
        $stdId = $_GET['stdid'];

        // To remove profile picture from serverside
        $sql = "SELECT profilePic FROM student WHERE userName=?";
        try {
            if ($stmt = mysqli_prepare($connect, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $stdId);
                mysqli_stmt_execute($stmt);

                $result = $stmt->get_result(); // get the mysqli result
                $student = $result->fetch_assoc();

                $filename = $student['profilePic']; // replace with the path and filename of the file to be deleted

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

                $sql = "DELETE FROM user WHERE userName=?";
                try {
                    if ($stmt = mysqli_prepare($connect, $sql)) {
                        mysqli_stmt_bind_param($stmt, "s", $stdId);
                        mysqli_stmt_execute($stmt);
                
                        // Close the statement and the database connection
                        mysqli_stmt_close($stmt);
                        unset($_SESSION['oldStdid']);
                        header("Location:viewStudent.php?showModal=true&status=success&message=Delete successful!");
                    } else {
                        throw new Exception(mysqli_error($connect));
                    }
                } catch (Exception $e) {
                    header("Location:viewStudent.php?showModal=true&status=unsuccess&message=Delete unsuccessful! " . $e->getMessage());
                }

            } else {
                throw new Exception(mysqli_error($connect));
            }
        } catch (Exception $e) {
            header("Location:viewStudent.php?showModal=true&status=unsuccess&message=Delete unsuccessful! " . $e->getMessage());
        }

        

    } else{
        echo "None";
    }
?>