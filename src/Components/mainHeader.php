<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($page_title)) { echo $page_title; }?></title>
    <!--Jquery-->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!--Ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="login.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>

<div class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="index.php">Attendance System </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                            <?php if(!isset($_SESSION['userName'])) : ?>
                        
                                <li class="nav-item">
                                    <a class="nav-link <?php if(isset($page_title) && $page_title == 'Login') echo 'active'; ?>" href="/UniversityAttendanceSystem/src/pages/Admin/login/login.php">Login</a>
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