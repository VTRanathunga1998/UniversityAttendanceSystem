<?php

    session_start();
    // if(!empty($_SESSION['userName'])){
    //     header("Location:index.php");
    // }

    include 'database.php';
    include 'src/utils/password_utils.php';

    if(isset($_POST['register'])){

        if(!is_password_strong($_POST['password'])){
            header("Location:register.php?showModal=true&status=unsuccess&message=Password is too weak");
            exit();
        }

        if($_POST['password'] != $_POST['confirmPassword']){
            header("Location:register.php?showModal=true&status=unsuccess&message=Password mismatch");
            exit();
        }else {

            $role = $_POST['chooseRole'];
            $id = $_POST['id'];
            $firstName = $_POST['fName'];
            $lastName = $_POST['lName'];
            $nic = $_POST['nic'];
            $mobile = $_POST['mobNum'];
            $email = $_POST['email'];
            $faculty = $_POST['chooseFac'];
            $department = $_POST['chooseDep'];
            $gender = $_POST['chooseGender'];
            $profilePic = "";
            
            if(isset($_POST['chooseBatch'])){
                $batch =$_POST['chooseBatch'];
            } else {
                $batch = "";
            }

            //Check the profile picture is uploaded or not
            if($_FILES['file']['error'] === UPLOAD_ERR_OK){
                if ($_FILES['profilePic']['error'] == 0) {
                    // User has uploaded an image
                    $allowedTypes = array('jpg', 'jpeg', 'png');
                    $fileType = pathinfo($_FILES['profilePic']['name'], PATHINFO_EXTENSION);
                
                    if (in_array($fileType, $allowedTypes)) {
                        $fileName = time() . '_' . uniqid() . '_' . $_FILES['profilePic']['name'];
                        $tempName = $_FILES['profilePic']['tmp_name'];
                        $fileSize = $_FILES['profilePic']['size'];
                        
                        if($role=="Admin"){
                            $uploadDirectory = 'src/Assets/uploads/Admin/';
                        }else{
                            $uploadDirectory = 'src/Assets/uploads/Student/';
                        }
                                          
                            $uploadPath = $uploadDirectory . $fileName;
                
                        if (move_uploaded_file($tempName, $uploadPath)) {
                            // Image has been successfully uploaded
                            $profilePic = $uploadPath;
                        } else {
                            // Error uploading the image
                            header("Location:register.php?showModal=true&status=unsuccess&message=Error uploading image");
                            exit();
                        }
                    } else {
                        // Unsupported file type
                        header("Location:register.php?showModal=true&status=unsuccess&message=Unsupported file type");
                        exit();
                    }
                } else {
                    // File error
                    header("Location:register.php?showModal=true&status=unsuccess&message=File error");
                    exit();
                }
            }
            
            
            // Hash password
            $password = mysqli_real_escape_string($connect,$_POST['password']);
            $securePassword = password_hash($password,PASSWORD_DEFAULT);
           
            $sql = "SELECT faculty.facName, department.depName 
                    FROM faculty 
                    INNER JOIN department ON department.facID = faculty.facID 
                    WHERE department.depID = ?";

            if ($stmt = mysqli_prepare($connect, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $department);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $resultRows = mysqli_num_rows($result);

                if ($resultRows == 1) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $faculty = $row['facName'];
                        $department = $row['depName'];

                        $sql = "INSERT INTO approve(id, role, firstName, lastName, nic, mobile, email, faculty, department, gender, profilePic, password, batch) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                        if ($stmt = mysqli_prepare($connect, $sql)) {
                            mysqli_stmt_bind_param($stmt, "sssssssssssss", $id, $role, $firstName, $lastName, $nic, $mobile, $email, $faculty, $department, $gender, $profilePic, $securePassword, $batch);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                            header("Location: login.php?status=success");
                            exit();
                        } else {
                            // echo '<script>if(confirm("Database Error")) document.location = "index.php";</script>';
                            header("Location:index.php?showModal=true&status=unsuccess&message=Database Error");
                            exit();
                        }
                    }
                } else {
                    // echo '<script>if(confirm("Database Error")) document.location = "index.php";</script>';
                    header("Location:index.php?showModal=true&status=unsuccess&message=Database Error");
                    exit();
                }
            } else {
                // echo '<script>if(confirm("Database Error")) document.location = "index.php";</script>';
                header("Location:index.php?showModal=true&status=unsuccess&message=Database Error");
                exit();
            }
        } 
    }       
?>

