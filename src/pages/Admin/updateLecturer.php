<?php

session_start();

if (!isset($_SESSION["userName"])) {
  header("Location: login/login.php");
  exit();
};

include '../../../database.php';

if(isset($_SESSION['oldLecid'])){
    $preLecId = $_SESSION['oldLecid'];
    unset($_SESSION['oldLecid']);
} else {
    header("Location:viewLecturer.php?showModal=true&status=unsuccess&message=Lecturer not found");
    exit();
}

if(isset($_POST['updateLecturer'])){
    $lecID = $_POST['chooseLecID'];
    $firstName = $_POST['chooseFirstName'];
    $lastName = $_POST['chooseLastName'];
    $gender = $_POST['chooseGender'];
    $faculty = $_POST['chooseFac'];
    $department = $_POST['chooseDep'];
    $nic = $_POST['chooseNIC'];
    $email = $_POST['chooseMail'];
    $departmentName = '';
    $facultyName = '';
    $role = "Lecturer";
    if(isset($_POST['chooseMobile'])){
        $mobileNum = $_POST['chooseMobile'];
    }else{
        $mobileNum = '';
    }
    $lecImage = null;

    if (isset($_FILES['lecPic']) && $_FILES['lecPic']['error'] == 0) {
        // User has uploaded an image
        $allowedTypes = array('jpg', 'jpeg', 'png');
        $fileType = pathinfo($_FILES['lecPic']['name'], PATHINFO_EXTENSION);
    
        if (in_array($fileType, $allowedTypes)) {
            $fileName = time() . '_' . uniqid() . '_' . $_FILES['lecPic']['name'];
            $tempName = $_FILES['lecPic']['tmp_name'];
            $fileSize = $_FILES['lecPic']['size'];
            $uploadDirectory = '../../Assets/uploads/Lecturer/';
            $uploadPath = $uploadDirectory . $fileName;
    
            if (move_uploaded_file($tempName, $uploadPath)) {
                // Image has been successfully uploaded
                $lecImage = $uploadPath;
            } else {
                // Error uploading the image
                header("Location:viewLecturer.php?showModal=true&status=unsuccess&message=Error uploading image");
                exit();
            }
        } else {
            // Unsupported file type
            header("Location:viewLecturer.php?showModal=true&status=unsuccess&message=Unsupported file type");
            exit();
        }
    }
}

// To remove profile picture from serverside
$sql = "SELECT profilePic FROM lecturer WHERE userName=?";
try {
    if ($stmt = mysqli_prepare($connect, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $preLecId);
        mysqli_stmt_execute($stmt);

        $result = $stmt->get_result(); // get the mysqli result
        $lecturer = $result->fetch_assoc();

        $filename = $lecturer['profilePic']; // replace with the path and filename of the file to be deleted

        // Close the statement and the database connection
        mysqli_stmt_close($stmt);

    } else {
        throw new Exception(mysqli_error($connect));
    }
} catch (Exception $e) {
    header("Location:viewStudent.php?showModal=true&status=unsuccess&message=Update unsuccessful! " . $e->getMessage());
}


$sql = "SELECT faculty.facName,department.depName FROM faculty INNER JOIN department ON department.facID = faculty.facID WHERE department.depID = ?";

try{
    if ($stmt = mysqli_prepare($connect, $sql)) {

        mysqli_stmt_bind_param($stmt, "s", $department);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) == 1){
            while($row = mysqli_fetch_assoc($result)){  

                $facultyName = $row['facName'];
                $departmentName = $row['depName']; 

                $sql = "UPDATE user SET userName=? WHERE userName=?";
                try {
                    if ($stmt = mysqli_prepare($connect, $sql)) {
                        mysqli_stmt_bind_param($stmt, "ss", $lecID, $preLecId);
                        mysqli_stmt_execute($stmt);
                
                        // Close the statement and the database connection
                        mysqli_stmt_close($stmt);

                        $sql = "UPDATE lecturer SET lecturerID=?, firstName=?, lastName=?, gender=?, nic=?, department=?, faculty=?, email=?, mobileNum=?, profilePic=? WHERE userName=?";

                        try {
                            if ($stmt = mysqli_prepare($connect, $sql)) {
                                mysqli_stmt_bind_param($stmt, "sssssssssss", $lecID, $firstName, $lastName, $gender, $nic, $departmentName, $facultyName, $email, $mobileNum, $lecImage, $lecID);
                                mysqli_stmt_execute($stmt);

                                if(mysqli_stmt_execute($stmt)){
                                    if (file_exists($filename)) {
                                        if (unlink($filename)) {
                                            echo "File deleted successfully.";
                                        } else {
                                            echo "Error deleting file.";
                                        }
                                    } else {
                                        echo "File not found.";
                                    }
                                }
                        
                                // Close the statement and the database connection
                                mysqli_stmt_close($stmt);
                                mysqli_close($connect);
                        
                                header("Location:viewLecturer.php?showModal=true&status=success&message=Lecturer updated successfully");
                                exit;
                            } else {
                                throw new Exception(mysqli_error($connect));
                            }
                        } catch (Exception $e) {
                            header("Location:viewLecturer.php?showModal=true&status=unsuccess&message=Update unsuccessful! " . $e->getMessage());
                            exit;
                        }
                
                    } else {
                        throw new Exception(mysqli_error($connect));
                    }
                } catch (Exception $e) {
                    header("Location:viewLecturer.php?showModal=true&status=unsuccess&message=Update unsuccessful! " . $e->getMessage());
                }

                
   
            }
        }else {
            throw new Exception(mysqli_error($connect));
        }
    }else {
        throw new Exception(mysqli_error($connect));
    }           
}catch (Exception $e) {
    header("Location:viewLecturer.php?showModal=true&status=unsuccess&message=Added unsuccess! " . $e->getMessage());
}              
?>        
