<?php

session_start();

  if (!isset($_SESSION["userName"])) {
    header("Location: login/login.php");
    exit();
  }

include '../../../database.php';

if(isset($_POST['addSubject'])){
    $subID = $_POST['chooseSubID'];
    $subName = $_POST['chooseSubName'];
    $faculty = $_POST['chooseFac'];
    $department = $_POST['chooseDep'];
    $semester = $_POST['chooseSem'];    
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

                $sql = "INSERT INTO subject(subCode,subName,semester,depID) VALUES(?,?,?,?)";

                try {
                    if ($stmt = mysqli_prepare($connect, $sql)) {
                        mysqli_stmt_bind_param($stmt, "ssss", $subID,$subName,$semester,$department);
                        mysqli_stmt_execute($stmt);

                        // Close the statement and the database connection
                        mysqli_stmt_close($stmt);
                        mysqli_close($connect);

                        header("Location:viewSubject.php?showModal=true&status=success&message=Subject added successfully");
                    }else {
                        throw new Exception(mysqli_error($connect));
                    }
                } catch (Exception $e) {
                    header("Location:viewSubject.php?showModal=true&status=unsuccess&message=Added unsuccess! " . $e->getMessage());
                }   
            }
        }else {
            throw new Exception(mysqli_error($connect));
        }
    }else {
        throw new Exception(mysqli_error($connect));
    }           
}catch (Exception $e) {
    header("Location:viewSubject.php?showModal=true&status=unsuccess&message=Added unsuccess! " . $e->getMessage());
}              
?>        
