<?php
  define('BASE_DIR', '../../Components/');

  include_once '../../../database.php';

  // Set page title
  $page_title = "Dashboard view batches";

  //Set the heading
  $head_title = "Dashboard";

  //Sub Title
  $sub_title = "View batch";

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
    <button type="button" class="btn btn-primary button-icon" data-bs-toggle="modal" data-bs-target="#addBatch" style="margin-left:25px;background-image: url('../../Assets/images/icons/add.svg');"> 
    Add batch</button>
  </div>
</div>


<div class="session-table">
    <!-- Table -->
    <table class="table table-light table-hover" id="session_table" style="width:100%">
            <thead>
            <tr>
                <th scope="col">Batch</th>
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
                    <td><?php echo 'a' ?></td>
                    <td>
                    <a 
                        href="?showModal=true"  
                        type="button" 
                        class="btn btn-primary-soft button-icon btn-icon-view" 
                        style="padding-top: 12px;padding-bottom: 12px;"
                    > 
                        Remove
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

<?php
  include '../../Components/modal.php';
  include '../../Components/Modals/addBatchModal.php';
  include  BASE_DIR . 'footertop.php';
?>

<script src="/UniversityAttendanceSystem/src/js/displayCard.js"></script>
<script src="/UniversityAttendanceSystem/src/js/facultyAndDepartmentDropdownForAddBatch.js"></script>
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
    }else if (showModal === 'true' && status==='viewBatch') {
        // show the modal popup
        $('#studentProfile').modal('show');
    }
    });
</script>

<!-- Scripts for DataTables -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function () {
  $("#session_table").DataTable();
});
</script>

<?php
  include  BASE_DIR . 'footer.php';
?>