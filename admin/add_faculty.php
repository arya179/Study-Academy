<?php
include '../inc/top.php';
require '../db/dbcon.php';

$err=$success=$msg=$msgs=$department=$semester=$unit_id=$sub_id='';
if (isset($_POST['upload']) && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['admin_id'])) 
{
	$flag=true;
	$admin_id=$_SESSION['admin_id'];

if (empty($_POST['username'])||empty($_POST['department'])||empty($_POST['email'])||empty($_POST['mobile'])) {
		$flag=false;
		$msgs='<tr>
					<td colspan="2" align="center">
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Fields can not be empty!</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    		<span aria-hidden="true">&times;</span>
						 		</button>
						</div>
					</td>
				  </tr>';
	}
	$q="SELECT * FROM faculty WHERE {$_POST['mobile']}";

if (mysqli_num_rows(mysqli_query($con, $q))>0) {
		$flag=false;
		echo '<script type="text/javascript" charset="utf-8" async defer>alert("Faculty Registered Already!")</script>';
}elseif ($flag==true) {

    $username=safe_string($_POST['username']);
    $d_id=safe_string($_POST['department']);
    $email=safe_string($_POST['email']);
    $mobile=safe_string($_POST['mobile']);

    $password=rand(11111111, 99999999);//range 8
						
					$sql = "INSERT INTO faculty (username, d_id, email, mobile, password, status) values ('$username','$d_id','$email','$mobile', '$password', 'offline')";
					$result = mysqli_query($con, $sql);
					if ($result) {
					$dpt=mysqli_fetch_assoc(mysqli_query($con, "SELECT department FROM department"));					
						$success='<tr>
							<td colspan="2" align="center"><div class="alert alert-success alert-dismissible fade show" role="alert">
									  <strong>'.$username.'</strong> in <strong>'.$dpt["department"].' </strong>Sucessfully Registered! 
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									    <span aria-hidden="true">&times;</span>
									  </button>
								</div></td>
						</tr>';
				    }
				   
		} else {
			$err= '<tr>
					<td colspan="2" align="center"><div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong>Please fill all details!</strong>
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
				</div>
				</td>
						</tr>';
		}
	}


?>
    <body>
    	<div class="container bg-white">
		<div class="card-header">
			<div class="row">
				<div class="col-md-9">
					<h3 class="card-title text-lg-center ">Faculty Registration</h3>					
				</div>
				<div class="col-md-3" align="right">
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>" method="POST">
					<table class="table thover ts">
						
								<span class="text-success "><?php echo $success; ?></span>
								<span class="text-danger font-weight-bold"><?php echo $err; ?></span>
								<span class="text-danger"><?php echo $msgs; ?></span>
							<tr>
			<td><label for="username">Name: </label></td>
			<td><input class='form-control' type="text" id="name" name="username" autocomplete="off" placeholder="Enter UserName"><br/></td>
		</tr><tr>
			<td><label for="username">Email: </label></td>
			<td><input class='form-control' type="text" id="name" name="email" autocomplete="off" placeholder="Enter Email Address"><br/></td>
		</tr><tr>
			<td><label for="username">Mobile: </label></td>
			<td><input class='form-control' type="text" id="name" name="mobile" autocomplete="off" placeholder="Enter Mobile Number"><br/></td>
		</tr>
		<tr>
							
						<tr>
							<td id="label"><label>Department:</label></td>
							<td>
							<select class='form-control' id='department' name='department' size='1'>
								<option value='' selected='' disabled=''>Select Department</option>
								<?php

								    $SelectResult = mysqli_query($con, "SELECT * FROM department");

								    while ($d_id_row = mysqli_fetch_assoc($SelectResult)) {
								    	if ($d_id_row['d_id']==$d_id) {
								    		echo "<option value='".$d_id_row['d_id']."'selected>".$d_id_row['department']."</option>";
								    	}else{
								    		echo "<option value='".$d_id_row['d_id']."'>".$d_id_row['department']."</option>";
								    	}
								    }

	    
								?>
							</select>
							</td>
						</tr>
						
						<td colspan="2" align="center">
							<button class="btn btn-outline-primary" type="submit" name="upload">UPLOAD</button>
						</td>
					</tr>
				</table>
			</form>
	 </div>
	 </div>
	</div>
</div>

		<?php include 'footer.php'; ?>   
