<?php

  session_start();

  if (!isset($_SESSION["userName"])) {
    header("Location: login/login.php");
    exit();
  }  

  define('BASE_DIR', '../../Components/');

  include_once '../../../database.php';

  // Set page title
  $page_title = "Dashboard";

  //Set the heading
  $head_title = "Dashboard";

  //Sub Title
  $sub_title = "View department";

  $isDashboard = "active";
  
  include BASE_DIR . 'header.php';
?>

<!-- Action bar -->
<div class="mb-3 action-bar"style="
  disay:flex;
  flex-direction:row;
  align-items:center;
  justify-content:space-between;
">
  <div>
    <a href="/UniversityAttendanceSystem/src/pages/Admin/admin.php" class="btn button-icon btn-primary-soft btn-icon-back" >
      Back
    </a>
  </div>
  <div>
    <button type="button" class="btn btn-primary button-icon" data-bs-toggle="modal" data-bs-target="#addDepartment" style="margin-left:25px;background-image: url('../../Assets/images/icons/add.svg');"> 
    Add department</button>
  </div>
</div>

<!-- Select faculty -->
<?php include '../../Components/facultyDropdown.php' ?>

<!-- Department card -->
<div class="d-flex flex-wrap" id="department-card">
  <?php 
    try{
      // Select data from the "department" table
      $sql = "SELECT * FROM department";
      $result = $connect->query($sql);

      // Check if there are any rows in the result set
    if ($result->num_rows > 0) {
      // Output data of each row
      while($row = $result->fetch_assoc()) {
          // Display the data on Bootstrap cards
          echo '
          <div class="card g-4" style="width: calc(33.33% - 20px); margin-right: 20px; margin-bottom: 20px;">
                    <img src="/UniversityAttendanceSystem/src/Assets/images/university.jpg" class="card-img-top" alt="...">
                    <div class="card-body" style="display:flex; align-items:center; justify-content:center;">
                      <h5 class="card-title text-center">'. $row["depName"] .'</h5>      
                    </div>
                    <div class="card-footer text-center" style="border:none">
                    <a  href="departmentDetails.php?depid='. $row['depID'] .'" class="btn btn-primary mt-3">View department</a >
                    </div>
                  </div>
                ';
      }
    } 

    } catch(mysqli_sql_exception $e){
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      0 Results
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }

    // Close the database connection
    $connect->close();

  ?>
</div>  

<?php
  include '../../Components/modal.php';
  include '../../Components/Modals/addDepartmentModal.php';
  include  BASE_DIR . 'footertop.php';
?>

<script src="/UniversityAttendanceSystem/src/js/displayCard.js"></script>
<script src="/UniversityAttendanceSystem/src/js/addFaculty.js"></script>
<script>
    $(document).ready(function(){
    // check if the "showModal" parameter is present in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const showModal = urlParams.get('showModal');
    const status = urlParams.get('status');
    if (showModal === 'true' && status==='success') {
        // show the modal popup
        $('#success').modal('show');
        // hide the modal popup after 1 seconds
        setTimeout(function(){
        $('#success').modal('hide');
        }, 1000);

        //jQuery code to clear URL parameters on modal close with delay
        window.history.replaceState({}, document.title, window.location.pathname);
    }
    });
</script>

<?php
  include  BASE_DIR . 'footer.php';
?>