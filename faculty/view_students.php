<?php
include '../inc/faculty.php';
require '../db/dbcon.php';
	
	if (isset($_GET['d_id'])>0 && $_GET['d_id']<5 && $_GET['d_id']!='') 
	{
		// pagination of 5 pages code
		$limit=10; // limit of the rows per table ex. 5 item per page

		// if page admin clicks on page then it runs
		if (isset($_GET['page'])) {
			$page=$_GET['page'];
		}else{
			$page=1;
		}

		$offset=($page-1)*$limit;

		$d_id =$_GET['d_id'];
		$Query="SELECT department FROM department WHERE d_id=$d_id";
		$qResult=mysqli_query($con,$Query);
		$dep=mysqli_fetch_assoc($qResult);
		
?>

<body>
<div class="container-fluid mt-3">
<!-- Edit Modal -->

	<center>

		<?php 
		$dark=$semActive=$semEcho='';
		if (isset($_GET['sem_id']) && $_GET['sem_id']!='' ){
			$semActive=$_GET['sem_id'];
			$semEcho='Semester&nbsp;'.$semActive.'&nbsp;in&nbsp;';
		}
		for ($sem=1; $sem<=8; $sem++) {

				if ($sem==$semActive) {
					$dark='btn-light';
				} else{
					$dark="btn-success";
				}
					echo '<a class="btn '.$dark.'  m-2 my-4" href="view_students.php?d_id='.$d_id.'&sem_id='.$sem.'">Semester '.$sem.'</a>';
				 
			}
			?>
	</center>

	<div class="card">
		<div class="card-header">
			<h3 class="text-center font-weight-bold"><?php echo $semEcho.$dep['department']; ?>- Students</h3>
		</div>
		<div class="card-body">
			<!-- <div class="row grid_box">
				<div class="col-12"> -->
					<div class="table-responsive">
						<table class="table  thover ts table-bordered">
							<thead class="table-primary">
								<tr class="">
									<th width="1%">No</th>
									<th width="10%">Enrollment</th>
									<th width="13%">Name</th>
									<th width="13%">Email</th>
									<th width="8%">Mobile</th>
									<th width="10%">Department</th>
									<th width="3%">Semester</th>
									<th width="3%">Status</th>
									</tr>
							</thead>
							<tbody>
		<?php
		// data fetching through department wise
		$sql="SELECT student.*, department.department FROM student,department WHERE student.d_id=$d_id && department.d_id=$d_id LIMIT {$offset},{$limit}";


		//pagination query through department wise
		$sql1="SELECT * FROM `student` WHERE student.d_id=$d_id";


		// this condition checks get variable of sem_id  if admin click on semester 1 then sem_id available and records will view as semester wise
			if (isset($_GET['sem_id']) && $_GET['sem_id']!='' )  
			{
				
				if ($_GET['d_id']>0 && $_GET['sem_id']<=8) {
				
				
				$sem_id=$_GET['sem_id'];


				//pagination query through semester wise
				$sql1="SELECT * FROM `student` WHERE student.d_id=$d_id and student.semester=$sem_id";


				// data fetching through semester wise with row limit
				$sql="SELECT student.*, department.department FROM student,department WHERE student.d_id=$d_id && department.d_id=$d_id && student.semester=$sem_id LIMIT {$offset},{$limit}";
				// die($sql);


				}else{
					echo "<td class='text-center text-danger font-weight-bold' colspan='9'> sem_id must between 1 to 8. Data is shown according to department wise </td>"; 
				}
			}
			
		//fetch the student data from databse
		$result=mysqli_query($con,$sql);
		$records=mysqli_num_rows($result);
		if ($records==0){
			echo "<td colspan='9' align='center' class='text-danger'><b>No records!</td></b>";

		}else{			
		 $No = $offset;
		while ($row = mysqli_fetch_array($result)) {
			$No = $No + 1;
		?>
								<tr>
									<td><?php echo "<b>".$No."</b>"; ?></td>
									<td><?php echo $row['enrollment']; ?></td>
									<td><?php echo $row['username']; ?></td>
									<td><?php echo $row['email']; ?></td>
									<td><?php echo $row['mobile']; ?></td>
									<td><?php echo $row['department']; ?></td>
									<td><?php echo $row['semester']; ?></td>
									<td><?php echo $row['status']; ?></td>
								</tr>
					<?php
							}
					} 
					// else{
					// 	echo "<td class='text-center font-weight-bold' colspan='8'>No Records Found! </td>";
					// }
			?>

							</tbody>
						</table>
						</div>
				</div>
			<!-- </div>
		</div> -->
	</div>
	<div class="container mt-3">	

	<?php

	// pagination code starts here with department wise		
		$records1=mysqli_num_rows(mysqli_query($con,$sql1));
	
		if ($records1>0) {
		
			$total_page=ceil($records1/$limit); 

			echo'<ul class="pagination justify-content-center">';
			for ($i=1; $i<=$total_page; $i++) {

				if ($i==$page) {
					$active='active';
				} else{
					$active="";
				}

				if (isset($_GET['sem_id']) && $_GET['d_id']>0 && $_GET['sem_id']<=8 && $_GET['sem_id']!='') {
					$PageNo='<li class="page-item '.$active.'"><a class="page-link" href="view_students.php?d_id='.$d_id.'&sem_id='.$sem_id.'&page='.$i.'">'.$i.'</a></li>';
				}else{
					$PageNo='<li class="page-item '.$active.'"><a class="page-link" href="view_students.php?d_id='.$d_id.'&page='.$i.'">'.$i.'</a></li>';
				}
				echo $PageNo;
			}
			echo'</ul>';
			}
			
		// pagination code ends here with department wise
	} else {
		echo "<h2 class='text-danger text-center mt-5'>Invalid ID</h2> ";
	}
	?>
</div>
</div>
<!-- <script>
			$(document).ready(function(){
				$(document).on("click",".delete", function(){
					if(confirm("Do you realy want to delete this record")){
						var enrollment= $(this).data("id");
						var element=this;
						$.ajax({
							url:"ajax/delete.php",
							type:"POST",
							data:{enrollment: enrollment},
							success: function(data){
								if(data==1){
									$(element).closest("tr").fadeOut();
									window.location.reload();
								}
							}
						});
					}
				});
			});

		</script> -->
<?php include 'footer.php'; ?>