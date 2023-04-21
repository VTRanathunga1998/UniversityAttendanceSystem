<?php
  include_once '../../../database.php';

  if(isset($_GET['lecid'])){
    $lecID = $_GET['lecid'];

    $sql = "SELECT * FROM lecturer WHERE lecturerID = '$lecID'";

    $result = mysqli_query($connect,$sql);

    if ($result->num_rows > 0) {
      $row=mysqli_fetch_assoc($result);
    }else{
      header("Location:viewLecturer.php?showModal=true&status=unsuccess&message=Profile not found");
      exit();
    }
  }
?>

<?php
  define('BASE_DIR', '../../Components/');

  // Set page title
  $page_title = "Lecturer profile";

  //Set the heading
  $head_title = "Dashboard";

  //Sub Title
  $sub_title = "Lecturer profile";

  $isDashboard = "active";
  
  include BASE_DIR . 'header.php';
?>


<div class="mb-3 action-bar" style="
  disay:flex;
  flex-direction:row;
  align-items:center;
  justify-content:space-between;
">
  <div>
    <a href="/UniversityAttendanceSystem/src/pages/Admin/viewLecturer.php" class="btn button-icon btn-primary-soft btn-icon-back" >
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
    <div style="
      width:100%;

    ">
      <img src=<?php echo $row['profilePic'] ?> class="img-fluid" style="
        object-fit: cover;
      ">
    </div>
  </div>
  <div class="col-12 col-md-8 col-lg-8 lecturerProfile-right ">
    <div>
      <table class="table table-borderless">
        <tbody>
          <tr>
            <td class="col-3"><strong>Index Number</strong></td>
            <td class="col-2 text-center"><strong>:</strong></td>
            <td class="col-7"><?php echo $row['lecturerID'] ?></td>
          </tr>
          <tr>
            <td class="col-3"><strong>Faculty</strong></td>
            <td class="col-2 text-center"><strong>:</strong></td>
            <td class="col-7"><?php echo $row['faculty'] .' '. $row['lastName'] ?></td>
          </tr>
          <tr>
            <td class="col-3"><strong>Department</strong></td>
            <td class="col-2 text-center"><strong>:</strong></td>
            <td class="col-7"><?php echo $row['department']?></td>
          </tr>
          <tr>
            <td class="col-3"><strong>Name</strong></td>
            <td class="col-2 text-center"><strong>:</strong></td>
            <td class="col-7"><?php echo $row['firstName']?></td>
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
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editLecturer">Edit</button>
          </div>
          <div>
            <button class="btn btn-danger">Remove</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>



<?php
  include '../../Components/modal.php';
  include '../../Components/modals/editLecturerProfile.php';

  include  BASE_DIR . 'footertop.php';
?>

<script src="../../js/facultyAndDepartmentDropdownForEditLecturer.js"></script>

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