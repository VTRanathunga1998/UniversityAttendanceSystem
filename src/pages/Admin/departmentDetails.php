<?php

  session_start();

  if (!isset($_SESSION["userName"])) {
    header("Location: login/login.php");
    exit();
  }

  include_once '../../../database.php';

  if(isset($_GET['depid'])){
    $lecID = $_GET['depid'];
    $_SESSION['oldDepid'] = $lecID;

    $sql = "SELECT * FROM department WHERE depID = '$lecID'";

    $result = mysqli_query($connect,$sql);

    if ($result->num_rows > 0) {
      $row=mysqli_fetch_assoc($result);
    }else{
      //header("Location:viewLecturer.php?showModal=true&status=unsuccess&message=Profile not found");
      echo ("=================");
      exit();
    }
  }
?>

<?php
  define('BASE_DIR', '../../Components/');

  // Set page title
  $page_title = "Department";

  //Set the heading
  $head_title = "Setting";

  //Sub Title
  $sub_title = "Department";

  $isSetting = "active";
  
  include BASE_DIR . 'header.php';
?>


<div class="mb-3 action-bar" style="
  disay:flex;
  flex-direction:row;
  align-items:center;
  justify-content:space-between;
">
  <div>
    <a href="/UniversityAttendanceSystem/src/pages/Admin/viewDepartment.php" class="btn button-icon btn-primary-soft btn-icon-back" >
      Back
    </a>
  </div>
</div>

<div class="row p-3 bg-white shadow rounded">
  <div class="col-12 col-md-4 col-lg-4 lecturerProfile-left" style="
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:flex-start;
   ">
    <div class="text-center" style="
      width:100%;

    ">
      <?php
if (isset($row['depPic']) && file_exists($row['depPic'])) {
  echo '<img src="' . $row['profilePic'] . '" width="200px" class="img-fluid" style="object-fit: cover;">';
} else {
  echo '<img src="/UniversityAttendanceSystem/src/Assets/images/university.jpg" width="200px" class="img-fluid" style="object-fit: cover;">';
}
?>

    </div>
  </div>
  <div class="col-12 col-md-8 col-lg-8 lecturerProfile-right ">
    <div>
      <table class="table table-borderless">
        <tbody>
          <tr>
            <td class="col-3"><strong>Index Number</strong></td>
            <td class="col-2 text-center"><strong>:</strong></td>
            <td class="col-7"><?php echo $row['depID'] ?></td>
          </tr>
          <tr>
            <td class="col-3"><strong>Faculty</strong></td>
            <td class="col-2 text-center"><strong>:</strong></td>
            <td class="col-7"><?php echo $row['depName'] ?></td>
          </tr>
          <tr>
            <td class="col-3"><strong>Department</strong></td>
            <td class="col-2 text-center"><strong>:</strong></td>
            <td class="col-7"><?php echo $row['facID']?></td>
          </tr>
 
        </tbody>
      </table>
      <div class="col-12 ">
        <div style="
          display:flex;
          align-items:center;
          justify-content:center;
          gap:1rem;
        ">
          <div>
            <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#editDepartment" >Edit</button>
          </div>
          <div>
            <a href="" class="btn btn-danger">Remove</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>



<?php
  include '../../Components/modal.php';
  include '../../Components/modals/editLecturerProfile.php';
  include '../../Components/modals/removeLecturerModal.php';


  include  BASE_DIR . 'footertop.php';
?>

<!-- <script src="../../js/facultyAndDepartmentDropdownForEditLecturer.js"></script> -->

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
    }else if(showModal === 'true' && status==='removeLecturer'){
      // show the modal popup
      $('#removeLecturer').modal('show');
    }
    });
</script>


<?php
  include  BASE_DIR . 'footer.php';
?>