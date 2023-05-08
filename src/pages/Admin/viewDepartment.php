<?php
  define('BASE_DIR', '../../Components/');

  include_once '../../../database.php';

  // Set page title
  $page_title = "Setting";

  //Set the heading
  $head_title = "Setting";

  //Sub Title
  $sub_title = "View department";

  $isSetting = "active";
  
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
    <a href="/UniversityAttendanceSystem/src/pages/Admin/Setting.php" class="btn button-icon btn-primary-soft btn-icon-back" >
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
<div class="row row-cols-1 row-cols-md-3  g-4" id="department-card">
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
          echo '<div>
                  <div class="card mb-3 h-100 shadow department-card" style="border:none;">
                    <img src="/UniversityAttendanceSystem/src/Assets/images/university.jpg" class="card-img-top" alt="...">
                    <div class="card-body" style="display:flex; align-items:center; justify-content:center;">
                      <h5 class="card-title text-center">'. $row["depName"] .'</h5>      
                    </div>
                    <div class="card-footer text-center" style="border:none">
                      <a href="#" class="link-primary">See more...</a>      
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
    }
    });
</script>

<?php
  include  BASE_DIR . 'footer.php';
?>