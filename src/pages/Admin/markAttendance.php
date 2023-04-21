<?php
    session_start();

    include_once '../../../database.php';

    if(isset($_POST['qrcode'])){
        $code = mysqli_real_escape_string($connect,$_POST['qrcode']);
        $mycode =  strval($code);
        $sessionId = $_SESSION['sessionID'];
        $present = 1;

        $sql = "SELECT faculty,department,batch FROM session WHERE sessionID = '$sessionId' ";
        $result = mysqli_query($connect,$sql);
        $resultRows = mysqli_num_rows($result);

        if($resultRows == 1){
            while($row=mysqli_fetch_assoc($result)){
                $faculty = $row['faculty'];
                $department = $row['department'];
                $batch = $row['batch'];

                $sql = "SELECT RegNum FROM student WHERE faculty = '$faculty' AND department = '$department' AND batch = '$batch' AND RegNum = '$code'";

                $result = mysqli_query($connect,$sql);
                $resultRows = mysqli_num_rows($result);

                if($resultRows == 1){
                    $sql = "SELECT regNum FROM attendance WHERE (sessionID = '$sessionId' AND regNum = '$code')"; //check the register number is already added

                    $result = mysqli_query($connect,$sql);
                    $resultRows = mysqli_num_rows($result);


                    if($resultRows == 1){  
                        header("Location:scanQR.php?showModal=true&status=unsuccess&message=Already added");
                        exit();      
                    } else{
                        $sql = "INSERT INTO attendance (regNum,present,sessionID,timeIn) VALUES('$mycode','$present','$sessionId',NOW())";

                        if($connect->query($sql) === TRUE){   
                        
                            header("Location:scanQR.php?id=$code&showModal=true&status=success");
                        } else {
                            echo 'Error';
                        }
                    }
                } else {
                    header("Location:scanQR.php?showModal=true&status=unsuccess&message=The member does not exist");
                    exit();
                }

            }
        }

    } else {
        header("Location:scanQR.php?showModal=true&status=unsuccess&message=QR code not recognized");
        // echo '<script>if(confirm("QR code not recognized")) document.location = \'scanQR.php\';</script>';
    }

    

?>

