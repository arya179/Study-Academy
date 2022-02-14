<?php
include '../inc/top.php';
require '../db/dbcon.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	

	$message = "";
	$flag=true;
	
// if (empty($_POST["enrollment"])) {
// $_SESSION['enroll']= "Please enter your Enrollment";
// $flag = false;
// }

// if(empty($_POST["name"])) {
// $_SESSION['fname']= "Please enter your email ";
// $flag = false;
// }

// if(empty($_POST["mobile"])) {

// $_SESSION['mail']= "Please enter your email ";
// $flag = false;
// }

// if(empty($_POST["email"])) {
// $_SESSION['mob']= "Please enter your mobile ";
// $flag = false;
// }

// if(empty($_POST["department"])) {

// $_SESSION['dep']="Please enter your department ";
// $flag = false;
// }

// if(empty($_POST["semester"])) {

// $_SESSION['sem']= "Please enter your semester ";
// $flag = false;
// }

// if(empty($_POST["password"])) {

// $_SESSION['pass']= "Please enter your password ";
// $flag = false;
// }
	if($flag == true){

	$faculty_id = mysqli_real_escape_string($con, $_POST["faculty_id"]);
	$username = mysqli_real_escape_string($con, $_POST["username"]);
	$mobile = mysqli_real_escape_string($con, $_POST["mobile"]);
	$email = mysqli_real_escape_string($con, $_POST["email"]);
	$department = mysqli_real_escape_string($con, $_POST["department"]);
	$password = mysqli_real_escape_string($con, $_POST["password"]);
	// $cpassword = mysqli_real_escape_string($con, $_POST["cpassword"]);

	//enrollment checking
	$enrollment_check = "SELECT * FROM `faculty` WHERE faculty_id=$faculty_id";
	$result = mysqli_query($con, $enrollment_check);
	$numExistEnrollments = mysqli_num_rows($result);
	
	if ($numExistEnrollments > 0) {
		echo '<script type="text/javascript">
				alert("User exists");
			</script>';
	} else {
			//password hashing with default hashing type
			// $password_hash = password_hash($password, PASSWORD_DEFAULT);
			$code =rand(111111,999999);
			
			$sql = "INSERT INTO `faculty` (`faculty_id`, `username`, `mobile`, `email`, `d_id`, `password`, `code`, `status`) VALUES ('$faculty_id', '$username', '$mobile', '$email', '$department', '$password', '$code', 'offline')";
			//instert data query
			$InsertRecord = mysqli_query($con, $sql);
			if (!$InsertRecord) {// if any erroe in inserting
			$error = mysqli_error($con);
			echo "<center><h2>No reocrds inserted !!<br>" . $error . "<h2></center>";
			}
			// header('location:stu_login.php');
			// } else {
			//  echo "<script type='text/javascript'>
					//           	   	alert('Registration Successfully completed');
			//              </script>";
			// }
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- <link rel="stylesheet" href="../css/reg.css"> -->
		<?php include '../inc/links.php';?>
		<title>Registration</title>
	</head>
	<body class="bg-info">
		<div class="container ">
			<div class="col-11">
				<div class="col-md-8 offset-md-2 bg-light p-5 mt-3 rounded">
					<form action="add_faculty.php" method="POST">
						<h2 align="center">Register here</h2>
						<div class="form-group ">
							<label for="faculty_id">Faculty Id:</label>
							<input type="text" name="faculty_id" placeholder="faculty_id" class="form-control">
							<?php if (isset($_SESSION['enroll'])) {
							?><span class="text-danger"><?php echo $_SESSION['enroll']; ?></span>
							<?php
							// session_unset();
							} ?>
						</div>
						
						<div class="form-group">
							<label for="username">Username:</label>
							<input type="Text" name="username" placeholder="Enter username" class="form-control">
							<?php if (isset($_SESSION['fname'])) {
							?><span class="text-danger"><?php echo $_SESSION['fname']; ?></span>
							<?php
							// session_unset();
							} ?>
						</div>
						
						<div class="form-group">
							<label for="mobile">Mobile No:</label>
							<input type="text" name="mobile" placeholder="Enter your mobile number" class="form-control">
							<?php if (isset($_SESSION['mob'])) {
							?><span class="text-danger"><?php echo $_SESSION['mob']; ?></span>
							<?php
							// session_unset();
							} ?>
						</div>
						<div class="form-group">
							<label for="email">E-mail:</label>
							<input type="text" name="email" placeholder="Enter your email address" class="form-control">
							<?php if (isset($_SESSION['mail'])) {
							?><span class="text-danger"><?php echo $_SESSION['mail']; ?></span>
							<?php
							// session_unset();
							} ?>
						</div>
						
						<div class="form-group">
							<div class="row">
							<label>&nbsp;&nbsp;&nbsp;&nbsp;Department:</label>
							<?php echo department();
							if (isset($_SESSION['dep'])) {
							?><span class="text-danger"><?php echo $_SESSION['dep']; ?></span>
							<?php
							// session_unset();
							} ?>
						</div>
						</div>
						<div class="form-group">
							<label>Password:</label>
							<input type="password" name="password" placeholder="New password" class="form-control">
							<?php if (isset($_SESSION['pass'])) {
							?><span class="text-danger"><?php echo $_SESSION['pass']; ?></span>
							<?php
							// session_unset();
							} ?>
						</div>
						<center>    <button class="btn btn-primary" name="submit" type="submit">Register</button>
						<a href="index.php" class="btn btn-primary" name="submit" type="submit">Home</a></center>
						
					</form>
				</div>
			</div>
		</div>
	</body>
</html>