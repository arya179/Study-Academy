<?php
//this is header for faculty portal
session_start();
include 'function.php';
	if(!isset($_SESSION['faculty']) OR $_SESSION['faculty']!= true)
    {
		session_abort();
		redirect("Login.php");
	} 

	// prx($_SERVER);
	$current_uri=$_SERVER['SCRIPT_NAME'];
	$current_array=explode('/',$current_uri);
	$current_title=$current_array[count($current_array)-1];
	// prx($current_title);

	$page_title="";
	if ($current_title=="index.php") {
		$page_title="Home";
	}elseif ($current_title=="view_students.php") {
		$page_title="View Students";
	}elseif ($current_title=="view_lectures.php") {
		$page_title="View Lectures";
	}elseif ($current_title=="edit_lectures.php") {
		$page_title="Edit Lectures";
	}elseif ($current_title=="upload_lectures.php") {
		$page_title="Upload Lectures";
	}elseif ($current_title=="view_materials.php") {
		$page_title="View Materials";
	}elseif ($current_title=="edit_materials.php") {
		$page_title="Edit Materials";
	}elseif ($current_title=="upload_materials.php") {
		$page_title="Upload Materials";
	}elseif ($current_title=="add_questions.php"){
		$page_title="Add Questions";
	}elseif ($current_title=="edit_questions.php"){
		$page_title="Edit Questions";
	}elseif ($current_title=="view_questions.php") {
		$page_title="View Questions";
	}elseif ($current_title=="notice.php") {
		$page_title="Noice";
	}elseif ($current_title=="edit_comments.php") {
			$page_title="Edit Comment";
	}elseif ($current_title=="comments.php") {
			$page_title="Comments";
	}elseif ($current_title=="view_groups.php") {
		$page_title="View Groups";
	}elseif ($current_title=="given_exam.php") {
		$page_title="Manage Results";
	}elseif ($current_title=="view_results.php") {
		$page_title="View Results";
	}else{
		$page_title="Home";
	}

include 'constant.php';
require '../db/dbcon.php';

if (isset($_SESSION['d_id'])) 
{
	$d_id =$_SESSION['d_id'];
}else{
	echo "Please Login Again";
}

