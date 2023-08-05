<?php
session_start(); ?>

<?php include "../../../Components/mainHeader.php"; ?>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="../../../Assets/images/login.jpg"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form action="loginPhp.php" method="POST">
        <?php if (
            isset($_SESSION["status"])
        ) { ?>  <div class="alert alert-<?php echo $_SESSION[
      "state"
  ]; ?> alert-dismissible fade show" role="alert">
                            <h5><?php echo $_SESSION["status"]; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    unset($_SESSION["status"]);
                    unset($_SESSION["state"]);
                    } ?>
   
    

    
         <!-- Email input -->
          <div class="form-outline mb-4">
       
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

