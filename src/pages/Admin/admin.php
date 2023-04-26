<?php

  session_start();

  include_once '../../../database.php';

  define('BASE_DIR', '../../Components/');

  try{

    $queryFacultyCount = "SELECT COUNT(facID) as facultyCount FROM faculty;";
    $queryDepartmentCount = "SELECT COUNT(depID) as departmentCount FROM department;";
    $queryLecturerCount = "SELECT COUNT(lecturerID) as lecturerCount FROM lecturer;";
    $queryStudentCount = "SELECT COUNT(RegNum) as studentCount FROM student;";
    $querySubjectCount = "SELECT COUNT(subCode) as subjectCount FROM subject;";
    $queryBatchCount = "SELECT COUNT(batch) as batchCount FROM batch;";
    $queryAdminCount = "SELECT COUNT(adminID) as adminCount FROM admin;";

    $queryFacultyCountResult = mysqli_fetch_array(mysqli_query($connect,$queryFacultyCount));
    $queryDepartmentCountResult = mysqli_fetch_array(mysqli_query($connect,$queryDepartmentCount));
    $queryLecturerCountResult = mysqli_fetch_array(mysqli_query($connect,$queryLecturerCount));
    $queryStudentCountResult = mysqli_fetch_array(mysqli_query($connect,$queryStudentCount));
    $querySubjectCountResult = mysqli_fetch_array(mysqli_query($connect,$querySubjectCount));
    $queryBatchCountResult = mysqli_fetch_array(mysqli_query($connect,$queryBatchCount));
    $queryAdminCountResult = mysqli_fetch_array(mysqli_query($connect,$queryAdminCount));

    $facultyCount = $queryFacultyCountResult['facultyCount'];
    $departmentCount = $queryDepartmentCountResult['departmentCount'];
    $lecturerCount = $queryLecturerCountResult['lecturerCount'];
    $studentCount = $queryStudentCountResult['studentCount'];
    $subjectCount = $querySubjectCountResult['subjectCount'];
    $batchCount = $queryBatchCountResult['batchCount'];
    $adminCount = $queryAdminCountResult['adminCount'];

  } catch(mysqli_sql_exception $e){
    header("Location:admin.php?showModal=true&status=unsuccess&message=Database error");
  }

?>


<?php
  // Set page title
  $page_title = "Admin Dashboard";

  //Set the heading
  $head_title = "Dashboard";

  //Sub Title
  $sub_title = "Home";

  //isActive
  $isDashboard = "active";
?>

<?php include BASE_DIR . 'header.php'; ?>



  <!-- Faculty card -->
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-sm-2 g-4 insights">
  <div class="col">
    <div class="card h-100 shadow dash-card" data-clickable="true" data-href="/UniversityAttendanceSystem/src/pages/Admin/viewFaculty.php">
      <div class="card-body">
        <div class="cb-left">
          <div>
            <h3 class="text-center"><?php echo $facultyCount; ?></h3>
          </div>
          <div>
            <span class="text-center">Faculties</span>
          </div>
        </div>
        <div class="cb-right">
          <img src="/UniversityAttendanceSystem/src/Assets/images/institution.png" width="50px" alt="img">
        </div>
      </div>
    </div>
  </div>

  <!-- Department card -->
  <div class="col">
    <div class="card h-100 shadow dash-card" data-clickable="true" data-href="/UniversityAttendanceSystem/src/pages/Admin/viewDepartment.php">
      <div class="card-body">
        <div class="cb-left">
        <div>
          <h3 class="text-center"><?php echo $departmentCount; ?></h3>
        </div>
        <div>
          <span class="text-center">Departments</span>
        </div>
      </div>
      <div class="cb-right">
        <img src="/UniversityAttendanceSystem/src/Assets/images/corporate.png" width="50px" alt="img">
      </div>
      </div>
    </div>
  </div>

  <!-- Lecturer card -->
  <div class="col">
    <div class="card h-100 shadow dash-card" data-clickable="true" data-href="/UniversityAttendanceSystem/src/pages/Admin/viewLecturer.php">
      <div class="card-body">
      <div class="cb-left">
        <div>
          <h3 class="text-center"><?php echo $lecturerCount; ?></h3>
        </div>
        <div>
          <span class="text-center">Lecturers</span>
        </div>
      </div>
      <div class="cb-right">
        <img src="/UniversityAttendanceSystem/src/Assets/images/teacher.png" width="50px" alt="img">
      </div>
      </div>
    </div>
  </div>

  <!-- Student card -->
  <div class="col">
    <div class="card h-100 shadow dash-card" data-clickable="true" data-href="/UniversityAttendanceSystem/src/pages/Admin/viewStudent.php">
      <div class="card-body">
        <div class="cb-left">
        <div>
          <h3 class="text-center"><?php echo $studentCount; ?></h3>
        </div>
        <div>
          <span class="text-center">Students</span>
        </div>
      </div>
      <div class="cb-right">
        <img src="/UniversityAttendanceSystem/src/Assets/images/student.png" width="50px" alt="img">
      </div>
      </div>
    </div>
  </div>

  <!-- Subject card -->
  <div class="col">
    <div class="card h-100 shadow dash-card" data-clickable="true" data-href="/UniversityAttendanceSystem/src/pages/Admin/viewSubject.php">
      <div class="card-body">
        <div class="cb-left">
        <div>
          <h3 class="text-center"><?php echo $subjectCount; ?></h3>
        </div>
        <div>
          <span class="text-center">Subjects</span>
        </div>
      </div>
      <div class="cb-right">
        <img src="/UniversityAttendanceSystem/src/Assets/images/book-stack.png" width="50px" alt="img">
      </div>
      </div>
    </div>
  </div>

  <!-- Batch card -->
  <div class="col">
    <div class="card h-100 shadow dash-card" data-clickable="true" data-href="/UniversityAttendanceSystem/src/pages/Admin/viewBatch.php">
      <div class="card-body">
        <div class="cb-left">
        <div>
          <h3 class="text-center"><?php echo $batchCount; ?></h3>
        </div>
        <div>
          <span class="text-center">Batches</span>
        </div>
      </div>
      <div class="cb-right">
        <img src="/UniversityAttendanceSystem/src/Assets/images/files.png" width="50px" alt="img">
      </div>
      </div>
    </div>
  </div>

  <!-- Admin card -->
  <div class="col">
    <div class="card h-100 shadow dash-card" data-clickable="true" data-href="/UniversityAttendanceSystem/src/pages/Admin/viewAdmin.php">
      <div class="card-body">
        <div class="cb-left">
        <div>
          <h3 class="text-center"><?php echo $adminCount; ?></h3>
        </div>
        <div>
          <span class="text-center">Admins</span>
        </div>
      </div>
      <div class="cb-right">
        <img src="/UniversityAttendanceSystem/src/Assets/images/admin.png" width="50px" alt="img">
      </div>
      </div>
    </div>
  </div>

</div>



<?php
  include BASE_DIR . 'modal.php'; 
  include  BASE_DIR . 'footertop.php';
?>

<script>
  $(document).ready(() => {
    $(document.body).on('click', '.card[data-clickable=true]', (e) => {
      var href = $(e.currentTarget).data('href');
      window.location = href;
    });
  });
</script>

<?php
  include  BASE_DIR . 'footer.php';
?>
