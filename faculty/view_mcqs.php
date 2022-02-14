<?php
include '../inc/top.php';
require '../db/dbcon.php';
if (isset($_GET['sub_id']) && $_GET['sub_id']!='' && isset($_GET['unit_id']) && $_GET['unit_id']!='') {

$sub_id=safe_string($_GET['sub_id']);
$unit_id = safe_string($_GET['unit_id']);


        $limit=5; // limit of the rows per table ex. 5 item per page

        // if page admin clicks on page then it runs
        if (isset($_GET['page'])) {
            $page=$_GET['page'];
        }else{
            $page=1;
        }

        $offset=($page-1)*$limit;

		$unit=unit_id($unit_id);
?>
<div class="container ">
	<center>
				<div class="">
				<h3 class="rounded-pill shadow-lg text-light bg-light mt-4 p-3 "><b class="text-dark text-decoration-underline"><?php echo $unit['unit_number'].'. '.$unit['unit_name'];  ?></b></h3>
				 <a class="text-left btn btn-purple" href="add_mcq.php?sub_id=<?php echo $sub_id; ?>&unit_id=<?php echo $unit_id; ?>">Add MCQs</a>
			</div>
	</center>
</div>
	<?php 

	$sql="SELECT * FROM mcqs WHERE  sub_id=$sub_id and unit_id=$unit_id ORDER BY mcq_no ASC LIMIT {$offset},{$limit}";
	$result=mysqli_query($con, $sql) or die(mysqli_error($con));
	$records=mysqli_num_rows($result);
	if ($records==0){
	    echo "<center><b class='text-danger'>No Questions found!</b></center>";

	}else{ 

		while ($row = mysqli_fetch_array($result)) {
			$success1=$success2=$success3=$success4='';


	 ?>
	<div class="container bg-white p-4 mt-3 rounded-lg ">
		

		<table class="p-3 m-1 " style="font-weight: 480; font-family: 'roboto';">
			<thead>
				
			<tr>
				<th class="p-2">
					<h4 class="font-weight-bold">(<?php echo $row['mcq_no'] ; ?>)&nbsp;</h4>
				</th>
				<th class="p-2">
					<h4 class="font-weight-bold"><?php echo $row['question']; ?> </h4>					
				</th>
				<div class="float-right" style="color: #2F80ED; font-size:16px;">
                   <div class="mb-3 ml-3 mr-2" style="cursor:pointer;" id="">
                       <a href="edit_mcq.php?mcq_id=<?php echo $row['mcq_id']; ?>"><i class="fas fa-edit"></i></a>
                   </div>
                   <div id="<?php echo $row['mcq_id']; ?>" class="mt-3 ml-3 mr-2" style="cursor:pointer;" onclick="mcqDelete(this.id)" >
                       <i class="fas fa-trash-alt"></i>
                   </div> 
                </div>
				

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

</div>
<div class="container mt-3">    

    <?php

    // pagination code starts here with department wise    
    $pSQL="SELECT * FROM mcqs WHERE  sub_id=$sub_id and unit_id=$unit_id ORDER BY mcq_no ASC ";

	$records=mysqli_num_rows(mysqli_query($con,$pSQL));    
        if ($records>0) {
        
            $total_page=ceil($records/$limit); 

            echo'<ul class="pagination justify-content-center">';
            for ($i=1; $i<=$total_page; $i++) {

                if ($i==$page) {
                    $active='active';
                } else{
                    $active="";
                }

                
                    $PageNo='<li class="page-item '.$active.'"><a class="page-link" href="view_mcqs.php?sub_id='.$sub_id.'&unit_id='.$unit_id.'&page='.$i.'">'.$i.'</a></li>';

                echo $PageNo;
            }
            echo'</ul>';
            }
        }else{
        	echo "Not found!!";
        }
    ?>
</div>

  <?php

include 'footer.php';
?>