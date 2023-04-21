<?php 
    
    try{

        $dbServerName = "localhost";
        $dbUserName = "root";
        $dbPassword = "";
        $dbName = "attendance_system";

        // Create a connection to the database
        $connect = mysqli_connect($dbServerName,$dbUserName,$dbPassword,$dbName);
        
        // Check connection
        if ($connect->connect_errno) {
            throw new mysqli_sql_exception("Failed to connect to MySQL: " . $connect->connect_error);
        }
        
    
    }catch (mysqli_sql_exception $e) {
        // Handle the exception
        header("Location:admin.php?showModal=true&status=unsuccess&message=Database connecting error");
    } 
?>