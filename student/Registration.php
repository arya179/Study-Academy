<?php
session_start();
include "../inc/function.php";
// include "../inc/links.php";
require '../db/dbcon.php';

error_reporting(0);
?>

<!DOCTYPE html>
  <html>
    <head>
      <meta charset="UTF-8">
	    <title>Student Registration</title>
        <link rel="stylesheet" type="text/css" href="css/Registration.css">
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">   
        <link href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap" 
    rel="stylesheet"> -->
    </head>
    <body>
       <form action="Registration.php" method="post">
		<div class="box">
		<h1>Please-Register</h1>
		<table align="center">
            <tr >
				<td><label for="enrollment">Enrollment No: </lable></td>
				<td><input type="num" id="name" name="enrollment" autocomplete="off" placeholder="Enrollment Number" require><br/></td>
			</tr>
			<tr >
				<td><label for="username">User Name: </label></td>
				<td><input type="text" id="name" name="username" autocomplete="off" placeholder="Enter UserName" require><br/></td>
			</tr>			
			<tr>
				<td><label for="email">E-mail: </label></td>
				<td><input type="email" id="name" name="email" autocomplete="off" placeholder="Enter Email" require><br/></td>
			</tr>
			<tr>
				<td><label for="mobile">Contact Number: </label></td>
				<td><input type="num" id="name" name="mobile" autocomplete="off" placeholder="Enter ContactNumber" require><br/></td>
			</tr>
			<tr>
				<td><label>Department:</label></td>
				<td><?php echo department(); ?></td>
			</tr>
			<tr>
            <td><label for="semester">Semester:</label></td>
				<td class="dpt"><?php echo semester(); ?></td>
			</tr>	
			<tr>
				<td><label>Password:</label></td>
				<td><input type="password" id="name" name="password" placeholder="Enter Password" require><br/></td>
			</tr>
			<tr >
				<td><label>Confirm Password:</label></td>
				<td><input type="password" id="name" name="cpassword" placeholder="Confirm Password" require><br/></td>
			</tr>
		</table>
		 <button class="btn" type="submit" name="btnRegi">
         <span>Register</span>
         </button>
    
		<div class="link">
                <a href="Login.php">Login here</a>
          </div>   
	</div>
    </form>
	<div class="heading">
		<h2>Registration</h2>
	  </div>
	  <div class="status">
		  <p>Create New Account To Use Website</p>
	  </div>     
</body>
</html>

<?php

if (isset($_POST['btnRegi'])) 
{
    $enrollment=$_POST['enrollment'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $d_id=$_POST['d_id'];
    $semester=$_POST['semester'];
    $password=$_POST['password'];
	$cpassword = $_POST["cpassword"];

	if($password !== $cpassword){
       $errors['password'] = "Confirm password not matched";
	}


//enrollment checking
	 $enrollment_check = "SELECT * FROM `student` WHERE enrollment = '$enrollment'";
	 $result = mysqli_query($con, $enrollment_check);
	 $numExistEnrollments = mysqli_num_rows($result);
	 if ($numExistEnrollments > 0) {
		 echo '<script type="text/javascript">
				 alert("User exists");
			 </script>';
	 }

//code for student
        $code = rand(1111111, 9999999);
        
// value insert query for registartion
    $q="INSERT INTO student (enrollment, username, email, mobile, d_id, semester, password, code, status) values ($enrollment,'$username','$email',$mobile,'$d_id','$semester','$password', '$code', 'inactive')";

    $status=mysqli_query($con,$q);
    if($status==1)
    {   
         echo'<script type="text/javascript">alert("Registration Successfully completed "); </script>';     	
        }
    if($status==0) 
    {
        echo'<script type="text/javascript">alert("There is a problem");</script>';
	}

}
?>