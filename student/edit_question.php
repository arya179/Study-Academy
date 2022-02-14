<?php 
include '../inc/student.php';
require '../db/dbcon.php';

if (isset($_GET['que_id']) && $_GET['que_id']!='' ) {
	 $que_id=safe_string($_GET['que_id']);
$msg='';

	if ($_SERVER['REQUEST_METHOD']=='POST'  and isset($_POST['question_btn']) and isset($_POST['question'])) {
        
        if (empty($_POST['question'])) {
             $msg= '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Question Empty!!</strong>    Empty question can not be added
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    ';
                    }else{


        $question=safe_string($_POST['question']);
        $stu_id=$_SESSION['stu_id'];

        $sql="UPDATE `ask_question` SET  `question`='$question', `update_time`=current_timestamp() WHERE que_id=$que_id";
        $result=mysqli_query($con,$sql) or die(mysqli_error($con));
        if ($result) {
            // $msg= '
            //         <div class="alert alert-success alert-dismissible fade show" role="alert">
            //             <strong>Question Added Successfully!</strong>
            //                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            //                     <span aria-hidden="true">&times;</span>
            //                 </button>
            //         </div>
            //        ';
                   echo "<script>  window.history.go(-2); </script>";
            
               }else{
                        $msg= '
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Question Can not added!</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                ';
                    }
        }
    }

	 $sql="SELECT * FROM ask_question WHERE que_id=$que_id ";
	 $result=mysqli_query($con,$sql);
	 if (mysqli_num_rows($result)>0){
	 	$row=mysqli_fetch_assoc($result);



	?>
<div class="container mt-5 bg-light p-3 ">
	<h3>Edit Question</h3>
	<h6><?php if (isset($msg)) {
                echo $msg;
            }  ?> </h6>
	<form action="<?php echo htmlentities($_SERVER['REQUEST_URI']) ?>" method="POST">
		<div class="form-group">
			
			<label for="">Question</label>

			<!-- <input type="text" name="admin" class="form-control"> -->
			<textarea class="form-control" name="question" rows="5" placeholder="Enter Question for this lecture"><?php echo $row['question']; ?></textarea>
			<!-- <input type="text" name="question" class="form-control" placeholder="Enter Question for this lecture"> -->
			
		</div>
		<button type="submit" name="question_btn" class="btn btn-primary">Edit</button>

	</form>
	<hr>
</div>
<?php
	 }


} else {

}
include 'footer.php';

 ?>