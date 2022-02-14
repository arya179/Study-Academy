<?php 
// this is admin  header

	$current_uri=$_SERVER['SCRIPT_NAME'];
	$current_array=explode('/',$current_uri);
	$current_title=$current_array[count($current_array)-1];


	$page_title="";
	if ($current_title=="index.php") {
		$page_title="Dashboard";
	}elseif ($current_title=="edit_students.php") {
		$page_title="Edit Students";
	}elseif ($current_title=="view_students.php") {
		$page_title="View Students";
	}elseif ($current_title=="view_lectures.php" ) {
		$page_title="View Lectures";
	}elseif ($current_title=="edit_lectures.php") {
		$page_title="Edit Lectures";
	}elseif ($current_title=="upload_lectures.php") {
		$page_title="Upload Lectures";
	}elseif ($current_title=="view_materials.php") {
		$page_title="View Materials";
	}elseif ( $current_title=="edit_materials.php") {
		$page_title="Edit Materials";
	}elseif ($current_title=="upload_materials.php") {
		$page_title="Upload Materials";
	}elseif ($current_title=="add_questions.php" ) {
		$page_title="Add Questions in Group";
	}elseif ($current_title=="view_questions.php") {
		$page_title="View Questions of Group";
	}elseif ($current_title=="add_faculty.php" ) {
		$page_title="Add Faculty";
	}elseif ( $current_title=="view_faculty.php") {
		$page_title="View Faculty";
	}elseif ( $current_title=="edit_faculty.php") {
		$page_title="Edit Faculty";
	}elseif ($current_title=="add_group.php" ) {
		$page_title="Add Group";
	}elseif ( $current_title=="view_groups.php") {
		$page_title="View Groups";
	}elseif ($current_title=="subjects.php") {
		$page_title="Manage Subjects";
	}elseif ($current_title=="given_exam.php") {
		$page_title="Manage Results";
	}elseif ($current_title=="comments.php") {
			$page_title="Comments";
	}elseif ($current_title=="edit_comments.php") {
			$page_title="Edit Comment";
	}elseif ($current_title=="edit_notice.php") {
			$page_title="Edit Notice";
	}elseif ($current_title=="notice.php") {
			$page_title="Notice";
	}else{
		$page_title="Dashboard";
	}

	?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<?php include 'links.php'; ?>
		<title><?php echo $page_title; ?></title>		
		
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
		<style>

			table,th,td,p, center {
        		font-size: 12px;
		    }
		    .ts tbody tr:nth-of-type(odd) {
        		background-color: rgba(0, 0, 0, 0.05);
    		}
    		.thover tbody tr:hover {
			    color: #212529;
			    background-color: #ffe8a1;
			}
    		.ahover:hover {
			    color: #212529;
			    background-color: #ffe8a1;
			}

			@font-face{font-family:"sans-serif";font-weight:normal;font-style:normal }
			body {
			background: #56CCF2;
			/* background: -webkit-linear-gradient(to right, #2F80ED, #56CCF2); */
			background: linear-gradient(to right, #2F80ED, #56CCF2);
			}
			.dropdown {
			position: relative;
			display: block;
			min-width: 100px;
				margin-left: 4px ;
			}
			.dropdown ul li{
			font-size: 13px;
			}
			.dropdown ul li:hover{
			color: #ECE9E6;
			text-shadow: 0 0 20px #ECE9E6;
			}
			.dropdown-content {
			font-size: 12px;
			display: none;
			position: absolute;
			background-color: #06aaf0;
			min-width: 100px;
			box-shadow: 0px 4px 12px 0px rgba(0,0,0,0.2);
			z-index: 1;
			}
			.dropdown-content a {
				color: black;
				padding: 4px 8px;
				text-decoration: none !important;
				display: block;
			}
			.sub-menu{
				display: none;
			}
			.dropdown-content a:hover {
				background-color: #ECE9E6;
				text-shadow: 0 0 20px #ECE9E6;
			box-shadow: 0 0 20px black;
			}
			.me:hover .sub-menu {
				position: absolute;
				display: block;
				margin-top: -50px;
				background-color: #06aaf0;
		}
			
			.dropdown:hover .dropdown-content {display: block;}
			.dropdown:hover .dropbtn2 {background-color: #060d0f;}
		</style>
	</head>
	<body>
		<header>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
				<a class="navbar-brand active ml-5" href="index.php"><i class="fas fa-user" style="color: #56CCF2;"></i>&nbsp;Admin</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto ">
						<!-- Faculty Starts -->
						<div class="dropdown">
							<ul class="navbar-nav mr-auto dropbtn2 nav-link">
								<li class="nav-link ml-2" style="margin-right: 15px;"><i class="fas fa-user-graduate" style="color: #56CCF2; "></i>&nbsp;Faculty</li>
							</ul>
							<div class="dropdown-content" style="min-width: 140px;">
								<a href="add_faculty.php">Register Faculty</a>
								<li class="me">
									<a href="javascript:void(0)">View Faculty</a>
									<div class="sub-menu" style="margin-left: 130px;">
										<a href="view_faculty.php?d_id=1">Civil Engineering</a>
										<a href="view_faculty.php?d_id=2">Computer Engineering</a>
										<a href="view_faculty.php?d_id=3">Electrical Engineering</a>
										<a href="view_faculty.php?d_id=4">Mechanical Engineering</a>
									</div>
								</li>
							</div>
						</div>
						<!-- Faculty Ends -->
						<!-- Students Starts -->
						<div class="dropdown">
							<ul class="navbar-nav mr-auto dropbtn2 nav-link">
								<li class="nav-link ml-2" style="margin-right: 12px;"><i class="fas fa-users" style="color: #56CCF2;"></i>&nbsp;Students</li>
							</ul>
							<div class="dropdown-content" style="text-align: center; min-width: 150px;">
									<a href="view_students.php?d_id=1">Civil Engineering</a>
									<a href="view_students.php?d_id=2">Computer Engineering</a>
									<a href="view_students.php?d_id=3">Electrical Engineering</a>
									<a href="view_students.php?d_id=4">Mechanical Engineering</a>
							</div>
						</div>
						<!-- Students Edns -->
						<!-- Materials Starts -->
						<div class="dropdown">
							<ul class="navbar-nav mr-auto dropbtn2 nav-link">
								<li class="nav-link ml-2" style="margin-right: 10px;"><i class="fas fa-book" style="color: #56CCF2;"></i>&nbsp;Material</li>
							</ul>
							<div class="dropdown-content" style="text-align: center; min-width: 161px;">
								<a href="subjects.php">Subjects</a>
								<a href="upload_materials.php">Upload Material</a>
								<li class="me">
									<a >View Material</a>
									<div class="sub-menu" style="margin-left: 130px;">
										<a href="view_materials.php?d_id=1">Civil Engineering</a>
										<a href="view_materials.php?d_id=2">Computer Engineering</a>
										<a href="view_materials.php?d_id=3">Electrical Engineering</a>
										<a href="view_materials.php?d_id=4">Mechanical Engineering</a>
									</div>
								</li>
							</div>
						</div>
						<!-- Materials Ends -->

						<!-- Lectures Starts -->
						<div class="dropdown">
							<ul class="navbar-nav mr-auto dropbtn2 nav-link">
								<li class="nav-link ml-2" style="margin-right: 14px;"><i class="fas fa-file-video" style="color: #56CCF2;"></i>&nbsp;Lectures</li>
							</ul>
							<div class="dropdown-content" style="min-width: 161px;">
								<a href="upload_lectures.php">Upload Lectures</a>
								<li class="me">
									<a >View Lectures</a>
									<div class="sub-menu" style="text-align: center; margin-left: 160px;">
										<a href="view_lectures.php?d_id=1">Civil Engineering</a>
										<a href="view_lectures.php?d_id=2">Computer Engineering</a>
										<a href="view_lectures.php?d_id=3">Electrical Engineering</a>
										<a href="view_lectures.php?d_id=4">Mechanical Engineering</a>
									</div>
								</li>
							</div>
						</div>
						<!-- Lectures Ends -->

						<!-- MCQs Starts -->
						<div class="dropdown">
							<ul class="navbar-nav mr-auto dropbtn2 nav-link">
								<li class="nav-link ml-2" style="margin-right: 14px;"><i class="fas fa-file-video" style="color: #56CCF2;"></i>&nbsp;MCQs</li>
							</ul>
							<div class="dropdown-content " style="text-align: center; min-width: 180px;">
								<div class="dropdown-content" style="text-align: center; min-width: 170px;">
									<li class="me">
										<a >Civil Engineering</a>
										<div class="sub-menu" style="text-align: center; margin-left: 160px;">
											<?php 
												for ($i=1; $i <=8 ; $i++) { 
													
														echo '<a href="add_mcq_unit_select.php?d_id=1&semester='.$i.'">Semester&nbsp;'.$i.'</a>';
												}
											?>
										</div>
									</li>
								
									<li class="me">
										<a >Computer Engineering</a>
										<div class="sub-menu" style="text-align: center; margin-left: 160px;">
											<?php 
												for ($i=1; $i <=8 ; $i++) { 
													
														echo '<a href="add_mcq_unit_select.php?d_id=2&semester='.$i.'">Semester&nbsp;'.$i.'</a>';
												}
											?>
										</div>
									</li>
									<li class="me">
										<a >Electrical Engineering</a>
										<div class="sub-menu" style="text-align: center; margin-left: 160px;">
											<?php 
												for ($i=1; $i <=8 ; $i++) { 
													
														echo '<a href="add_mcq_unit_select.php?d_id=3&semester='.$i.'">Semester&nbsp;'.$i.'</a>';
												}
											?>
										</div>
									</li>
									<li class="me">
										<a>Mechanical Engineering</a>
										<div class="sub-menu" style="text-align: center; margin-left: 160px;">
											<?php 
												for ($i=1; $i <=8 ; $i++) { 
													
														echo '<a href="add_mcq_unit_select.php?d_id=4&semester='.$i.'">Semester&nbsp;'.$i.'</a>';
												}
											?>
										</div>
									</li>
								</div>
							</div>
						</div>
						<!-- MCQs Ends -->
						

						<!-- Questions Starts -->
						<div class="dropdown">
							<ul class="navbar-nav mr-auto dropbtn2 nav-link" >
								<li class="nav-link ml-2" style="margin-right: 10px;"><i class="fas fa-comment" style="color: #56CCF2; margin-left: -10px"></i>&nbsp;Questions</li>
							</ul>
							<div class="dropdown-content " style="text-align: center; min-width: 180px;">
								<div class="dropdown-content" style="text-align: center; min-width: 170px;">
									<li class="me">
										<a >Civil Engineering</a>
										<div class="sub-menu" style="text-align: center; margin-left: 160px;">
											<?php 
												for ($i=1; $i <=8 ; $i++) { 
													
														echo '<a href="ask_question.php?d_id=1&semester='.$i.'">Semester&nbsp;'.$i.'</a>';
												}
											?>
										</div>
									</li>
								
									<li class="me">
										<a >Computer Engineering</a>
										<div class="sub-menu" style="text-align: center; margin-left: 160px;">
											<?php 
												for ($i=1; $i <=8 ; $i++) { 
													
														echo '<a href="ask_question.php?d_id=2&semester='.$i.'">Semester&nbsp;'.$i.'</a>';
												}
											?>
										</div>
									</li>
									<li class="me">
										<a >Electrical Engineering</a>
										<div class="sub-menu" style="text-align: center; margin-left: 160px;">
											<?php 
												for ($i=1; $i <=8 ; $i++) { 
													
														echo '<a href="ask_question.php?d_id=3&semester='.$i.'">Semester&nbsp;'.$i.'</a>';
												}
											?>
										</div>
									</li>
									<li class="me">
										<a>Mechanical Engineering</a>
										<div class="sub-menu" style="text-align: center; margin-left: 160px;">
											<?php 
												for ($i=1; $i <=8 ; $i++) { 
													
														echo '<a href="ask_question.php?d_id=4&semester='.$i.'">Semester&nbsp;'.$i.'</a>';
												}
											?>
										</div>
									</li>
								</div>
							</div>
						</div>
						<!-- Questions Ends -->
						<div class="dropdown">
							<ul class="navbar-nav mr-auto dropbtn2 nav-link">
								<li class="nav-link ml-2" style="margin-right: 24px;"><i class="fas fa-bell" style="color: #56CCF2;"></i>&nbsp;Notice</li>							</ul>
							<div class="dropdown-content" style="text-align: center; min-width: 175px;">
									<a href="notice.php?d_id=1">Civil Engineering</a>
									<a href="notice.php?d_id=2">Computer Engineering</a>
									<a href="notice.php?d_id=3">Electrical Engineering</a>
									<a href="notice.php?d_id=4">Mechanical Engineering</a>
							</div>
						</div>
		

						<!-- Group Starts -->
						<div class="dropdown">
							<ul class="navbar-nav mr-auto dropbtn2 nav-link">
								<li class="nav-link ml-2" style="margin-right: 20px;"><i class="fas fa-pen" style="color: #56CCF2;"></i>&nbsp;Exam</li>
							</ul>
							<div class="dropdown-content " style="text-align: center;">
								<a href="add_group.php">Add Exam Group</a>
								<li class="me">
									<a href="javascript:void(0)">View Group Details</a>
									<div class="sub-menu" style="text-align: center; margin-left: 100px;">
										<a href="view_groups.php?d_id=1">Civil Engineering</a>
										<a href="view_groups.php?d_id=2">Computer Engineering</a>
										<a href="view_groups.php?d_id=3">Electrical Engineering</a>
										<a href="view_groups.php?d_id=4">Mechanical Engineering</a>
									</div>
								</li>
							</div>
						</div>
						<!-- Group Ends -->

						<!-- Exam Starts -->
						<div class="dropdown">
							<ul class="navbar-nav mr-auto dropbtn2 nav-link">
								<li class="nav-link ml-2" style="margin-right: 18px;"><i class="fas fa-file-alt" style="color: #56CCF2;"></i>&nbsp;Result</li>
							</ul>
							<div class="dropdown-content " style="text-align: center;">
								<a href="">Generate Result</a>
								<a href="">View Result</a>
							</div>
						</div>
						<!-- Exam Ends -->

						<!-- Logout starts -->
						<div class="dropdown ">
							<ul class="navbar-nav dropbtn2" style="margin-left: 15px;">
								<li class="nav-link ml-2" style="margin-right: 22px;">
									<a class="nav-link" href="../admin/Logout.php"><i class="fas fa-power-off" style="color: #56CCF2;"></i>&nbsp;Logout</a>
								</li>
							</ul>
						</div>
						<!-- Logout ends -->

						<!-- <form class="form-inline my-2 my-lg-0">
								<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
								<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
						</form> -->
					</ul>
					</div>
				</nav>
			</header>
		</body>