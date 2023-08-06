<?php

  session_start();

  if (!isset($_SESSION["userName"])) {
    header("Location: login/login.php");
    exit();
  }

  define('BASE_DIR', '../../Components/');

  include_once '../../../database.php';

  // Set page title
  $page_title = "Dashboard - View admin";

  //Set the heading
  $head_title = "Dashboard";

  //Sub Title
  $sub_title = "View admin";

  $isDashboard = "active";
  
  include BASE_DIR . 'header.php';
?>

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
    <button type="button" class="btn btn-primary button-icon" data-bs-toggle="modal" data-bs-target="#addAdmin" style="margin-left:25px;background-image: url('../../Assets/images/icons/add.svg');"> 
    Add admin</button>
  </div>
</div>

<!-- Select faculty -->
<?php include '../../Components/facultyDropdown.php' ?>

<!-- Select department -->
<?php include '../../Components/departmentDropdown.php' ?>

<!-- Admin card -->
<div class="row row-cols-1 row-cols-md-3  g-4" id="admin-card">
  <?php 
    try{
      // Select data from the "admin" table
      $sql = "SELECT * FROM admin";
      $result = $connect->query($sql);

      // Check if there are any rows in the result set
    if ($result->num_rows > 0) {

      // Output data of each row
      while($row = $result->fetch_assoc()) {
          // Display the data on Bootstrap cards
          
        if(isset($row['profilePic'])){
          $image_src = $row['profilePic'];
        }else{
          $image_src = "../../Assets/images/profile.jpg";
        }
          echo '<div>
                  <div class="card mb-3 h-100 shadow admin-card" style="border:none;">
                  <img
                  class="img-fluid mx-auto d-block"
                  src='.$image_src.'
                  alt="PROFILE PICTURE"
                  style="
                    width: 100px !important;
                    height: 100px !important;
                    border-radius: 50%;
                    transition: all 0.3s;
                    margin: auto;
                    margin-top: 1rem;
                  "
                />
                    <div class="card-body" 
                      style="display:flex; flex-direction:column; align-items:center; justify-content:center; overflow:hidden"
                    >
                      <div> 
                        <h5 class="card-title text-center">'. $row["firstName"] .''.' '.''. $row["lastName"] .'</h5>      
                      </div> 
                      <div>
                        <h6 class="card-title text-center">'. $row["adminID"] .'</h6>
                      </div>
                      <div>
                        <a  href="adminProfile.php?adminID='. $row['adminID'] .'" class="btn btn-primary mt-3">View profile</a >
                      </div>
                    </div>
                  </div>
                </div>';
      }
      }
    } catch(mysqli_sql_exception $e){
      echo "Error";
    }

    // Close the database connection
    $connect->close();

  ?>
</div> 

<?php
  include '../../Components/modal.php';
  include '../../Components/Modals/addAdminModal.php';
  include  BASE_DIR . 'footertop.php';
?>

<script src="/UniversityAttendanceSystem/src/js/displayCard.js"></script>
<script src="/UniversityAttendanceSystem/src/js/facultyAndDepartmentDropdownForAddAdmin.js"></script>
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
        
    }else if (showModal === 'true' && status==='viewAdmin') {
        // show the modal popup
        $('#adminProfile').modal('show');

        //jQuery code to clear URL parameters on modal close with delay
        window.history.replaceState({}, document.title, window.location.pathname);
    }
    });
</script>

<?php
  include  BASE_DIR . 'footer.php';
?>