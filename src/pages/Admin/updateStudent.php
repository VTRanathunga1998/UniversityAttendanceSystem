<?php

session_start();

include '../../../database.php';

if(isset($_SESSION['oldStdid'])){
    $preLecId = $_SESSION['oldStdid'];
    unset($_SESSION['oldStdid']);
} else {
    header("Location:viewStudent.php?showModal=true&status=unsuccess&message=Student not found");
    exit();
}

if(isset($_POST['updateStudent'])){
    $stdID = $_POST['chooseLecID'];
    $firstName = $_POST['chooseFirstName'];
    $lastName = $_POST['chooseLastName'];
    $gender = $_POST['chooseGender'];
    $faculty = $_POST['chooseFac'];
    $department = $_POST['chooseDep'];
    $nic = $_POST['chooseNIC'];
    $email = $_POST['chooseMail'];
    $departmentName = '';
    $facultyName = '';
    $batch = $_POSt['chooseBatch'];
    $role = "Student";
    if(isset($_POST['chooseMobile'])){
        $mobileNum = $_POST['chooseMobile'];
    }else{
        $mobileNum = '';
    }
    $lecImage = '';

    if (isset($_FILES['stdPic']) && $_FILES['stdPic']['error'] == 0) {
        // User has uploaded an image
        $allowedTypes = array('jpg', 'jpeg', 'png');
        $fileType = pathinfo($_FILES['stdPic']['name'], PATHINFO_EXTENSION);
    
        if (in_array($fileType, $allowedTypes)) {
            $fileName = time() . '_' . uniqid() . '_' . $_FILES['stdPic']['name'];
            $tempName = $_FILES['stdPic']['tmp_name'];
            $fileSize = $_FILES['stdPic']['size'];
            $uploadDirectory = '../../Assets/uploads/Student/';
            $uploadPath = $uploadDirectory . $fileName;
    
            if (move_uploaded_file($tempName, $uploadPath)) {
                // Image has been successfully uploaded
                $lecImage = $uploadPath;
            } else {
                // Error uploading the image
                header("Location:viewStudent.php?showModal=true&status=unsuccess&message=Error uploading image");
                exit();
            }
        } else {
            // Unsupported file type
            header("Location:viewStudent.php?showModal=true&status=unsuccess&message=Unsupported file type");
            exit();
        }
    } else {
        // File error
        header("Location:viewStudent.php?showModal=true&status=unsuccess&message=File error");
        exit();
    }
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

                $sql = "UPDATE user SET userName=? WHERE userName=? AND role='Student' ";
                try {
                    if ($stmt = mysqli_prepare($connect, $sql)) {
                        mysqli_stmt_bind_param($stmt, "ss", $stdID, $preLecId);
                        mysqli_stmt_execute($stmt);
                
                        // Close the statement and the database connection
                        mysqli_stmt_close($stmt);

                        $sql = "UPDATE student SET RegNum=?, firstName=?, lastName=?, gender=?, nic=?, department=?, faculty=?, email=?,batch=?, mobileNum=?, profilePic=? WHERE userName=?";

                        try {
                            if ($stmt = mysqli_prepare($connect, $sql)) {
                                mysqli_stmt_bind_param($stmt, "ssssssssssss", $stdID, $firstName, $lastName, $gender, $nic, $departmentName, $facultyName, $email, $batch, $mobileNum, $lecImage, $stdID);
                                mysqli_stmt_execute($stmt);
                        
                                // Close the statement and the database connection
                                mysqli_stmt_close($stmt);
                                mysqli_close($connect);
                        
                                header("Location:viewStudent.php?showModal=true&status=success&message=Student updated successfully");
                            } else {
                                throw new Exception(mysqli_error($connect));
                            }
                        } catch (Exception $e) {
                            header("Location:viewStudent.php?showModal=true&status=unsuccess&message=Update unsuccessful! " . $e->getMessage());
                        }
                

                    } else {
                        throw new Exception(mysqli_error($connect));
                    }
                } catch (Exception $e) {
                    header("Location:viewStudent.php?showModal=true&status=unsuccess&message=Update unsuccessful! " . $e->getMessage());
                }

                
   
            }
        }else {
            throw new Exception(mysqli_error($connect));
        }
    }else {
        throw new Exception(mysqli_error($connect));
    }           
}catch (Exception $e) {
    header("Location:viewStudent.php?showModal=true&status=unsuccess&message=Added unsuccess! " . $e->getMessage());
}              
?>        
