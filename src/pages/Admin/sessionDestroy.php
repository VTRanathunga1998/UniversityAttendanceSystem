<?php 
      session_start();

      if (!isset($_SESSION["userName"])) {
        header("Location: login/login.php");
        exit();
      }

    include_once '../../../database.php';
    
    $sessionID = $_SESSION['sessionID'];

    try{
        $query = "UPDATE session SET sessionStatus = 'closed' WHERE sessionID='$sessionID'";
      
        mysqli_query($connect,$query);
        
        $connect -> close();
  
      } catch (mysqli_sql_exception $e) {
        // Handle the exception
        $connect -> close();

        header("Location:scanQr.php");
    }

    unset($_SESSION['sessionID']);
    session_destroy();

    header("Location:takeAttendance.php");
?>