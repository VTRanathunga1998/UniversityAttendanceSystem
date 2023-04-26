<?php

session_start();

include '../../../database.php';

if(isset($_POST['addDepartment'])){
    $depID = $_POST['depID'];
    $depName = $_POST['depName'];
    $facID = $_POST['chooseFac'];
    if(isset($_POST['depURL'])){
        $depURL = $_POST['depURL'];
    }else{
        $depURL = '';
    }
    $depImage = '';

    if (isset($_FILES['depPic']) && $_FILES['depPic']['error'] == 0) {
        // User has uploaded an image
        $allowedTypes = array('jpg', 'jpeg', 'png');
        $fileType = pathinfo($_FILES['depPic']['name'], PATHINFO_EXTENSION);

        if (in_array($fileType, $allowedTypes)) {
            $fileName = time() . '_' . uniqid() . '_' . $_FILES['depPic']['name'];
            $tempName = $_FILES['depPic']['tmp_name'];
            $fileSize = $_FILES['depPic']['size'];
            $uploadDirectory = '../../Assets/uploads/Department/';
            $uploadPath = $uploadDirectory . $fileName;

            if (move_uploaded_file($tempName, $uploadPath)) {
                // Image has been successfully uploaded
                $depImage = $uploadPath;
            } else {
                // Error uploading the image
                header("Location:viewDepartment.php?showModal=true&status=unsuccess&message=Error uploading image");
                exit();
            }
        } else {
            // Invalid file type
            header("Location:viewDepartment.php?showModal=true&status=unsuccess&message=Invalid file type");
            exit();
        }
    }
}

$sql = "INSERT INTO department(depID, depName, facID, depPic, depURL) VALUES(?,?,?,?,?)";
try {
    if ($stmt = mysqli_prepare($connect, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssss", $depID, $depName, $facID, $depImage ,$depURL);
        mysqli_stmt_execute($stmt);

        // Close the statement and the database connection
        mysqli_stmt_close($stmt);
        mysqli_close($connect);

        header("Location:viewDepartment.php?showModal=true&status=success&message=Department added successfully");
    }else {
        throw new Exception(mysqli_error($connect));
    }
} catch (Exception $e) {
    header("Location:viewDepartment.php?showModal=true&status=unsuccess&message=Added unsuccess! " . $e->getMessage());
}
                  
?>        
