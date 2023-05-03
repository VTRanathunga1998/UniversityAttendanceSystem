<?php

    session_start();

    if(isset($_SESSION['userName'])){
        if($_SESSION['userName'] == 'Admin'){
            header("Location:adminProfile.php");
        } elseif ($_SESSION['userName'] == 'Student'){
            header("Location:studentProfile.php");
        } elseif($_SESSION['userName'] == 'Lecturer'){
            header("Location:lecturerProfile.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($page_title)) { echo $page_title; }?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>

  <div class="bg-dark">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Attendance System</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="index.php">Home</a>
                            </li>

                            <?php if(!isset($_SESSION['userName'])) : ?>
                                  <li class="nav-item">
                                  <a class="nav-link" href="register.php">Register</a>
                                  </li>
                                  <li class="nav-item">
                                  <a class="nav-link active" href="login.php">Login</a>
                                  </li>
                            <?php endif ?>

                            <?php if(isset($_SESSION['userName'])) : ?>
                                <li class="nav-item">
                                <a class="nav-link" href="logout.php">Log out</a>
                                </li>
                            <?php endif ?>

                        </ul>

                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
      
  </div>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">                   
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Reset password</h5>
                        </div>
                        <div class="card-body">
                            <form action="passwordResetCode.php" method="POST">
                                <div class="form-group mb-3">
                                    <label for="">Username</label>
                                    <input type="text" name="userName" class="form-control" required>
                                </div>
                            
                                <div class="form-group mb-3">
                                    <button type="submit" name="password_reset_link" class="btn btn-primary">Get reset link</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <?php include 'UniversityAttendanceSystem/src/Components/Modals/successModal.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    


</html>