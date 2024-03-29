<?php

session_start();

  if (!isset($_SESSION["userName"])) {
    header("Location: login/login.php");
    exit();
  }

include '../../../database.php';

if(isset($_POST['addLecturer'])){
    $lecID = $_POST['chooseLecID'];
    $firstName = $_POST['chooseFirstName'];
    $lasttName = $_POST['chooseLastName'];
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

                $hashedPass = password_hash("@Abc123",PASSWORD_DEFAULT);

                $sql = "INSERT INTO user(userName,password,role) VALUES(?,?,?)";
                try {
                    if ($stmt = mysqli_prepare($connect, $sql)) {

                        mysqli_stmt_bind_param($stmt, "sss", $lecID, $hashedPass, $role);
                        mysqli_stmt_execute($stmt);

                        $sql = "INSERT INTO lecturer(lecturerID, firstName, lastName, gender, nic, department, faculty, email, mobileNum, userName, profilePic) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
                        try {
                            if ($stmt = mysqli_prepare($connect, $sql)) {
                                mysqli_stmt_bind_param($stmt, "sssssssssss", $lecID, $firstName, $lasttName, $gender, $nic, $departmentName, $facultyName, $email, $mobileNum, $lecID, $lecImage);
                                mysqli_stmt_execute($stmt);

                                // Close the statement and the database connection
                                mysqli_stmt_close($stmt);
                                mysqli_close($connect);

                                header("Location:viewLecturer.php?showModal=true&status=success&message=Lecturer added successfully");
                            }else {
                                throw new Exception(mysqli_error($connect));
                            }
                        } catch (Exception $e) {
                            header("Location:viewLecturer.php?showModal=true&status=unsuccess&message=Added unsuccess! " . $e->getMessage());
                        }
                    }else {
                        throw new Exception(mysqli_error($connect));
                    }
                }catch (Exception $e) {
                    header("Location:viewLecturer.php?showModal=true&status=unsuccess&message=Added unsuccess! " . $e->getMessage());
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
