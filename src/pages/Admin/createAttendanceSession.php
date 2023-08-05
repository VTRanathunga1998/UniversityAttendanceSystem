<?php

    session_start();

    if (!isset($_SESSION["userName"])) {
    header("Location: login/login.php");
    exit();
    }
    include '../../../database.php';

    if(isset($_POST['newSession'])){
        $faculty = mysqli_real_escape_string($connect,$_POST['chooseFac']);
        $department = mysqli_real_escape_string($connect,$_POST['chooseDep']);
        $activityType = mysqli_real_escape_string($connect,$_POST['chooseActType']);
        $subject = mysqli_real_escape_string($connect,$_POST['chooseSub']);
        $semester = mysqli_real_escape_string($connect,$_POST['chooseSem']);
        $batch = mysqli_real_escape_string($connect,$_POST['chooseBatch']);

        $timeStartHH = mysqli_real_escape_string($connect,$_POST['timeStartHH']);
        $timeStartMM = mysqli_real_escape_string($connect,$_POST['timeStartMM']);

        $timeEndHH = mysqli_real_escape_string($connect,$_POST['timeEndHH']);
        $timeEndMM = mysqli_real_escape_string($connect,$_POST['timeEndMM']);


        $date = date("Y/m/d");

        $timeStart = $timeStartHH.':'.$timeStartMM.':00';

        $timeEnd = $timeEndHH.':'.$timeEndMM.':00';


    } else {
        header("Location:takeAttendance.php?showModal=true&status=unsuccess&message=Session not created");
        exit();
    }

    if(strtotime($timeStart) >= strtotime($timeEnd)){
        header("Location:takeAttendance.php?showModal=true&status=unsuccess&message=Time slots are does not match");
        mysqli_close($connect);
        exit();
    } else {
        try{
            $sql = "SELECT faculty.facName,department.depName FROM faculty INNER JOIN department ON department.facID = faculty.facID WHERE department.depID = '$department'";

            if(!mysqli_query($connect,$sql)){
                die('Invalid query: ' . mysql_error());
            } else {

                $result = mysqli_query($connect,$sql);
                $resultRows = mysqli_num_rows($result);

                if($resultRows == 1){
                    while($row = mysqli_fetch_assoc($result)){  
                    $facultyn = $row['facName'];
                    $departmentn = $row['depName'];
                    
                    $sql = "SELECT sessionID FROM session WHERE faculty = '$facultyn' && department = '$departmentn' && activityType = '$activityType' && subject = '$subject' && semester = '$semester' && batch = '$batch' && timeStart = '$timeStart' && timeEnd = '$timeEnd' && date='$date'" ;

                    $result = mysqli_query($connect,$sql);
                    $resultRows = mysqli_num_rows($result);

                    if($resultRows == 1){
                        header("Location:takeAttendance.php?showModal=true&status=unsuccess&message=Session has already created..");
                        mysqli_close($connect);
                        exit();
                    } else {
                        $sql = "INSERT INTO session(faculty,department,activityType,subject,semester,batch,date,timeStart,timeEnd) VALUES('$facultyn','$departmentn' , '$activityType' , '$subject' , '$semester' , '$batch' , '$date' , '$timeStart' , '$timeEnd');";

                        if(!mysqli_query($connect,$sql)){
                                die('Invalid query: ' . mysql_error());
                        } else {
                                
                            $sql = "SELECT sessionID FROM session WHERE faculty = '$facultyn' && department = '$departmentn' && activityType = '$activityType' && subject = '$subject' && semester = '$semester' && batch = '$batch' && timeStart = '$timeStart' && timeEnd = '$timeEnd' && date='$date'" ;

                            $result = mysqli_query($connect,$sql);
                            $resultRows = mysqli_num_rows($result);
                    
                            if($resultRows > 0){
                                while($row = mysqli_fetch_assoc($result)){  
                                    $_SESSION['sessionID'] = $row['sessionID'];
                                    header("Location:scanQR.php?create=successful"); 
                                    mysqli_close($connect);
                                    exit();
                                }
                            } else{
                                echo '<script>if(confirm("Session create failed")) document.location = "adminProfile.php";</script>';
                                mysqli_close($connect);
                                exit();
                            }                      
                        }
                        
                    }

                    }
                }
        
            }
        } catch(mysqli_sql_exception $ex) {
            // Handle the duplicate entry error           
            mysqli_close($connect);
            header("Location:takeAttendance.php?showModal=true&status=unsuccess&message=Database Error");
        } 
    }  

?>





                



