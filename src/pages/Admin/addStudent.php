<?php

session_start();

include '../../../database.php';

if(isset($_POST['addStudent'])){
    $stdID = $_POST['chooseStdID'];
    $firstName = $_POST['chooseFirstName'];
    $lasttName = $_POST['chooseLastName'];
    $gender = $_POST['chooseGender'];
    $faculty = $_POST['chooseFac'];
    $department = $_POST['chooseDep'];
    $nic = $_POST['chooseNIC'];
    $email = $_POST['chooseMail'];
    $departmentName = '';
    $facultyName = '';
    $batch = $_POST['chooseBatch'];
    $role = "Student";
    if(isset($_POST['chooseMobile'])){
        $mobileNum = $_POST['chooseMobile'];
    }else{
        $mobileNum = '';
    }
    $stdImage = '';

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
                $stdImage = $uploadPath;
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

                $hashedPass = password_hash("@Abc123",PASSWORD_DEFAULT);

                $sql = "INSERT INTO user(userName,password,role) VALUES(?,?,?)";
                try {
                    if ($stmt = mysqli_prepare($connect, $sql)) {

                        mysqli_stmt_bind_param($stmt, "sss", $stdID, $hashedPass, $role);
                        mysqli_stmt_execute($stmt);

                        $sql = "INSERT INTO student(RegNum, firstName, lastName, gender, nic, department, batch, faculty, email, mobileNum, userName, profilePic) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
                        try {
                            if ($stmt = mysqli_prepare($connect, $sql)) {
                                mysqli_stmt_bind_param($stmt, "ssssssssssss", $stdID, $firstName, $lasttName, $gender, $nic, $departmentName, $batch, $facultyName, $email, $mobileNum, $stdID, $stdImage);
                                mysqli_stmt_execute($stmt);

                                // Close the statement and the database connection
                                mysqli_stmt_close($stmt);
                                mysqli_close($connect);

                                header("Location:viewStudent.php?showModal=true&status=success&message=Student added successfully");
                            }else {
                                throw new Exception(mysqli_error($connect));
                            }
                        } catch (Exception $e) {
                            header("Location:viewStudent.php?showModal=true&status=unsuccess&message=Added unsuccess! " . $e->getMessage());
                        }
                    }else {
                        throw new Exception(mysqli_error($connect));
                    }
                }catch (Exception $e) {
                    header("Location:viewStudent.php?showModal=true&status=unsuccess&message=Added unsuccess! " . $e->getMessage());
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
