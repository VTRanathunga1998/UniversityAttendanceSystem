<?php

session_start();

include '../../../database.php';

if(isset($_POST['addAdmin'])){
    $adminID = $_POST['chooseAdminID'];
    $firstName = $_POST['chooseFirstName'];
    $lasttName = $_POST['chooseLastName'];
    $gender = $_POST['chooseGender'];
    $faculty = $_POST['chooseFac'];
    $department = $_POST['chooseDep'];
    $nic = $_POST['chooseNIC'];
    $email = $_POST['chooseMail'];
    $departmentName = '';
    $facultyName = '';
    $role = "Admin";
    if(isset($_POST['chooseMobile'])){
        $mobileNum = $_POST['chooseMobile'];
    }else{
        $mobileNum = '';
    }
    $adminImage = '';

    if (isset($_FILES['adminPic']) && $_FILES['adminPic']['error'] == 0) {
        // User has uploaded an image
        $allowedTypes = array('jpg', 'jpeg', 'png');
        $fileType = pathinfo($_FILES['adminPic']['name'], PATHINFO_EXTENSION);
    
        if (in_array($fileType, $allowedTypes)) {
            $fileName = time() . '_' . uniqid() . '_' . $_FILES['adminPic']['name'];
            $tempName = $_FILES['adminPic']['tmp_name'];
            $fileSize = $_FILES['adminPic']['size'];
            $uploadDirectory = '../../Assets/uploads/Admin/';
            $uploadPath = $uploadDirectory . $fileName;
    
            if (move_uploaded_file($tempName, $uploadPath)) {
                // Image has been successfully uploaded
                $adminImage = $uploadPath;
            } else {
                // Error uploading the image
                header("Location:viewAdmin.php?showModal=true&status=unsuccess&message=Error uploading image");
                exit();
            }
        } else {
            // Unsupported file type
            header("Location:viewAdmin.php?showModal=true&status=unsuccess&message=Unsupported file type");
            exit();
        }
    } else {
        // File error
        header("Location:viewAdmin.php?showModal=true&status=unsuccess&message=File error");
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

                        mysqli_stmt_bind_param($stmt, "sss", $adminID, $hashedPass, $role);
                        mysqli_stmt_execute($stmt);

                        $sql = "INSERT INTO admin(adminID, firstName, lastName, gender, nic, department, faculty, email, mobileNum, userName, profilePic) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
                        try {
                            if ($stmt = mysqli_prepare($connect, $sql)) {
                                mysqli_stmt_bind_param($stmt, "sssssssssss", $adminID, $firstName, $lasttName, $gender, $nic, $departmentName, $facultyName, $email, $mobileNum, $adminID, $adminImage);
                                mysqli_stmt_execute($stmt);

                                // Close the statement and the database connection
                                mysqli_stmt_close($stmt);
                                mysqli_close($connect);

                                header("Location:viewAdmin.php?showModal=true&status=success&message=Admin added successfully");
                            }else {
                                throw new Exception(mysqli_error($connect));
                            }
                        } catch (Exception $e) {
                            header("Location:viewAdmin.php?showModal=true&status=unsuccess&message=Added unsuccess! " . $e->getMessage());
                        }
                    }else {
                        throw new Exception(mysqli_error($connect));
                    }
                }catch (Exception $e) {
                    header("Location:viewAdmin.php?showModal=true&status=unsuccess&message=Added unsuccess! " . $e->getMessage());
                }    
            }
        }else {
            throw new Exception(mysqli_error($connect));
        }
    }else {
        throw new Exception(mysqli_error($connect));
    }           
}catch (Exception $e) {
    header("Location:viewAdmin.php?showModal=true&status=unsuccess&message=Added unsuccess! " . $e->getMessage());
}              
?>        
