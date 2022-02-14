<?php
include '../inc/faculty.php';
require '../db/dbcon.php';


        $msg='';
if (isset($_GET['group_id'])&&isset($_GET['stu_id']) || isset($_POST['resbtn'])) {

        if (isset($_POST['resbtn'])) {
            $group_token=safe_string($_POST['group_token']);
            $enrollment=safe_string($_POST['enrollment']);
            $check_group="SELECT * FROM exam_group WHERE group_token='$group_token'";

            $GroupResult=mysqli_query($con,$check_group);
            $group=mysqli_num_rows($GroupResult);

            $check_enroll="SELECT * FROM student WHERE enrollment=$enrollment";
            $EnrollResult=mysqli_query($con,$check_enroll);
            $enroll=mysqli_num_rows($EnrollResult);
            if ($group>0&&$enroll>0) {

                $stuROW=mysqli_fetch_assoc($EnrollResult);
                $si=$stuROW['stu_id'];
                $group_id=mysqli_fetch_array($GroupResult);
                $gi=$group_id['group_id'];

                $resultSQL="SELECT * FROM RESULT WHERE stu_id='$si' AND group_id='$gi'";
                $result=mysqli_query($con, $resultSQL);
                if (mysqli_num_rows($result)>0) {
                    $row=mysqli_fetch_assoc($result);
                }else{
                    die("No result");
                }
            }else{
                    $msg='<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Enter Valid Details!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                    die($msg);
                }
        }else{
            $group_id= safe_string($_GET['group_id']);
        $stu_id=safe_string($_GET['stu_id']);

            $resultSQL="SELECT * FROM RESULT WHERE stu_id='$stu_id' AND group_id='$group_id'";
            $result=mysqli_query($con, $resultSQL);
            if (mysqli_num_rows($result)>0) {
            	
            	$stuSQL="SELECT * from student WHERE stu_id=$stu_id";
            	$stuResult=mysqli_query($con,$stuSQL);
            	if (mysqli_num_rows($stuResult)) {

            	$stuROW=mysqli_fetch_array($stuResult);

            	$row=mysqli_fetch_array($result);
            	$group_id=exam_group($row['group_id']);
                    }
                }else{
                                die("No result");
                }
            }


?>

<body>
    <style type="text/css">
        .top{
            border-top: 0.1px solid  #007bff !important;
        }
    </style>
    
    <div  class="container bg-primary p-4 my-5 rounded" >

                
            	<div class="col-lg-12 bg-primary row border m-2 p-3" >
            		<div class="col-lg-6" >
                        <div class="col-lg-12 p-2 " style="font-size: 16px; background-color: #f1f1f1; ">
            			<table   class="table">
            				<tr>
            					<td width="40%" style="border-top: 0;"><label class="font-weight-bold">Name :</label></td>
            					<td style="border-top: 0;"><label class="font-weight-normal"><?php 
                                if (isset($stuROW['username'])) {
                                    # code...
                                echo $stuROW['username']; 
                                }
                                ?>
                                    
                                </label></td>
            				</tr>
            				<tr>
            					<td class="top" width="40%"><label class="font-weight-bold">Enrollment :</label></td>
            					<td class="top"><label class="font-weight-normal"><?php if (isset($stuROW['enrollment'])) {
                                    # code...
                                echo $stuROW['enrollment']; 
                                }
                                ?></label></td>
            				</tr>
            				<tr>
            					<td class="top" width="40%"><label class="font-weight-bold">Subject :</label></td>
            					<td class="top"><label class="font-weight-normal"><?php if(isset($group_id['sub_id'])) {
                                    # code...
                                echo sub_id($group_id['sub_id']); 
                                } ?></label></td>
            				</tr>
            				<tr>
            					<td class="top" width="40%"><label class="font-weight-bold">Deparment :</label></td>
            					<td class="top"><label class="font-weight-normal"><?php echo d_id($stuROW['d_id']); ?></label></td>
            				</tr>
            				<tr>
            					<td class="top" width="40%"><label class="font-weight-bold">Semester :</label></td>
            					<td class="top"><label class="font-weight-normal"><?php echo $stuROW['semester']; ?></label></td>
            				</tr>
            				<tr>
            					<td class="top" width="40%"><label class="font-weight-bold">Date :</label></td>
            					<td class="top"><label class="font-weight-normal"><?php echo DateWeek($row['create_time']); ?></label></td>
            				</tr>
            			</table>
                    </div>
            		</div>
            			
	            	<div class="col-lg-6 float-right">
                        <div class="col-lg-12 p-1 " style="font-size: 16px; background-color: #f1f1f1;">
	            		 <table class="table " >
		                    <tr>
		                        <td colspan="2" align="center" class="border-primary" style="border-top:0; color: black; border-bottom: 3px solid #007bff;  font-size: 20px;   "><label class="font-weight-bold  text-uppercase " style="border-bottom: 0.1px solid  #111; ">Result</label></td>
                            </tr>
		                        
		                    <tr>
		                        <td width="60%" ><label class="font-weight-bold">Right Answer :</label></td>
		                        <td style="border-top: ; "><label id="group_token"><?php echo $row['right_ans'];?></label></td>
		                    </tr>  
		                    <tr>
		                        <td width="60%"   class="top"><label class="font-weight-bold">Wrong Answer :</label></td>
		                        <td class="top"><label id="enrollment" ><?php echo $row['wrong_ans'];?></label></td>
		                    </tr>  
		                    <tr>
		                        <td width="60%"  class="top"><label class="font-weight-bold">Total :</label></td>
		                        <td class="top"><label id="enrollment" ><?php echo $row['total'];?></label></td>
		                    </tr>   
                            <tr>
                                <td width="60%"  class="top"><label class="font-weight-bold">Percentage :</label></td>
                                <td class="top"><label id="enrollment" ><?php echo ($row['right_ans']/$row['total'])*100 ; ?>&percnt;</label></td>
                            </tr>  
		                </table> 
                    </div>

	            	</div>
            	
            </div>
        </div>
    
                        

                       
                   
<?php
    }else{
        ?>

<div  class="container bg-transparent p-4 my-5 rounded-lg " >

    <div class=" col-md-10 shadow-lg">
        <span class="text-danger"><?php echo $msg; ?></span>
        <div class="card-body">
            <div class="table-responsive "  >
        <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="POST">
            <table class="table thover  table-borderless text-white  font-weight-bold " >

                <tr >
                        <td id="label" align="right"><label  style="font-size: 19px; !important"for="group_token" >Group Token:</label></td>
                        <td>
                            <input style="font-size: 17px; !important" class="form-control" type="text" name="group_token" placeholder="Enter Group Token" required>
                        </td>
                    </tr>
                    <tr>
                        <td id="label" align="right"><label style="font-size: 19px; !important"for="enrollment">Enrollment:</label></td>
                        <td>
                            <input class="form-control" style="font-size: 17px; !important"type="text" name="enrollment" placeholder="Enter Enrollment Number" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                        <input type="submit" class="btn btn-primary" name="resbtn" value="Search Result" id="">
                    </td>
                </tr>
            </table>
            
        </form>
    </div>
</div>

</div>
</div>

        <?php 
        //echo' <div class="container bg-light p-4 my-5 rounded"> <h3 class="bg-primary text-white">Please Enter valid details</h3></div> ';
 
}
include 'footer.php';
?>
