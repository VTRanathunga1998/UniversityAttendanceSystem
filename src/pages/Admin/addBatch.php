<?php

  session_start();

  if (!isset($_SESSION["userName"])) {
    header("Location: login/login.php");
    exit();
  }

include '../../../database.php';

if(isset($_POST['addBatch'])){
    $batch = $_POST['Batch'];
}

$sql = "INSERT INTO batch(batch) VALUES(?)";
try {
    if ($stmt = mysqli_prepare($connect, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $batch);
        mysqli_stmt_execute($stmt);

        // Close the statement and the database connection
        mysqli_stmt_close($stmt);
        mysqli_close($connect);

        header("Location:viewBatch.php?showModal=true&status=success&message=Batch added successfully");
    }else {
        throw new Exception(mysqli_error($connect));
    }
} catch (Exception $e) {
    header("Location:viewBatch.php?showModal=true&status=unsuccess&message=Added unsuccess! " . $e->getMessage());
}
                  
?>        
