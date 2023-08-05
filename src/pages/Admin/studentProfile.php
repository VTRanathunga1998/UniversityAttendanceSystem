<?php

  session_start();

  if (!isset($_SESSION["userName"])) {
    header("Location: login/login.php");
    exit();
  }

  include_once '../../../database.php';

  if(isset($_GET['stdid'])){
    $stdID = $_GET['stdid'];
    $_SESSION['oldStdid'] = $stdID;

    $sql = "SELECT * FROM student WHERE RegNum = '$stdID'";

    $result = mysqli_query($connect,$sql);

    if ($result->num_rows > 0) {
      $row=mysqli_fetch_assoc($result);
    }else{
      header("Location:viewStudent.php?showModal=true&status=unsuccess&message=Profile not found");
      exit();
    }
  }
?>

<?php
  define('BASE_DIR', '../../Components/');

  // Set page title
  $page_title = "Student profile";

  //Set the heading
  $head_title = "Setting";

  //Sub Title
  $sub_title = "Student profile";

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
    <a href="/UniversityAttendanceSystem/src/pages/Admin/viewStudent.php" class="btn button-icon btn-primary-soft btn-icon-back" >
      Back
    </a>
  </div>
</div>

<div class="row p-3 bg-white shadow rounded">
  <!-- Student-Profile-Left -->
  <div class="col-12 col-md-4 col-lg-4 studentProfile-left" style="
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:flex-start;
   ">
    <div class="text-center" style="
      width:100%;

    ">
      <img src=<?php 
        if($row['profilePic'] !==null ){
          echo $row['profilePic']; 
        }else{
          echo "../../Assets/images/profile.jpg";
        } ?> 
        class="img-fluid" width="200px" style="
        object-fit: cover;
      ">
    </div>
  </div>
  <!-- Student-Profile-Right -->
  <div class="col-12 col-md-8 col-lg-8 studentProfile-right ">
    <div>
      <table class="table table-borderless">
        <tbody>
          <tr>
            <td class="col-3"><strong>Index Number</strong></td>
            <td class="col-2 text-center"><strong>:</strong></td>
            <td class="col-7"><?php echo $row['RegNum'] ?></td>
          </tr>
          <tr>
            <td class="col-3"><strong>Faculty</strong></td>
            <td class="col-2 text-center"><strong>:</strong></td>
            <td class="col-7"><?php echo $row['faculty'] ?></td>
          </tr>
          <tr>
            <td class="col-3"><strong>Department</strong></td>
            <td class="col-2 text-center"><strong>:</strong></td>
            <td class="col-7"><?php echo $row['department']?></td>
          </tr>
          <tr>
            <td class="col-3"><strong>Name</strong></td>
            <td class="col-2 text-center"><strong>:</strong></td>
            <td class="col-7"><?php echo $row['firstName'] .' '. $row['lastName']?></td>
          </tr>
          <tr>
            <td class="col-3"><strong>NIC</strong></td>
            <td class="col-2 text-center"><strong>:</strong></td>
            <td class="col-7"><?php echo $row['nic'] ?></td>
          </tr>
          <tr>
            <td class="col-3"><strong>Mobile Number</strong></td>
            <td class="col-2 text-center"><strong>:</strong></td>
            <td class="col-7"><?php echo $row['mobileNum'] ?></td>
          </tr>
          <tr>
            <td class="col-3"><strong>E-mail</strong></td>
            <td class="col-2 text-center"><strong>:</strong></td>
            <td class="col-7"><?php echo $row['email'] ?></td>
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
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editStudent">Edit</button>
          </div>
          <div>
            <a href="?showModal=true&status=removeStudent&stdid=<?php echo $stdID ?>" class="btn btn-danger">Remove</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>



<?php
  include '../../Components/modal.php';
  include '../../Components/modals/editStudentProfile.php';
  include '../../Components/modals/removeStudentModal.php';


  include  BASE_DIR . 'footertop.php';
?>

<script src="../../js/facultyAndDepartmentDropdownForEditStudent.js"></script>

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
    }else if(showModal === 'true' && status==='removeStudent'){
      // show the modal popup
      $('#removeStudent').modal('show');
    }
    });
</script>


<?php
  include  BASE_DIR . 'footer.php';
?>