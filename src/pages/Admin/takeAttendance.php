<?php

  session_start();

  if (!isset($_SESSION["userName"])) {
    header("Location: login/login.php");
    exit();
  }

  define('BASE_DIR', '../../Components/');

  include_once '../../../database.php';

  if(isset($_SESSION['sessionID'])){
    header("Location:scanQR.php");
    exit();
  } else{
    try{
      $query = "SELECT sessionID FROM session WHERE sessionStatus = 'open' LIMIT 1";
    
      $result_set = mysqli_query($connect,$query);

      $session_result = mysqli_fetch_array($result_set);

      // Return the number of rows in result set
      $rowcount=mysqli_num_rows($result_set);

      if($rowcount==1){
        $_SESSION['sessionID'] = $session_result['sessionID'];
        header("Location:scanQR.php");
      } 

    } catch (mysqli_sql_exception $e) {
      // Handle the exception
      header("Location:admin.php?showModal=true&status=unsuccess&message=Something went wrong");
    }
  }

  if(isset($_GET['sessionID'])){
    $session_id = $_GET['sessionID'];
  }

  //Get the session details 
	try{
    if(isset($session_id)){
      $query = "SELECT * FROM session WHERE sessionID = $session_id";
    
      $result_set = mysqli_query($connect,$query);

      $session_result = mysqli_fetch_array($result_set);
    }
  } catch (mysqli_sql_exception $e) {
    // Handle the exception
    header("Location:takeAttendance.php?showModal=true&status=unsuccess&message=View session failed");
  }

  //Count how many sessions in the session table
  try{
    $query = "SELECT COUNT(sessionID) as sessionCount FROM session";
    
    $result_set = mysqli_query($connect,$query);

    while($result = mysqli_fetch_assoc($result_set)){
      $count = $result['sessionCount'];
    }
  } catch (mysqli_sql_exception $e) {
    // Handle the exception
    header("Location:takeAttendance.php?showModal=true&status=unsuccess&message=Database connection error");
  }

  

?>

<?php
  // Set page title
  $page_title = "Take attendance";

  //Set the heading
  $head_title = "Take attendance";

  //Sub Title
  $sub_title = "Home";

  $isTakeattendance = "active";
  
  include BASE_DIR . 'header.php';
?>

  <div class="mb-3 action-bar">
    <div>
      <h4 class="text-center" style="margin:auto;">Schedule a Session</h4>
    </div>
    <div>
      <button type="button" class="btn btn-primary button-icon" data-bs-toggle="modal" data-bs-target="#addSession" style="margin-left:25px;background-image: url('../../Assets/images/icons/add.svg');"> 
      Add a Session</button>
    </div>
  </div>

  
  <div class="session-table">
      <h5 mb-3>All sessions (
        <?php 
          if(isset($count)){
            echo $count;
          } else{
            echo "0";
          }
        ?>
       )
       </h5>

      <!-- Table -->
      <table class="table table-light table-hover" id="session_table" style="width:100%">
        <thead>
          <tr>
            <th scope="col">Session Id</th>
            <th scope="col">Faculty</th>
            <th scope="col">Subject</th>
            <th scope="col">Date</th>
            <th scope="col">Start</th>
            <th scope="col">End</th>
            <th scope="col">Events</th>
          </tr>
        </thead>
        <tbody>
          <?php
            try{
              $sql = "SELECT * FROM session";
              $result = mysqli_query($connect,$sql);
              while($row=$result->fetch_assoc()){
          ?>    
              <tr>
                  <td><?php echo $row['sessionID'] ?></td>
                  <td><?php echo $row['faculty'] ?></td>
                  <td><?php echo $row['subject'] ?></td>
                  <td><?php echo $row['date'] ?></td>
                  <td><?php echo $row['timeStart'] ?></td>
                  <td><?php echo $row['timeEnd'] ?></td>
                  <td>
                  <a 
                    href="?showModal=true&status=sessionView&sessionID=<?php echo $row['sessionID'] ?>"  
                    type="button" 
                    class="btn btn-primary-soft button-icon btn-icon-view" 
                    style="padding-top: 12px;padding-bottom: 12px;"
                  > 
                    View
                  </a>
                  </td>
              </tr>       
          <?php    
            }
            } catch (mysqli_sql_exception $e) {
              // Handle the exception
              header("Location:takeAttendance.php?showModal=true&status=unsuccess&message=Database connection error");
            }
          ?>
        </tbody>
      </table>


  </div>

<?php include '../../Components/modal.php'; ?> 
<?php include '../../Components/Modals/sessionViewModal.php'; ?> 


<?php
  include  BASE_DIR . 'footertop.php';
?>

<!--Dropdown js-->
<script src="/UniversityAttendanceSystem/src/js/createSessionDropDown.js"></script> 

<!-- Scripts for DataTables -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function () {
  $("#session_table").DataTable();
});
</script>

<script>
    $(document).ready(function(){
    // check if the "showModal" parameter is present in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const showModal = urlParams.get('showModal');
    const status = urlParams.get('status');
    if (showModal === 'true' && status==='sessionView') {
        // show the modal popup
        $('#sessionView').modal('show');

        //jQuery code to clear URL parameters on modal close with delay
        window.history.replaceState({}, document.title, window.location.pathname);

    }
    });
</script>



<?php
  include  BASE_DIR . 'footer.php';
?>