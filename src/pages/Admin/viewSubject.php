<?php
  define('BASE_DIR', '../../Components/');

  include_once '../../../database.php';

  // Set page title
  $page_title = "Dashboard view subjects";

  //Set the heading
  $head_title = "Dashboard";

  //Sub Title
  $sub_title = "View subject";

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
    <button type="button" class="btn btn-primary button-icon" data-bs-toggle="modal" data-bs-target="#addSubject" style="margin-left:25px;background-image: url('../../Assets/images/icons/add.svg');"> 
    Add subject</button>
  </div>
</div>


<div class="session-table">
    <!-- Table -->
    <table class="table table-light table-hover" id="session_table" style="width:100%">
            <thead>
            <tr>
                <th scope="col">Subject code</th>
                <th scope="col">Subject name</th>
                <th scope="col">Faculty</th>
                <th scope="col">Department</th>
                <th scope="col">Events</th>
            </tr>
            </thead>
            <tbody>
            <?php
                try{
                $sql = "SELECT s.subCode, s.subName, d.depName, f.facName
                        FROM Subject s
                        JOIN Department d ON s.depID = d.depID
                        JOIN Faculty f ON d.facID = f.facID";
                $result = mysqli_query($connect,$sql);
                while($row=$result->fetch_assoc()){
                  
            ?>    
                <tr>
                    <td><?php echo $row['subCode'] ?></td>
                    <td><?php echo $row['subName'] ?></td>   
                    <td><?php echo $row['facName'] ?></td>
                    <td><?php echo $row['depName'] ?></td>
                    <td>
                      <div style="display:flex;justify-content:center;gap:1rem;">
                        <a 
                            href="?showModal=true&subCode=<?php echo $row['subCode'] ?>&subName=<?php echo $row['subName'] ?>&status=editSubject"  
                            type="button" 
                            class="btn btn-primary-soft button-icon btn-icon-edit" 
                            style="padding-top: 12px;padding-bottom: 12px;"
                        > 
                            Edit
                        </a>
                        <a 
                            href="?showModal=true&subCode=<?php echo $row['subCode'] ?>&status=removeSubject"  
                            type="button" 
                            class="btn btn-primary-soft button-icon btn-icon-remove" 
                            style="padding-top: 12px;padding-bottom: 12px;"
                        > 
                            Remove
                        </a>
                      </div>
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
  include '../../Components/Modals/addSubjectModal.php';
  include '../../Components/Modals/editSubjectModal.php';
  include '../../Components/Modals/removeSubjectModal.php';
  include  BASE_DIR . 'footertop.php';
?>

<script src="/UniversityAttendanceSystem/src/js/displayCard.js"></script>
<script src="/UniversityAttendanceSystem/src/js/facultyAndDepartmentDropdownForAddSubject.js"></script>
<script src="/UniversityAttendanceSystem/src/js/facultyAndDepartmentDropdownForEditSubject.js"></script>
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
    }else if (showModal === 'true' && status==='viewSubject') {
        // show the modal popup
        $('#studentProfile').modal('show');
    }else if(showModal === 'true' && status==='editSubject'){
         // show the modal popup
         $('#editSubject').modal('show');
    }else if(showModal === 'true' && status==='removeSubject'){
        // show the modal popup
        $('#removeSubject').modal('show');
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