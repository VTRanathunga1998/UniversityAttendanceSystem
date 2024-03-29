<?php

session_start();

if (!isset($_SESSION["userName"])) {
  header("Location: login/login.php");
  exit();
}

  include_once '../../../database.php';

  if(isset($_GET['adminID'])){
    $adminID = $_GET['adminID'];
    $_SESSION['oldAdminID'] = $adminID;

    $sql = "SELECT * FROM admin WHERE adminID = '$adminID'";

    $result = mysqli_query($connect,$sql);

    if ($result->num_rows > 0) {
      $row=mysqli_fetch_assoc($result);
    }else{
      header("Location:viewAdmin.php?showModal=true&status=unsuccess&message=Profile not found");
      exit();
    }
  } else {
    header("Location:viewAdmin.php?showModal=true&status=unsuccess&message=Profile not found");
    exit();
  }
?>

<?php
  define('BASE_DIR', '../../Components/');

  // Set page title
  $page_title = "Admin profile";

  //Set the heading
  $head_title = "Setting";

  //Sub Title
  $sub_title = "Admin profile";

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
    <a href="/UniversityAttendanceSystem/src/pages/Admin/viewAdmin.php" class="btn button-icon btn-primary-soft btn-icon-back" >
      Back
    </a>
  </div>
</div>

<div class="row p-3 bg-white shadow rounded">
  <div class="col-12 col-md-4 col-lg-4 adminProfile-left" style="
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:flex-start;
   ">
    <div class="text-center" style="
      width:100%;

    ">
      <img src=<?php 
        if($row['profilePic']  && file_exists($row['profilePic'])){
          echo $row['profilePic']; 
        }else{
          echo "../../Assets/images/profile.jpg";
        }
      
      ?> width="200px" class="img-fluid" style="
        object-fit: cover;
      ">
    </div>
  </div>
  <div class="col-12 col-md-8 col-lg-8 adminProfile-right ">
    <div>
      <table class="table table-borderless">
        <tbody>
          <tr>
            <td class="col-3"><strong>Index Number</strong></td>
            <td class="col-2 text-center"><strong>:</strong></td>
            <td class="col-7"><?php echo $row['adminID'] ?></td>
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
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editAdmin">Edit</button>
          </div>
          <div>
            <a href="?showModal=true&status=removeAdmin&adminID=<?php echo $adminID ?>" class="btn btn-danger">Remove</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>



<?php
  include '../../Components/modal.php';
  include '../../Components/modals/editAdminProfileModal.php';
  include '../../Components/modals/removeAdminModal.php';


  include  BASE_DIR . 'footertop.php';
?>

<script src="../../js/facultyAndDepartmentDropdownForEditAdmin.js"></script>

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
    }else if(showModal === 'true' && status==='removeAdmin'){
      // show the modal popup
      $('#removeAdmin').modal('show');
    }
    });
</script>


<?php
  include  BASE_DIR . 'footer.php';
?>