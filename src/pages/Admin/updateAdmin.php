<?php

session_start();

include '../../../database.php';

if(isset($_SESSION['oldAdminID'])){
    $preAdminId = $_SESSION['oldAdminID'];
    unset($_SESSION['oldAdminID']);
} else {
    header("Location:viewAdmin.php?showModal=true&status=unsuccess&message=Admin not found");
    exit();
}

if(isset($_POST['updateAdmin'])){
    $adminID = $_POST['chooseAdminID'];
    $firstName = $_POST['chooseFirstName'];
    $lastName = $_POST['chooseLastName'];
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

// To remove previous profile picture from serverside
$sql = "SELECT profilePic FROM admin WHERE adminID=?";
try {
    if ($stmt = mysqli_prepare($connect, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $preAdminId);
        mysqli_stmt_execute($stmt);

        $result = $stmt->get_result(); // get the mysqli result
        $admin = $result->fetch_assoc();

        $filename = $admin['profilePic']; // replace with the path and filename of the file to be deleted

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
                                mysqli_stmt_bind_param($stmt, "ss", $adminID, $preAdminId);
                                mysqli_stmt_execute($stmt);
                        
                                // Close the statement and the database connection
                                mysqli_stmt_close($stmt);

                                $sql = "UPDATE admin SET adminID=?, firstName=?, lastName=?, gender=?, nic=?, department=?, faculty=?, email=?, mobileNum=?, profilePic=? WHERE userName=?";

                                try {
                                    if ($stmt = mysqli_prepare($connect, $sql)) {
                                        mysqli_stmt_bind_param($stmt, "sssssssssss", $adminID, $firstName, $lastName, $gender, $nic, $departmentName, $facultyName, $email, $mobileNum, $adminImage, $adminID);
                                        mysqli_stmt_execute($stmt);
                                
                                        // Close the statement and the database connection
                                        mysqli_stmt_close($stmt);
                                        mysqli_close($connect);
                                
                                        header("Location:viewAdmin.php?showModal=true&status=success&message=Admin updated successfully");
                                    } else {
                                        throw new Exception(mysqli_error($connect));
                                    }
                                } catch (Exception $e) {
                                    header("Location:viewAdmin.php?showModal=true&status=unsuccess&message=Update unsuccessful! " . $e->getMessage());
                                }
                        

                            } else {
                                throw new Exception(mysqli_error($connect));
                            }
                        } catch (Exception $e) {
                            header("Location:viewAdmin.php?showModal=true&status=unsuccess&message=Update unsuccessful! " . $e->getMessage());
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
        
    } else {
        throw new Exception(mysqli_error($connect));
    }
} catch (Exception $e) {
    header("Location:viewAdmin.php?showModal=true&status=unsuccess&message=Delete unsuccessful! " . $e->getMessage());
} 

             
?>        
