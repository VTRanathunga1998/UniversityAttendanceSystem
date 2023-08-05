<?php

ob_start();

include '../../../../database.php';?>

<?php include '../../../Components/mainHeader.php' ?>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="../../../Assets/images/login.jpg"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form action="" method="POST">
      
   
        <?php
        if (isset($_SESSION['noUser'])) {
          echo $_SESSION['noUser'];
          unset($_SESSION['noUser']);
        }
        ?>

    
         <!-- Email input -->
          <div class="form-outline mb-4">
            <?php
          if (isset($_SESSION['loginMessage'])) {
            echo $_SESSION['loginMessage'];
            unset($_SESSION['loginMessage']);
          }?>
            <input type="text" id="username" class="form-control form-control-lg"
              placeholder="Enter a valid User Name" name="username" />
            <label class="form-label" for="username">User Name</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" id="password" class="form-control form-control-lg"
              placeholder="Enter password" name="password" />
            <label class="form-label" for="password">Password</label>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                Remember me
              </label>
            </div>
            <a href="#!" class="text-body">Forgot password?</a>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;" name="submit" >Login</button>
          
          </div>

        </form>
      </div>
    </div>
  </div>

</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>
</html>
<?php
if (isset($_POST['submit'])) {
 
  $userName = $_POST['username'];
  $pass = $_POST['password'];
  $sql = "SELECT * FROM user WHERE userName = '$userName'";
  $result = mysqli_query($connect, $sql);
  $count = mysqli_num_rows($result);

  echo $userName;

  if ($count == 1) {
    echo "========================";
    // If user exists, fetch the user's hashed password from the database
    $row = mysqli_fetch_assoc($result);
    $hashedPassword = $row['password'];
    echo $hashedPass;
    // Verify the provided password against the hashed password
    if (password_verify($pass, $hashedPassword)) {
      $_SESSION['loginMessage'] = '<span class="success">Welcome ' . $userName . '</span>';
      header('location: http://localhost/UniversityAttendanceSystem/index.php');
      exit();
    } else {
      $_SESSION['loginMessage'] = '<span class="fail" style="background-color: red; padding: 5px 10px; color: white; border-radius: 5px; display: inline-block;">Incorrect password!</span>';
      header('location: http://localhost/UniversityAttendanceSystem/src/pages/admin/login/login.php');
      exit();
    }
  } else {
    $_SESSION['loginMessage'] = '<span class="fail" style="background-color: red; padding: 5px 10px; color: white; border-radius: 5px; display: inline-block;">User not registered!</span>';
    header('location: http://localhost/gym/register/register.php');
    exit();
  }
}
ob_flush();
?>
