<?php

session_start();

  if (!isset($_SESSION["userName"])) {
    header("Location: login/login.php");
    exit();
  }

include '../../../database.php';

if(isset($_POST['addFaculty'])){
    $facID = $_POST['facID'];
    $facName = $_POST['facName'];

    $facImage = null;

    if (isset($_FILES['facPic']) && $_FILES['facPic']['error'] == 0) {
        // User has uploaded an image
        $allowedTypes = array('jpg', 'jpeg', 'png');
        $fileType = pathinfo($_FILES['facPic']['name'], PATHINFO_EXTENSION);

        if (in_array($fileType, $allowedTypes)) {
            $fileName = time() . '_' . uniqid() . '_' . $_FILES['facPic']['name'];
            $tempName = $_FILES['facPic']['tmp_name'];
            $fileSize = $_FILES['facPic']['size'];
            $uploadDirectory = '../../Assets/uploads/Faculty';
            $uploadPath = $uploadDirectory . $fileName;

            if (move_uploaded_file($tempName, $uploadPath)) {
                // Image has been successfully uploaded
                $facImage = $uploadPath;
            } else {
                // Error uploading the image
                header("Location:viewFaculty.php?showModal=true&status=unsuccess&message=Error uploading image");
                exit();
            }
        } else {
            // Invalid file type
            header("Location:viewFaculty.php?showModal=true&status=unsuccess&message=Invalid file type");
            exit();
        }
    }

    if(isset($_POST['facDesc'])){
        $facDescription = $_POST['facDesc'];
    }else{
        $facDescription = '';
    }

    if(isset($_POST['facURL'])){
        $facURL = $_POST['facURL'];
    }else{
        $facURL = '';
    }

}

$sql = "INSERT INTO faculty(facID, facName, description, email, facPic) VALUES(?,?,?,?,?)";
try {
    if ($stmt = mysqli_prepare($connect, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssss", $facID, $facName, $facDescription, $facURL, $facImage);
        mysqli_stmt_execute($stmt);

        // Close the statement and the database connection
        mysqli_stmt_close($stmt);
        mysqli_close($connect);

        header("Location:viewFaculty.php?showModal=true&status=success&message=Faculty added successfully");
    }else {
        throw new Exception(mysqli_error($connect));
    }
} catch (Exception $e) {
    header("Location:viewFaculty.php?showModal=true&status=unsuccess&message=Added unsuccess! " . $e->getMessage());
}
                                 
                  
?>                            