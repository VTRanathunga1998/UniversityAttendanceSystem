<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<!-- Chart.js -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

	<link
      rel="stylesheet"
      href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"
    />

	<!-- My CSS -->
	<link rel="stylesheet" href="/UniversityAttendanceSystem/index.css">

	<!--Jquery-->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!--Ajax-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


	<title><?php if(isset($page_title)){echo "$page_title";} ?></title>
</head>
<body>

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text"><?php echo $_SESSION["userName"] ?></span>
		</a>
		<ul class="side-menu top">
			<li class=<?php if(isset($isDashboard)){echo "$isDashboard";} ?>>
				<a href="/UniversityAttendanceSystem/src/pages/Admin/admin.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class=<?php if(isset($isTakeattendance)){echo "$isTakeattendance";} ?>>
				<a href="/UniversityAttendanceSystem/src/pages/Admin/takeAttendance.php">
					<i class='bx bx-scan'></i>
					<span class="text">Take attendance</span>
				</a>
			</li>
			<li class=<?php if(isset($isViewAttendance)){echo "$isViewAttendance";} ?>>
				<a href="/UniversityAttendanceSystem/src/pages/Admin/viewAttendance.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">View attendance</span>
				</a>
			</li>
			
		</ul>
		<ul class="side-menu">
			<li class=<?php if(isset($isSetting)){echo "$isSetting";} ?>>
				<a href="/UniversityAttendanceSystem/src/pages/Admin/setting.php">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="/UniversityAttendanceSystem/logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link" hidden>Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search..." hidden>
					<button type="submit" class="search-btn" hidden><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification" hidden>
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<!-- <a href="#" class="profile">
				<img src="/UniversityAttendanceSystem/src/Assets/images/people.png">
			</a> -->
		</nav>
		<!-- NAVBAR -->
        <!-- MAIN -->
		<main>
            <div class="head-title">
				<div class="left">
					<h1><?php if(isset($head_title)){echo "$head_title";} ?></h1>
					<ul class="breadcrumb">
						<li>
							<a href="#"><?php if(isset($head_title)){echo "$head_title";} ?></a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#"><?php if(isset($sub_title)){echo "$sub_title";} ?></a>
						</li>
					</ul>
				</div>
				<div class="right" style="
					display: flex !important;
 					flex-direction: row !important;
					gap:1rem;
					align-items:center;
					justify-content:center;
					align-self:flex-start;
				">
					<div>
						<p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
							Today's Date
						</p>
						<h5 class="heading-sub12" style="padding: 0;margin: 0;">
							<?php 
								date_default_timezone_set('Asia/Kolkata');
								$today = date('Y-m-d');
								echo $today
							?>
						</h5>
					</div>
					<div>
						<button  
							class="btn"  
							style=
								"display: flex;
								justify-content: center;
								align-items: center; 
								border: none;
								margin:0;
							">
							<img src="/UniversityAttendanceSystem/src/Assets/images/calander.png" width="40px">
						</button>
					</div>	
				</div>				
			</div>