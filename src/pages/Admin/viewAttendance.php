<?php

  session_start();

  if (!isset($_SESSION["userName"])) {
    header("Location: login/login.php");
    exit();
  }

  define('BASE_DIR', '../../Components/');

  // Set page title
  $page_title = "View attendance";

  //Set the heading
  $head_title = "View attendance";

  //Sub Title
  $sub_title = "Home";

  $isViewAttendance = "active";
  
  include BASE_DIR . 'header.php';

  include_once '../../../database.php';


?>

<div class="mb-3 filter-bar">
  <div>
    <button type="button" class="btn btn-primary button-icon" data-bs-toggle="modal" data-bs-target="#viewClass" style="background-image: url('../../Assets/images/icons/add.svg');"> 
      Select class
    </button>
  </div>
</div>

<div class="session-table">
    <table class="table table-light table-responsive-sm table-hover" id="attendance-table">
      <thead>
        <tr>
          <th scope="col">Session Id</th>
          <th scope="col">Attendance Id</th>
          <th scope="col">Index Number</th>
          <th scope="col">Time In</th>
          <th scope="col">Present</th>
        </tr>
      </thead>
        <tbody>
          <?php
            try{
              $sql = "SELECT * FROM attendance";
              $result = mysqli_query($connect,$sql);
              while($row=$result->fetch_assoc()){
          ?>    
              <tr>
                  <td><?php echo $row['sessionID'] ?></td>
                  <td><?php echo $row['attendanceID'] ?></td>
                  <td><?php echo $row['regNum'] ?></td>
                  <td><?php echo $row['timeIn'] ?></td>
                  <td><?php echo $row['present'] ?></td>
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

<?php
  include  BASE_DIR . 'footertop.php';
?>

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