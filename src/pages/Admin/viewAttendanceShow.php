<?php
  define('BASE_DIR', '../../Components/');

    //include database
    include_once '../../../database.php';

    if(isset($_POST['viewClass'])){
      try{
        $faculty = mysqli_real_escape_string($connect,$_POST['chooseFac']);
        $department = mysqli_real_escape_string($connect,$_POST['chooseDep']);
        $activityType = mysqli_real_escape_string($connect,$_POST['chooseActType']);
        $subject = mysqli_real_escape_string($connect,$_POST['chooseSub']);
        $semester = mysqli_real_escape_string($connect,$_POST['chooseSem']);
        $batch = mysqli_real_escape_string($connect,$_POST['chooseBatch']);

        $date = mysqli_real_escape_string($connect,$_POST['chooseDate']);  

        $timeStartHH = mysqli_real_escape_string($connect,$_POST['timeStartHH']);
        $timeStartMM = mysqli_real_escape_string($connect,$_POST['timeStartMM']);

        $timeEndHH = mysqli_real_escape_string($connect,$_POST['timeEndHH']);
        $timeEndMM = mysqli_real_escape_string($connect,$_POST['timeEndMM']);

        $timeStart = $timeStartHH.':'.$timeStartMM.':00' ;

        $timeEnd = $timeEndHH.':'.$timeEndMM.':00' ;

        $sql = "SELECT faculty.facName,department.depName FROM faculty INNER JOIN department ON department.facID = faculty.facID WHERE department.depID = '$department'";

        if(mysqli_query($connect,$sql)){
            $result = mysqli_query($connect,$sql);
            $resultRows = mysqli_num_rows($result);

            if($resultRows == 1){
                while($row = mysqli_fetch_assoc($result)){  

                    $faculty = $row['facName'];
                    $department = $row['depName']; 
                      
                }
            } 
            
        } 
      }catch (mysqli_sql_exception $e) {
        // Handle the exception
        header("Location:viewAttendance.php?showModal=true&status=unsuccess&message=Database error");
      }
    } else {
      // Handle the exception
      header("Location:viewAttendance.php?showModal=true&status=unsuccess&message=Something went wrong");
    }


    try{
      $sql = "SELECT sessionID FROM session WHERE faculty = '$faculty' AND batch = '$batch' AND activityType = '$activityType' AND subject = '$subject' AND semester = '$semester' AND department = '$department' AND date = '$date' AND timeStart = '$timeStart' AND timeEnd = '$timeEnd';" ;

      if(mysqli_query($connect,$sql)){
          $result = mysqli_query($connect,$sql);
          $resultRows = mysqli_num_rows($result);


          if($resultRows > 0){
              while($row = mysqli_fetch_assoc($result)){   
                  $sessionID = $row['sessionID'];

                  $query = "SELECT * FROM session WHERE sessionID = $sessionID";
      
                  $result_set = mysqli_query($connect,$query);

                  $session_result = mysqli_fetch_array($result_set);
              }
          }
      }
    }catch (mysqli_sql_exception $e) {
      // Handle the exception
      header("Location:viewAttendance.php?showModal=true&status=unsuccess&message=Database error");
    }

?>



<?php
  // Set page title
  $page_title = "View attendance";

  //Set the heading
  $head_title = "View attendance";

  //Sub Title
  $sub_title = "Attendance";

  $isViewAttendance = "active";
  
  include BASE_DIR . 'header.php';




?>

<div class="mb-3 action-bar">
  <div>
    <button type="button" class="btn btn-primary button-icon" data-bs-toggle="modal" data-bs-target="#viewClass" style="background-image: url('../../Assets/images/icons/add.svg');"> 
        Select class
    </button>
  </div>
  <div>
    <button type="button" class="btn btn-primary-soft button-icon" 
      data-bs-toggle="modal" data-bs-target="#sessionView"
      style="padding-left: 40px;padding-top: 8px;padding-bottom: 8px; background-color: #D8EBFA; background-image: url('../../Assets/images/icons/view-iceblue.svg'); color:#1969AA; font-weight: 500; font-size: 16px;"
      > 
      View Session
  </button>
  </div>
</div>


<div class="session-table">
    <h5>Session ID : <?php echo $sessionID; ?></h5>
    <table class="table table-light table-hover" id="attendance-table">
      <thead>
        <tr>
          <th scope="col">Attendance Id</th>
          <th scope="col">Index Number</th>
          <th scope="col">Time In</th>
          <th scope="col">Present</th>
        </tr>
      </thead>
      <tbody>
        <?php                                   
          try{
                   
            $sql = "SELECT * FROM attendance WHERE sessionID = '$sessionID' AND present=1;";

            if(mysqli_query($connect,$sql)){
                $result = mysqli_query($connect,$sql);
                $resultRows = mysqli_num_rows($result);

                if($resultRows > 0){
                    while($row = mysqli_fetch_assoc($result)){

                ?>
                  <tr>
                      <td><?php echo $row['attendanceID'] ?></td>
                      <td><?php echo $row['regNum'] ?></td>
                      <td><?php echo $row['timeIn'] ?></td>
                      <td><?php echo $row['present'] ?></td>
                  </tr>
                
                <?php
                    
                    }

                } else {
                    echo 'Error';
                }

            }
          } catch (mysqli_sql_exception $e) {
            // Handle the exception
            header("Location:viewAttendance.php?showModal=true&status=unsuccess&message=Database error");
          }
        ?>
      </tbody>
    </table>
</div>

<?php include '../../Components/modal.php'; ?> 
<?php include '../../Components/Modals/sessionViewModal.php'; ?> 

<?php include  BASE_DIR . 'footertop.php'; ?>

<!--View class dropdown js-->
<script src="/UniversityAttendanceSystem/src/js/viewClassDropdown.js"></script>

<!-- Scripts for DataTables -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function () {
  $("#attendance-table").DataTable();
});
</script>

<?php
  include  BASE_DIR . 'footer.php';
?>