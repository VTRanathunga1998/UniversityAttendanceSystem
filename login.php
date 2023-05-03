<?php
    $page_title = 'Login';

    session_start();

    if(isset($_SESSION['userName'])){
        if($_SESSION['role'] == 'Admin'){
            header("Location:admin.php");
        } elseif ($_SESSION['role'] == 'Student'){
            header("Location:studentProfile.php");
        } elseif($_SESSION['role'] == 'Lecturer'){
            header("Location:lecturerProfile.php");
        }
    }
?>

<?php include 'src/Components/mainHeader.php' ?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php 
                    if(isset($_SESSION['status']))
                    {
                ?>  <div class="alert alert-<?php echo $_SESSION['state'] ?> alert-dismissible fade show" role="alert">
                        <h5><?php echo $_SESSION['status'] ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php          
                        unset($_SESSION['status']);
                        unset($_SESSION['state']);
                    
                    }
                ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Login Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="loginValidate.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                                                            
                            <div class="form-group mb-3">
                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                                <a href="forgotpassword.php" class="float-end link-success">Forgot password?</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<?php include 'src/Components/Modals/unsuccessModal.php' ?>

<script>
$(document).ready(function(){
    // check if the "showModal" parameter is present in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const showModal = urlParams.get('showModal');
    const status = urlParams.get('status');
    if (showModal === 'true' && status==='unsuccess') {
        // show the modal popup
        $('#unsuccess').modal('show');
        // hide the modal popup after 1 seconds
        setTimeout(function(){
        $('#unsuccess').modal('hide');
        }, 1000);
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</html>