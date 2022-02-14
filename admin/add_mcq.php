<?php 
include '../inc/top.php';
require '../db/dbcon.php';
if (isset($_GET['sub_id']) && $_GET['sub_id']!='' && isset($_GET['unit_id']) && $_GET['unit_id']!='') {

$sub_id=safe_string($_GET['sub_id']);
$unit_id = safe_string($_GET['unit_id']);

// inserting mcqs in db
        $msgs=$msg=$success='';
	if ($_SERVER['REQUEST_METHOD']=='POST'  and isset($_POST['add_mcq_btn']) and isset($_POST['question']) ) {


        if (empty($_POST['question']) || empty($_POST['option_1'])|| empty($_POST['option_2']) ||empty($_POST['option_3']) || empty($_POST['option_4']) || empty($_POST['answer'])) {
             $msg= '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>question Empty!!</strong>    Empty mcq can not be added
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    ';
        }else{

        if (isset($_GET['unit_id']) or isset($_POST['unit_id']) ) {


            // $unit_id=safe_string($_POST['unit_id']);
            $sub_id=safe_string($_GET['sub_id']);
            $question=safe_string($_POST['question']);
			$option_1=safe_string($_POST['option_1']);
			$option_2=safe_string($_POST['option_2']);
			$option_3=safe_string($_POST['option_3']);
			$option_4=safe_string($_POST['option_4']);
			$answer=safe_string($_POST['answer']);
            // $admin_id=$_SESSION['admin_id'];
            $loop=0;
			$count=0;
			$res=mysqli_query($con,"SELECT * from mcqs WHERE sub_id=$sub_id and unit_id=$unit_id ORDER BY mcq_id ASC");
			$count=mysqli_num_rows($res);
			if ($count==0) {

			}else{
				while ($row=mysqli_fetch_assoc($res)) {
					$loop=$loop+1;
					$ei=$row['mcq_id'];
					// pr($loop);
					mysqli_query($con,"UPDATE exam SET que_no=$loop WHERE sub_id=$sub_id and unit_id=$unit_id AND mcq_id=$ei");
				}
			}

		
			$loop=$loop+1;


			$sql="INSERT INTO `mcqs` (`sub_id`, `unit_id`, `mcq_no`, `question`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`) VALUES ('$sub_id', '$unit_id', '$loop', '$question', '$option_1', '$option_2', '$option_3', '$option_4', '$answer')";
			// die($sql);
			$result=mysqli_query($con,$sql) or die(mysqli_error($con));
            if ($result) {
                $msg= '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>MCQ Added Successfully!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                   ';
            
               }else{
                        $msg= '
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>MCQ Can not added!</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                ';
                }
			}
		}
	}

 ?>
 <body >
 	<div class="container-fluid ">
		<div class="container" style="font-size: 13px;">
			<center>
				<div class="shadow">
<h3 class="mt-4 text-white p-1 text-monospace text-decoration-underline">Subject: <?php echo sub_id($sub_id); ?> </h3>

					<h4 class="rounded-pill  text-light pb-3 ">
						Add MCQs in <b class="text-warning"><i>
						<?php 
						$uarr=unit_id($unit_id); 
						echo $uarr['unit_number'].".&nbsp;".$uarr['unit_name']; 
						?>
							
						</i></b></h4>
				</div>
			</center>
			
			<div class="row">
			<div class="col-md-8 offset-md-2 bg-light p-4 mt-5 rounded">

				<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>" method="POST">
					<span class="text-danger"><?php echo $msgs; ?></span>
					<span class="text-success "><?php echo $success; ?></span>

					<div class="form-group">
						<label for="mcq">Question :</label>
						<input type="text" name="question" placeholder="Enter Question" class="form-control"  required><br>
					</div>
					<div class="form-group">
						<label for="mcq">Enter Options</label>
						<input type="text" name="option_1" placeholder="Enter Option A" class="form-control"  required><br>
						<input type="text" name="option_2" placeholder="Enter Option B" class="form-control"  required><br>
						<input type="text" name="option_3" placeholder="Enter Option C" class="form-control"  required><br>
						<input type="text" name="option_4" placeholder="Enter Option D" class="form-control"  required><br>
						<label for="mcq">Correct Option</label>
						<!-- <input type="text" name="answer" placeholder="Enter correct answer" class="form-control" ><br> -->
						<select name="answer" class="form-control">
							<option value="" selected="" disabled="">Select option</option>
							<option value="option_1">A</option>
							<option value="option_2">B</option>
							<option value="option_3">C</option>
							<option value="option_4">D</option>
						</select>
					</div>
					<center>
						<button name="add_mcq_btn" type="submit" class="btn btn-primary">
							Add MCQ
						</button>
                                <a href="view_mcqs.php?sub_id=<?php echo $sub_id; ?>&unit_id=<?php echo $unit_id; ?>" class="btn  btn-success ">View MCQs</a>						
					</center>
				</form>
			</div>
		</div>
		</div>
	 <div class="container bg-white p-4 mt-3 rounded-lg ">
	<?php 

	$sql="SELECT * FROM mcqs WHERE  sub_id=$sub_id and unit_id=$unit_id ORDER BY mcq_id DESC LIMIT 1";
	$result=mysqli_query($con, $sql) or die(mysqli_error($con));
	$records=mysqli_num_rows($result);
	if ($records==0){
	    echo "<center><b class='text-danger'>No Last added Questions found!</b></center>";

	}else{ 

		while ($row = mysqli_fetch_array($result)) {

	 ?>
	 <center>
	 	<p class="text-decoration-underline font-weight-bold text-primary">Last Added MCQ</p>
	 </center>
	 <div class="float-right" style="color: #2F80ED; font-size:16px;">
                   <div class="mb-3 ml-3 mr-2" style="cursor:pointer;" id="">
                       <a href="edit_mcq.php?mcq_id=<?php echo $row['mcq_id']; ?>"><i class="fas fa-edit"></i></a>
                   </div>
                   <div id="<?php echo $row['mcq_id']; ?>" class="mt-3 ml-3 mr-2" style="cursor:pointer;" onclick="mcqDelete(this.id)" >
                       <i class="fas fa-trash-alt"></i>
                   </div> 
                </div>
		<table class="p-3 m-1 " style="font-weight: 480; font-family: 'roboto';">
			<thead>

				
			<tr>
				<th class="p-2">
					<h4 class="font-weight-bold">(<?php echo $row['mcq_no'] ; ?>)&nbsp;</h4>
				</th>
				<th class="p-2">
					<h4 class="font-weight-bold"><?php echo $row['question']; ?> </h4>					
				</th>

			</tr>
			</thead>
			<?php 

			if ($row['answer']=="option_1"){
				
					$success1="table-success";
				
			}elseif ($row['answer']=="option_2"){

					$success2="table-success";
				
			}elseif ($row['answer']=="option_3"){
				
					$success3="table-success";
				
			}elseif ($row['answer']=="option_4"){
				
					$success4="table-success";
				
			}else{
				$success1=$success2=$success3=$success4='';
			}

				
				?>
			<tbody>				
				
				<tr  class="<?php if(isset($success1)){ echo $success1;} ?>">
					<td class="p-2 ">(A)</td>
					<td class="p-2 "><?php echo $row['option_1']; ?> </td>
				</tr>
				<tr  class="<?php if(isset($success2)){ echo $success2;} ?>">
					<td class="p-2 ">(B)</td>
					<td class="p-2 "><?php echo $row['option_2']; ?> </td>
				</tr>
				<tr  class="<?php if(isset($success3)){ echo $success3;} ?>">
					<td class="p-2 ">(C)</td>
					<td class="p-2 "><?php echo $row['option_3']; ?> </td>
				</tr>
				<tr  class="<?php if(isset($success4)){ echo $success4;} ?>">
					<td class="p-2 ">(D)</td>
					<td class="p-2 "><?php echo $row['option_4']; ?> </td>
				</tr>
			</tbody>	</table>
</div>

      <?php
      }
       
  }
  ?>

</div>

		<?php } include 'footer.php'; ?>