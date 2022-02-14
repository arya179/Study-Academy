<?php 
include '../inc/faculty.php';
require '../db/dbcon.php';

if (isset($_GET['ans_id']) && $_GET['ans_id']!='' ) {
	 $ans_id=safe_string($_GET['ans_id']);
$msg='';

	if ($_SERVER['REQUEST_METHOD']=='POST'  and isset($_POST['answer_btn']) and isset($_POST['answer'])) {
        
        if (empty($_POST['answer'])) {
             $msg= '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Answer Empty!!</strong>    Empty answer can not be added
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    ';
                    }else{


        $answer=safe_string($_POST['answer']);

        $sql="UPDATE `answers` SET  `answer`='$answer', `update_time`=current_timestamp() WHERE ans_id=$ans_id";
        $result=mysqli_query($con,$sql) or die(mysqli_error($con));
        if ($result) {
            // $msg= '
            //         <div class="alert alert-success alert-dismissible fade show" role="alert">
            //             <strong>Answer Added Successfully!</strong>
            //                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            //                     <span aria-hidden="true">&times;</span>
            //                 </button>
            //         </div>
            //        ';
                   echo "<script>  window.history.go(-2); </script>";
            
               }else{
                        $msg= '
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Answer Can not added!</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                ';
                    }
        }
    }

	 $sql="SELECT * FROM answers WHERE ans_id=$ans_id ";
	 $result=mysqli_query($con,$sql);
	 if (mysqli_num_rows($result)>0){
	 	$row=mysqli_fetch_assoc($result);



	?>
<div class="container mt-5 bg-light p-3 ">
	<h3>Edit Answer</h3>
	<h6><?php if (isset($msg)) {
                echo $msg;
            }  ?> </h6>
	<form action="<?php echo htmlentities($_SERVER['REQUEST_URI']) ?>" method="POST">
		<div class="form-group">
			
			<label for="">Answer</label>

			<!-- <input type="text" name="admin" class="form-control"> -->
			<textarea class="form-control" name="answer" rows="5" placeholder="Enter Answer for this lecture"><?php echo $row['answer']; ?></textarea>
			<!-- <input type="text" name="answer" class="form-control" placeholder="Enter Answer for this lecture"> -->
			
		</div>
		<button type="submit" name="answer_btn" class="btn btn-primary">Edit</button>

	</form>
	<hr>
</div>
<?php
	 }


} else {

}
include 'footer.php';

 ?>