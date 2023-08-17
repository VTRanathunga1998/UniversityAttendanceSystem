<?php

    session_start();

    if(!isset($_SESSION['userName'])){
        header(
            "location: http://localhost/UniversityAttendanceSystem/src/pages/Admin/login/login.php"
        );
        exit();
    }
?>

<?php include 'src/Components/mainHeader.php' ?>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Change password</h5>
                        </div>
                        <div class="card-body">
                            <form action="passwordResetCode.php" method="POST">
                                <div class="form-group mb-3">
                                    <label for="">Password</label>
                                    <input type="password" name="pwd" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password is too weak. At least 8-12 characters long but 14 or more is better. A combination of uppercase letters, lowercase letters, numbers, and symbols" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Confirm password</label>
                                    <input type="password" name="confirmpwd" class="form-control" required>
                                </div>
                            
                                <div class="form-group mb-3 d-grid gap-2">
                                    <button type="submit" name="password_update" class="btn btn-success">Update password</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</html>