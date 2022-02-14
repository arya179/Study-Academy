<?php
include '../inc/top.php';
require '../db/dbcon.php';

if (isset($_GET['d_id']) > 0 && $_GET['d_id'] < 5 && $_GET['d_id'] != '') {
	// pagination of 5 pages code
	$limit = 5; // limit of the rows per table ex. 5 item per page

	// if page admin clicks on page then it runs
	if (isset($_GET['page'])) {
		$page = safe_string($_GET['page']);
	} else {
		$page = 1;
	}

	$offset = ($page - 1) * $limit;
	$d_id = safe_string($_GET['d_id']);

?>

	<body>
		<div class="container-fluid mt-3">
			<center>

				<?php
				$dark = $semActive = $semEcho = $sub = $subActive = $sub_id1=$unit_id='';
				$flag=false;

				// data fetching through department wise
				$sql = "SELECT  study_materials.*, department.department FROM study_materials,department WHERE study_materials.d_id=$d_id && department.d_id=$d_id LIMIT {$offset},{$limit}";


				//pagination query through department wise
				$pageSql = "SELECT * FROM `study_materials` WHERE study_materials.d_id=$d_id";


				// this condition checks get variable of sem_id  if admin click on semester 1 then sem_id available and records will view as semester wise
				if (isset($_GET['sem_id']) && $_GET['sem_id'] != '') {

					if ($_GET['d_id'] > 0 && $_GET['sem_id'] <= 8) {


						$sem_id = safe_string($_GET['sem_id']);


						//pagination query through semester wise
						$pageSql = "SELECT * FROM `study_materials` WHERE study_materials.d_id=$d_id and study_materials.semester=$sem_id";
						$subSql = "SELECT * FROM `subject` WHERE subject.d_id=$d_id and subject.semester=$sem_id";


						// data fetching through semester wise with row limit
						$sql = "SELECT study_materials.*, department.department FROM study_materials,department WHERE study_materials.d_id=$d_id && department.d_id=$d_id && study_materials.semester=$sem_id LIMIT {$offset},{$limit}";


						// getting ssemester for create buttons of semester
						$semActive = safe_string($_GET['sem_id']);
						$semEcho = 'Semester&nbsp;' . $semActive . '&nbsp;in';

						if (isset($_GET['sub_id']) && $_GET['sub_id'] != '') {
							$sub_id1 = safe_string($_GET['sub_id']);
							$flag=true;
							
							$pageSql="SELECT * FROM `study_materials` WHERE study_materials.d_id=$d_id and study_materials.semester=$sem_id and sub_id=$sub_id1 ";
							$sql="SELECT * FROM `study_materials` WHERE study_materials.d_id=$d_id and study_materials.semester=$sem_id and sub_id=$sub_id1 LIMIT {$offset},{$limit}";
							$unitSQL="SELECT * FROM `unit` WHERE sub_id=$sub_id1";

							// unit wise study_materials
								if (isset($_GET['unit_id'])) {
									$unit_id = safe_string($_GET['unit_id']);
									$flag="unit";
									
									$pageSql="SELECT * FROM `study_materials` WHERE study_materials.d_id=$d_id and study_materials.semester=$sem_id and sub_id=$sub_id1 and unit_id=$unit_id ";
									$sql="SELECT * FROM `study_materials` WHERE study_materials.d_id=$d_id and study_materials.semester=$sem_id and sub_id=$sub_id1 and unit_id=$unit_id LIMIT {$offset},{$limit}";
		
								}
							
						}
					} else {
						echo "<b class='text-center text-danger font-weight-bold' > sem_id must between 1 to 8. Data is shown according to department wise </p>";
					}
				}
				//1 to 8 semesters 
				for ($sem = 1; $sem <= 8; $sem++) {

					if ($sem == $semActive) {
						$dark = 'btn-purple';
					} else {
						$dark = "btn-warning";
					}
					echo '<a class="btn ' . $dark . '  m-2 my-4" href="view_materials.php?d_id=' . $d_id . '&sem_id=' . $sem . '">Semester ' . $sem . '</a>';
				}
				?>
			</center>
			<div class="card">
				<div class="card-header">
					<h3 class="text-center "><em class="text-primary font-weight-bold text-decoration-underline"><?php echo $semEcho ?></em>&nbsp; <b class="text-decoration-underline text-danger"><?php echo d_id($d_id); ?></b>  &nbsp;<b class=" font-weight-normal text-decoration-underline">Materials</b></h3>
				</div>
				<center>
					<!-- showing sujects according to semester start -->
					<?php
					if (isset($subSql)) {
						
						$subResult = mysqli_query($con, $subSql);
						while ($subRow = mysqli_fetch_assoc($subResult)) {

							if ($subRow['sub_id'] == $sub_id1) {
								echo '<a class="btn btn-success  m-2 my-4" href="view_materials.php?d_id=' . $d_id . '&sem_id=' . $sem_id . '&sub_id=' . $subRow['sub_id'] . '">' . sub_id($subRow['sub_id']) . '</a>';
							} else {
								echo '<a class="btn btn-secondary  m-2 my-4" href="view_materials.php?d_id=' . $d_id . '&sem_id=' . $sem_id . '&sub_id=' . $subRow['sub_id'] . '">' . sub_id($subRow['sub_id']) . '</a>';
							}
							
						}
					}

					?>
					<!-- showing sujects according to semester ends-->
				</center>
				<center>
					<!-- showing units according to semester start -->
					<?php
					if (isset($unitSQL)) {
						
						$unitResult = mysqli_query($con, $unitSQL);
						while ($unitRow = mysqli_fetch_assoc($unitResult)) {
							$unitArr=unit_id($unitRow['unit_id']);
							if ($unitRow['unit_id'] == $unit_id) {
								echo '<a class="btn btn-sm btn-warning  m-2 my-2" href="view_materials.php?d_id=' . $d_id . '&sem_id=' . $sem_id . '&sub_id='.$sub_id1.'&unit_id='.$unitRow['unit_id'].'">'.$unitArr["unit_number"].'.&nbsp;'.$unitArr["unit_name"].'</a>';
							} else {
								echo '<a class="btn btn-sm btn-info  m-2 my-2" href="view_materials.php?d_id=' . $d_id . '&sem_id=' . $sem_id . '&sub_id='.$sub_id1.'&unit_id='.$unitRow['unit_id'].'">'.$unitArr["unit_number"].'.&nbsp;'.$unitArr["unit_name"].'</a>';
							}
							
						}
					}

					?>
					<!-- showing sujects according to semester ends-->
				</center>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table thover ts table-bordered">
							<thead class="table-primary">
								<tr class="">
									<th width="5%">No</th>
									<!-- <th>Department</th> -->
									<?php

                                    if (!isset($subSql)) {
                                        echo "<th width='3%'>Semester</th>
                                              ";
                                    }
                             
                                    if ($flag==false) {
                                        echo "
                                              <th width='8%'>Subject</th>";
                                    }


                                    if (!isset($_GET['unit_id'])) {
                                        echo "
                                              <th width='4%'>Unit No</th>
					    					  <th width='9%'>Unit Name</th>";
                                    }
					    					  
                                    ?>
					    			
									<th width="45%">Topic</th>
									<th width="10%">Files</th>
									<th width="20%" colspan="2">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php

								//fetch the student data from databse
								$result = mysqli_query($con, $sql) or die(mysqli_error($con));
								$records = mysqli_num_rows($result);

								if ($records == 0) {
									echo "<td colspan='9' align='center' class='text-danger'><b>No materials!</td></b>";
								} else {

									$No = $offset;
									while ($row = mysqli_fetch_assoc($result)) {
										$No = $No + 1;
										// prx($row);
								?>
										<tr>
											<td><?php echo "<b>" . $No . "</b>"; ?></td>
											<!-- <td><?php echo $row['department']; ?></td> -->

											 <?php

                                            if (!isset($subSql)) {
                                                echo "<td>" . $row['semester'] . "</td>
                                                      ";
                                            }

                                            if ($flag==false) {
                                                echo "
                                                      <td>" . sub_id($row['sub_id']) . "</td>";
                                            }
                                            $unitArr=unit_id($row['unit_id']);
                                            if (!isset($_GET['unit_id'])) {
                                                echo "
                                                      <td>" . $unitArr['unit_number']. "</td>
                                                      <td>" . $unitArr['unit_name'] . "</td>";
                                            }
                                            ?>

											<td><?php echo $row['topic']; ?></td>
											<td><a href="<?php echo $row['file']; ?>" target="_blank">View File</a></td>
											<td>
												<a href="edit_materials.php?material_id=<?php echo $row['material_id']; ?>" class="btn btn-primary" href="">Edit</a>
											</td>
											<td>
												<a href="delete.php?material_id=<?php echo $row['material_id']; ?>" class="btn btn-danger" href="">Delete</a>
											</td>
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
			$records1 = mysqli_num_rows(mysqli_query($con, $pageSql));

			if ($records1 > 0) {

				$total_page = ceil($records1 / $limit);

				echo '<ul class="pagination justify-content-center">';
				for ($i = 1; $i <= $total_page; $i++) {

					if ($i == $page) {
						$active = 'active';
					} else {
						$active = "";
					}

					if (isset($_GET['sem_id']) && $_GET['d_id'] > 0 && $_GET['sem_id'] <= 8 && $_GET['sem_id'] != '') {

						if (isset($_GET['sem_id']) && $_GET['d_id']>0 && $_GET['sem_id']<=8 && $_GET['sem_id']!=''&& isset($_GET['sub_id']) && $_GET['sub_id']!='' ) {
                       if (isset($_GET['sem_id']) && $_GET['d_id']>0 && $_GET['sem_id']<=8 && $_GET['sem_id']!=''&& isset($_GET['sub_id']) && $_GET['sub_id']!=''&& isset($_GET['unit_id']) && $_GET['unit_id']!='' ){

                        	$PageNo='<li class="page-item '.$active.'"><a class="page-link" href="view_materials.php?d_id='.$d_id.'&sem_id='.$sem_id.'&sub_id='.$sub_id1.'&unit_id='.$unit_id.'&page='.$i.'">'.$i.'</a></li>';	
                        }else{
                        	
                        	$PageNo='<li class="page-item '.$active.'"><a class="page-link" href="view_materials.php?d_id='.$d_id.'&sem_id='.$sem_id.'&sub_id='.$sub_id1.'&page='.$i.'">'.$i.'</a></li>';

                        }
                    }else{

                    $PageNo='<li class="page-item '.$active.'"><a class="page-link" href="view_materials.php?d_id='.$d_id.'&sem_id='.$sem_id.'&page='.$i.'">'.$i.'</a></li>';
                    }
					} else {
						$PageNo = '<li class="page-item ' . $active . '"><a class="page-link" href="view_materials.php?d_id=' . $d_id . '&page=' . $i . '">' . $i . '</a></li>';
					}
					echo $PageNo;
				}
				echo '</ul>';
			}

			// pagination code ends here with department wise
		} else {
			echo "<h2 class='text-danger text-center mt-5'>Invalid ID</h2> ";
		}
			?>
			</div>
		</div>
		<?php include 'footer.php'; ?>