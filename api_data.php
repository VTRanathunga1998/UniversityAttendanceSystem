<?php

    include_once 'database.php';
    $GLOBALS['connect'] = $connect;

    function getFaculty($ID=NULL){
        if($ID==NULL){
            $query = mysqli_query($GLOBALS['connect'],"SELECT * FROM faculty");
            $all_data = array();

            while($row=mysqli_fetch_assoc(($query))){
                // array_push($all_data,$row);
                $all_data[] = $row;
            }

            
            return $all_data;

        } else {

                $query = mysqli_query($GLOBALS['connect'],"SELECT * FROM faculty WHERE facID='".$ID."'");
                $all_data = array();
    
                while($row=mysqli_fetch_assoc(($query))){
                    // array_push($all_data,$row);
                    $all_data[] = $row;
                }
    
                
                return $all_data;
        }
        

    }

    function getDepartment($facID=NULL){
        if($facID==NULL){
            $query = mysqli_query($GLOBALS['connect'],"SELECT * FROM department");
            $all_data = array();

            while($row=mysqli_fetch_assoc(($query))){
                // array_push($all_data,$row);
                $all_data[] = $row;
            }

            
            return $all_data;

        } else {

                $query = mysqli_query($GLOBALS['connect'],"SELECT * FROM department WHERE facID='".$facID."'");
                $all_data = array();
    
                while($row=mysqli_fetch_assoc(($query))){
                    // array_push($all_data,$row);
                    $all_data[] = $row;
                }
    
                
                return $all_data;
    

        }
    }

    function getSubject($depID=NULL,$semester){

        if($depID==NULL){
            $query = mysqli_query($GLOBALS['connect'],"SELECT * FROM subject");
            $all_data = array();

            while($row=mysqli_fetch_assoc(($query))){
                // array_push($all_data,$row);
                $all_data[] = $row;
            }

            
            return $all_data;

        } else {

                $sql = "SELECT * FROM subject WHERE depID='$depID' AND semester='$semester'";
                $query = mysqli_query($GLOBALS['connect'],$sql);
                $all_data = array();
    
                while($row=mysqli_fetch_assoc(($query))){
                    // array_push($all_data,$row);
                    $all_data[] = $row;
                }
    
                
                return $all_data;
    
        }
    }

    function getBatch(){  
        $sql = "SELECT * FROM batch";
        $query = mysqli_query($GLOBALS['connect'],$sql);
        $all_data = array();

        while($row=mysqli_fetch_assoc(($query))){
            // array_push($all_data,$row);
            $all_data[] = $row;
        }

        
        return $all_data;   
    }


    // Get lecturer
    function getLecturer($facID = NULL , $depID = NULL){

        if($depID==NULL){
            $query = mysqli_query($GLOBALS['connect'],"SELECT * FROM lecturer WHERE faculty='$facID'");
            $all_data = array();

            while($row=mysqli_fetch_assoc(($query))){
                // array_push($all_data,$row);
                $all_data[] = $row;
            }

            
            return $all_data;

        } else {

                $sql = "SELECT * FROM lecturer WHERE faculty='$facID' AND department='$depID'";
                $query = mysqli_query($GLOBALS['connect'],$sql);
                $all_data = array();
    
                while($row=mysqli_fetch_assoc(($query))){
                    // array_push($all_data,$row);
                    $all_data[] = $row;
                }
    
                
                return $all_data;
    
        }
    }

    // Get Student
    function getStudent($facID = NULL , $depID = NULL){

        if($depID==NULL){
            $query = mysqli_query($GLOBALS['connect'],"SELECT * FROM student WHERE faculty='$facID'");
            $all_data = array();

            while($row=mysqli_fetch_assoc(($query))){
                // array_push($all_data,$row);
                // $profile_picture = null;
                // if (!empty($row['profilePic'])) {
                //     $profile_picture = file_get_contents($row['profilePic']);
                //     $profile_picture = base64_encode($profile_picture);
                // }
                // $row['profilePic'] = $profile_picture;
                $all_data[] = $row;
            }

            
            return $all_data;

        } else {

                $sql = "SELECT * FROM student WHERE faculty='$facID' AND department='$depID'";
                $query = mysqli_query($GLOBALS['connect'],$sql);
                $all_data = array();
    
                while($row=mysqli_fetch_assoc(($query))){
                    // array_push($all_data,$row);
                    // $profile_picture = null;
                    // if (!empty($row['profilePic'])) {
                    //     $profile_picture = file_get_contents($row['profilePic']);
                    //     $profile_picture = base64_encode($profile_picture);
                    // }
                    // $row['profilePic'] = $profile_picture;
                    $all_data[] = $row;
                }
    
                
                return $all_data;
    
        }
    }

    // Get Admin
    function getAdmin($facID = NULL , $depID = NULL){

        if($depID==NULL){
            $query = mysqli_query($GLOBALS['connect'],"SELECT * FROM admin WHERE faculty='$facID'");
            $all_data = array();

            while($row=mysqli_fetch_assoc(($query))){
                // array_push($all_data,$row);
                // $profile_picture = null;
                // if (!empty($row['profilePic'])) {
                //     $profile_picture = file_get_contents($row['profilePic']);
                //     $profile_picture = base64_encode($profile_picture);
                // }
                // $row['profilePic'] = $profile_picture;
                $all_data[] = $row;
            }

            
            return $all_data;

        } else {

                $sql = "SELECT * FROM admin WHERE faculty='$facID' AND department='$depID'";
                $query = mysqli_query($GLOBALS['connect'],$sql);
                $all_data = array();
    
                while($row=mysqli_fetch_assoc(($query))){
                    // array_push($all_data,$row);
                    // $profile_picture = null;
                    // if (!empty($row['profilePic'])) {
                    //     $profile_picture = file_get_contents($row['profilePic']);
                    //     $profile_picture = base64_encode($profile_picture);
                    // }
                    // $row['profilePic'] = $profile_picture;
                    $all_data[] = $row;
                }
    
                
                return $all_data;
    
        }
    }

   
    if(isset($_REQUEST['type'])){
        if($_REQUEST['type']=="department"){
            echo json_encode(getDepartment($_REQUEST['facID']));
        }
        else if($_REQUEST['type']=="subject"){
            echo json_encode(getSubject($_REQUEST['depID'],$_REQUEST['semester']));
        }
        else if($_REQUEST['type']=="batch"){
            echo json_encode(getBatch());
        }
        else if($_REQUEST['type']=="lecturer"){
            if (isset($_REQUEST['facID']) && isset($_REQUEST['depID'])) {
                echo json_encode(getLecturer($_REQUEST['facID'], $_REQUEST['depID']));
            } else if (isset($_REQUEST['facID'])) {
                echo json_encode(getLecturer($_REQUEST['facID']));
            } else if (isset($_REQUEST['depID'])) {
                echo json_encode(getLecturer(null, $_REQUEST['depID']));
            }
        }
        else if($_REQUEST['type']=="student"){
            if (isset($_REQUEST['facID']) && isset($_REQUEST['depID'])) {
                echo json_encode(getStudent($_REQUEST['facID'], $_REQUEST['depID']));
            } else if (isset($_REQUEST['facID'])) {
                echo json_encode(getStudent($_REQUEST['facID']));
            } else if (isset($_REQUEST['depID'])) {
                echo json_encode(getStudent(null, $_REQUEST['depID']));
            }
        }
        else if($_REQUEST['type']=="admin"){
            if (isset($_REQUEST['facID']) && isset($_REQUEST['depID'])) {
                echo json_encode(getAdmin($_REQUEST['facID'], $_REQUEST['depID']));
            } else if (isset($_REQUEST['facID'])) {
                echo json_encode(getAdmin($_REQUEST['facID']));
            } else if (isset($_REQUEST['depID'])) {
                echo json_encode(getAdmin(null, $_REQUEST['depID']));
            }
        }
        
    } else {
        echo json_encode(getFaculty());
    }
?>