date_default_timezone_set("Asia/Kolkata");

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<?php include 'links.php'; ?>
		<title><?php echo $page_title; ?></title>
		<style>
			table,th,td, center {
        		font-size: 12px;
		    }
		    .ts tbody tr:nth-of-type(odd) {
        		background-color: rgba(0, 0, 0, 0.05);
    		}
    		.thover tbody tr:hover {
			    color: #212529;
			    background-color: #ffe8a1;
			}


			@font-face{font-family:"sans-serif";}
			body {
		    background: #00c6ff;  
            /* background: -webkit-linear-gradient(to right, #0072ff, #00c6ff);   */
            background: linear-gradient(to right, #0072ff, #00c5ff); 
 
		}
		.dropdown {
		    position: relative;
		    display: block;
		    min-width: 100px;
		    margin-left: 4px ;	
		}
		.dropdown ul li{
		    font-size: 13px;
            color: #04ecfd;
         }
		.dropdown ul li:hover{
		    color: #ECE9E6;
		    text-shadow: 0 0 15px #ECE9E6;
		}
		.dropdown-content {
			font-size: 12px;
		    display: none;
		    position: absolute;
		    background-color: #0072ff;
		    min-width: 90px;
			box-shadow: 0px 4px 12px 0px rgba(0,0,0,0.2);
			z-index: 1;
		  }
		  .dropdown-content a {
			    color: black;
			    padding: 4px 8px;
			    text-decoration: none;
			    display: block;
		  }
		  .sub-menu{
			display: none;
		  }
		  .me:hover .sub-menu {
			  position: absolute;
			  display: block;
			  margin-top: -50px;
			  background-color: #0072ff;
		  }
		.dropdown-content a:hover {
            background-color: #ECE9E6;
            text-shadow: 0 0 20px #ECE9E6;
		    box-shadow: 0 0 20px black;
        }
		.dropdown:hover .dropdown-content{
            display: block;
        }
		.dropdown:hover .dropbtn2 {background-color: #060d0f;}

		</style>
	</head>
	<body>

		<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
			<a class="navbar-brand active ml-5" style="margin-right: 30px" href="../faculty/Index.php"><i class="fas fa-user" style="color: #04ecfd;"></i>&nbsp;User</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto ">
		
		<!-- Students Starts -->
			<div class="dropdown">
				<ul class="navbar-nav mr-auto dropbtn2 nav-link">
				  	<li class="nav-link ml-2" style="margin-right: 33px;"><i class="fas fa-users" style="color: #04ecfd;"></i>&nbsp;Students</li>
				</ul>
				<div class="dropdown-content" style="text-align: center; min-width: 130px;">
					    <?php
						if(isset($d_id))
						{
							
								echo '<a href="view_students.php?d_id='.$d_id.'">View Student</a>';
					}else{
							echo'Please login again';
						} 
						?>
				  </div>
				</div>
		<!-- Students End -->

		<!-- Material Starts -->
				<div class="dropdown">
				  <ul class="navbar-nav mr-auto dropbtn2 nav-link">
				  	<li class="nav-link ml-2" style="margin-right: 20px;"><i class="fas fa-book" style="color: #04ecfd;"></i>&nbsp;Material</li>
				  </ul>
				  <div class="dropdown-content" style="text-align: center; min-width: 125px;">
						<a href="upload_materials.php">Upload Material</a>
						<?php
						if(isset($d_id))
						{
							// for ($i=0; $i <$no ; $i++) { 
								echo '<a href="view_materials.php?d_id='.$d_id.'">View Materical</a>';
						// }
					}else{
							echo'Please login again';
						} 
						?>&nbsp;
					</div>
				</div>
		<!-- Material End -->

		<!-- Lectures Starts -->
				<div class="dropdown">
				  <ul class="navbar-nav mr-auto dropbtn2 nav-link">
				  	<li class="nav-link ml-2" style="margin-right: 20px;"><i class="fas fa-file-video" style="color: #04ecfd;"></i>&nbsp;Lectures</li>
				  </ul>
				  <div class="dropdown-content" style="text-align: center; min-width: 133px;">
				  		<a href="upload_lectures.php">Upload Lectures</a>
						  <?php
						if(isset($d_id))
						{
							// for ($i=0; $i <$no ; $i++) { 
								echo '<a href="view_lectures.php?d_id='.$d_id.'">View Lectures</a>';
						// }
					}else{
							echo'Please login again';
						} 
						?>
						<a href="">View Responce</a>
					</div>
				</div>
		<!-- Lectures Ends -->
		
		<!-- MCQ Starts -->
		<div class="dropdown">
				  <ul class="navbar-nav mr-auto dropbtn2 nav-link" >
				  	<li class="nav-link ml-2" style="margin-right: 20px;"><i class="fas fa-comment" style="color: #04ecfd;"></i>&nbsp;MCQs</li>
				</ul>
				  <div class="dropdown-content " style="text-align: center; min-width: 100px;">
				  	<?php 
												for ($i=1; $i <=8 ; $i++) { 
													
														echo '<a href="add_mcq_unit_select.php?d_id='.$d_id.'&semester='.$i.'">Semester&nbsp;'.$i.'</a>';
												}
											?>
				  </div>
				</div>
        <!-- MCQ Ends -->

        <!-- Questions Starts -->
		<div class="dropdown">
				  <ul class="navbar-nav mr-auto dropbtn2 nav-link" >
				  	<li class="nav-link ml-2" style="margin-right: 20px;"><i class="fas fa-comment" style="color: #04ecfd;"></i>&nbsp;Ask Questions</li>
				</ul>
				  <div class="dropdown-content " style="text-align: center; min-width: 145px;">
				  	<?php 
												for ($i=1; $i <=8 ; $i++) { 
													
														echo '<a href="ask_question.php?d_id='.$d_id.'&semester='.$i.'">Semester&nbsp;'.$i.'</a>';
												}
											?>
				  </div>
				</div>
        <!-- Questions Ends -->
<div class="dropdown ">
						<ul class="navbar-nav dropbtn2 ">
							<li class="nav-link ml-2" style="margin-right: 16px;"><a class="nav-link" href="notice.php"><i class="fas fa-bell" style="color: #04ecfd;"></i>&nbsp;Notice</a></li>
						</ul>
					</div>
		<!-- Exam Starts -->
		<div class="dropdown">
			<ul class="navbar-nav mr-auto dropbtn2 nav-link">
				  		<li class="nav-link ml-2" style="margin-right: 20px;"><i class="fas fa-pen" style="color: #04ecfd; margin-left: -5px;"></i>&nbsp;Exam</li>
					</ul>
				  <div class="dropdown-content " style="text-align: center;" >
				  <?php
						if(isset($d_id))
						{
							// for ($i=0; $i <$no ; $i++) { 
								echo '<a href="view_groups.php?d_id='.$d_id.'">View Group Details</a>';
						// }
					}else{
							echo'Please login again';
						} 
						?>
				  </div>
				</div>
		<!-- Exam Ends -->

		<!-- Result Starts -->
		<div class="dropdown">
				  	<ul class="navbar-nav mr-auto dropbtn2 nav-link">
				  		<li class="nav-link ml-2" style="margin-right: 20px;"><i class="fas fa-file-alt" style="color: #04ecfd;"></i>&nbsp;Result</li>
					</ul>
				  	<div class="dropdown-content " style="text-align: center; min-width: 100px;">
					  <?php
						if(isset($d_id))
						{
								echo '<a href="view_results.php?d_id='.$d_id.'">View Result</a>';
					}else{
							echo'Please login again';
						} 
						?>
				 </div>
				</div>
		<!-- Result Ends -->
		<div class="dropdown ">	
					<ul class="navbar-nav dropbtn2" style="margin-left: 50px;">
						<li class="nav-link ml-2" style="margin-right: 20px;" ><a class="nav-link" href="../faculty/Logout.php"><i class="fas fa-power-off" style="color: #04ecfd;"></i>&nbsp;Logout</a></li>
					</ul>
	            </div>
	 	<!-- Logout starts -->

	       </ul>
	    </div>
		</nav>
	</header>
</body>
