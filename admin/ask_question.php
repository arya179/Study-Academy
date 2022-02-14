<?php
include '../inc/top.php';
require '../db/dbcon.php';

if (isset($_GET['d_id']) > 0 && $_GET['d_id'] < 5 && $_GET['d_id'] != '' && isset($_GET['semester']) && $_GET['semester'] != '') {
$semester=safe_string( $_GET['semester']);
$d_id=safe_string( $_GET['d_id']);
    
    // inserting questions into db start
    if ($_SERVER['REQUEST_METHOD']=='POST'  and isset($_POST['ask_question_btn']) and isset($_POST['question']) ) {

        $msg='';

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

        if (isset($_GET['unit_id']) or isset($_POST['unit_id']) ) {

            if (isset($_POST['unit_id']) && $_POST['unit_id']!='') {
               $unit_id=safe_string($_POST['unit_id']);
            }
            if (isset($_GET['unit_id']) && $_GET['unit_id']!='') {
                $unit_id=safe_string($_GET['unit_id']);
            }
            $sub_id=safe_string($_GET['sub_id']);


            $question=safe_string($_POST['question']);
            $admin_id=$_SESSION['admin_id'];

            $sql="INSERT INTO `ask_question` (`sub_id`,`admin_id`,`unit_id`,`question`) VALUES('$sub_id', '$admin_id', '$unit_id', '$question')";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con));
            if ($result) {
                $msg= '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Question Added Successfully!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                   ';
            
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
    }
    // inserting questions into db ends

if (isset($_GET['sub_id'])) {
    $sub_id=safe_string( $_GET['sub_id']);
} else {
    $sub_id='';
}
echo'<body>
    <div class="container-fluid">
    <center class="bg-light m-1"> ';

$subjectSQL="SELECT sub_id,subject FROM subject WHERE d_id=$d_id AND semester=$semester";
$SubSqlResult=mysqli_query($con,$subjectSQL);
if (mysqli_num_rows($SubSqlResult)==0) {
    echo '<p class="text-center text-danger bg-light mt-3 font-weight-bold">No Subjects found !</p>';
}else{
    $no=0;
    while ($subRow=mysqli_fetch_assoc($SubSqlResult)) {
       if ($subRow['sub_id'] == $sub_id) {
            echo '<a class="btn btn-success  m-2 my-4" href="ask_question.php?d_id='.$d_id.'&semester='.$semester.'&sub_id='.$subRow['sub_id'].'">' . sub_id($subRow['sub_id']) . '</a>';
        } else {
            echo '<a class="btn btn-secondary  m-2 my-4" href="ask_question.php?d_id='.$d_id.'&semester='.$semester.'&sub_id='.$subRow['sub_id'].'">' . sub_id($subRow['sub_id']) . '</a>';
        }
    }
}
echo'</center>';
        
if (isset($_GET['sub_id']) && $_GET['sub_id']!='') {
        $unit_id=false;
        $limit=20; // limit of the rows per table ex. 5 item per page

        if (isset($_GET['page'])) {
            $page=safe_string($_GET['page']);
        }else{
            $page=1;
        }

        $offset=($page-1)*$limit;
        $d_id=$_GET['d_id'];
        $sub_id=safe_string($_GET['sub_id']);


        $pageSql="SELECT * FROM ask_question WHERE  sub_id=$sub_id";
        $sql="SELECT * FROM ask_question WHERE  sub_id=$sub_id ORDER BY que_id DESC LIMIT {$offset},{$limit}";

        // $pageSql="SELECT * FROM ask_question WHERE d_id=$d_id AND semester=$semester AND sub_id=$sub_id";
        // $sql="SELECT * FROM ask_question WHERE d_id=$d_id AND semester=$semester AND sub_id=$sub_id LIMIT {$offset},{$limit}";
        $unitSQL="SELECT * FROM `unit` WHERE sub_id=$sub_id";
        // unit wise ask_question
                if (isset($_GET['unit_id'])&& $_GET['unit_id'] != '') {
                    $unit_id = safe_string($_GET['unit_id']);
                    
                    $pageSql="SELECT * FROM `ask_question` WHERE  sub_id=$sub_id and unit_id=$unit_id ";
                    $sql="SELECT * FROM `ask_question` WHERE  sub_id=$sub_id and unit_id=$unit_id ORDER BY que_id DESC LIMIT {$offset},{$limit}";
                    // $pageSql="SELECT * FROM `ask_question` WHERE ask_question.d_id=$d_id and ask_question.semester=$semester and sub_id=$sub_id and unit_id=$unit_id ";
                    // $sql="SELECT * FROM `ask_question` WHERE ask_question.d_id=$d_id and ask_question.semester=$semester and sub_id=$sub_id and unit_id=$unit_id  LIMIT {$offset},{$limit}";

                }
        if (isset($unitSQL)) {

            $unitResult = mysqli_query($con, $unitSQL);
            $num=mysqli_num_rows($unitResult);
            if ($num>0) {
?>
 <div class="container-fluid">
    <div class="row m-1">
    
    <div class="col-sm-3 p-2 ">
    
                    <!-- showing units according to unit start -->
                    <?php
                        
                            while ($unitRow = mysqli_fetch_assoc($unitResult)) {
                                $unitArr=unit_id($unitRow['unit_id']);
                                if ($unitRow['unit_id'] == $unit_id) {
                                    echo '
                
                            <a class="shadow" href="ask_question.php?d_id='.$d_id.'&semester='.$semester.'&sub_id='.$sub_id.'&unit_id='.$unitRow['unit_id'].'"><div class="col-sm-11 btn btn-sm btn-warning  my-3">'.$unitArr["unit_number"].'.&nbsp;'.$unitArr["unit_name"].'</div></a> ';
                                } else {
                                    echo '<a class="shadow-sm" href="ask_question.php?d_id='.$d_id.'&semester='.$semester.'&sub_id='.$sub_id.'&unit_id='.$unitRow['unit_id'].'"><div class="col-sm-11 btn btn-sm btn-secondary my-3">'.$unitArr["unit_number"].'.&nbsp;'.$unitArr["unit_name"].'</div></a>';
                                }
                                
                            }
                        

                    ?>
                    <!-- showing units according to unit ends-->
                
    </div>

<div class="col-sm-9 my-3  bg-light">
     <div class="card-header">
            <h3 class="text-center font-weight-bold"><?php echo sub_id($sub_id); ?> - Questions</h3>
            <h6><?php if (isset($msg)) {
                echo $msg;
            }  ?> </h6>
            <form action="<?php echo htmlentities($_SERVER['REQUEST_URI']) ?>" method="POST">
                <div class="form-group">
                    
                    <textarea class="form-control" name="question" placeholder="Enter Question"></textarea>
                    <?php 

                    if ($unit_id==false) {

                        ?>
                        <label for="unit_id" class="font-weight-bold p-1 text-danger">Select Unit :</label>
                                <select class='form-control' name='unit_id' id='unit' size='1' required="">
                                    <option value='' selected='' disabled=''>Select Unit</option>
                                    <?php 
                                    if ($unit_id!='') {
                                        
                                        $Select_sub_id = "SELECT * FROM unit WHERE sub_id={$sub_id}";
                                        $SelectResult = mysqli_query($con, $Select_sub_id);

                                        while ($unit_id_row = mysqli_fetch_array($SelectResult)) {
                                            if ($unit_id_row['unit_id']==$unit_id) {
                                                echo "<option value='".$unit_id_row['unit_id']."'selected>".$unit_id_row['unit_number'].".&nbsp;".$unit_id_row['unit_name']."</option>";
                                            }else{
                                                echo "<option value='".$unit_id_row['unit_id']."'>".$unit_id_row['unit_number'].".&nbsp;".$unit_id_row['unit_name']."</option>";
                                            }
                                        }
                                    }
        
                                ?> 
                                </select>
                            
                <?php
                    
                    }
                ?>
                    
                </div>
                <button type="submit" name="ask_question_btn" class="btn btn-primary">Ask Question</button>
                
            </form><hr>
        </div>
<?php 
$result=mysqli_query($con,$sql);
// prx($sql);
$records=mysqli_num_rows($result);
if ($records==0){
    echo "<center><b class='text-danger'>No Questions found!</b></center>";

}else{ 
           
        $No = $offset;
        while ($row = mysqli_fetch_array($result)) {
            $No = $No + 1;
            $stu_id_que=$row['stu_id'];

                        $admin_id_que=$row['admin_id'];
                        $faculty_id_que=$row['faculty_id'];

            if($row["update_time"]==NULL){
                $que_time=$row["create_time"];

            }else{
                $que_time=$row["update_time"];

            }
            // $time=date("M d, Y h:iA",strtotime($date));

                if ($stu_id_que!=NULL) {
                            $stu_name=stu_id($stu_id_que);

                            echo '<hr>
                            
                            <div class="float-right" style="color: #2F80ED; font-size:16px;">
                           <div class="mb-3 ml-3 mr-2" style="cursor:pointer;" id="">
                               <a href="edit_question.php?que_id='.$row['que_id'].'"><i class="fas fa-edit"></i></a>
                           </div>
                           <div class="mt-3 ml-3 mr-2" style="cursor:pointer;" onclick="queDelete(this.id)" id="'.$row['que_id'].'">
                               <i class="fas fa-trash-alt"></i>
                           </div> 
                           </div> 
                                <a href="view_answer.php?que_id='.$row['que_id'].'">
                                <div class="media m-2 text-justify" >
                                     <i class="mt-2 fas fa-question-circle fa-2x" style="color: #2F80ED;">&nbsp;</i>
                                    <div class="media-body">
                                        <h4>'.$row["question"].'</h4>
                                        <br>
                                        <figcaption class="blockquote-footer">'.DateMinute($que_time).'<cite title="Source Title" class="font-weight-bold "> By <b>Student</b>:-'.$stu_name['username'].'</cite>&nbsp;                 
                <span class="" style="font-size: 20px;"><i class="fas fa-pen" style="color: #2F80ED;">'.mysqli_num_rows(mysqli_query($con,"SELECT * FROM answers WHERE que_id=".$row['que_id'])).'</i></span>
                                        </figcaption>
                                    </div>
                                </div>
                                </a>
                                <hr>
                                ';
                        }
                        if ($admin_id_que!=NULL) {
                            $adm_name=admin_id($admin_id_que);
                            // fa-universal-access 

                            echo '<hr>
                            <div class="float-right" style="color: #2F80ED; font-size:16px;">
                               <div class="mb-3 ml-3 mr-2" style="cursor:pointer;" id="">
                                   <a href="edit_question.php?que_id='.$row['que_id'].'"><i class="fas fa-edit"></i></a>
                               </div>
                               <div class="mt-3 ml-3 mr-2" style="cursor:pointer;" onclick="queDelete(this.id)" id="'.$row['que_id'].'">
                                   <i class="fas fa-trash-alt"></i>
                               </div> 
                           </div>
                           <a href="view_answer.php?que_id='.$row['que_id'].'">
                                <div class="media m-2 text-justify" >
                                     <i class="mt-2 fas fa-university fa-3x" style="color: #2F80ED;">&nbsp;</i>
                                    <div class="media-body">
                                        <h4 class="font-weight-bold">'.$row["question"].'</h4>
                                        <br>
                                        <figcaption class="blockquote-footer">'.DateMinute($que_time).'<cite title="Source Title" class="font-weight-bold text-danger"> By <b>ADMIN</b>:-'.$adm_name.'</cite>&nbsp;
                                        <span class="" style="font-size: 20px;"><i class="fas fa-pen" style="color: #2F80ED;">'.mysqli_num_rows(mysqli_query($con,"SELECT * FROM answers WHERE que_id=".$row['que_id'])).'</i></span>
                                        </figcaption>
                                    </div>
                                </div>
                                </a>
                                <hr>
                                ';
                        } 
                        if ($faculty_id_que!=NULL) {
                            $fac_name=faculty_id($faculty_id_que);

                            echo '<hr>
                            <div class="float-right" style="color: #2F80ED; font-size:16px;">
                           <div class="mb-3 ml-3 mr-2" style="cursor:pointer;" id="">
                               <a href="edit_question.php?que_id='.$row['que_id'].'"><i class="fas fa-edit"></i></a>
                           </div>
                           <div class="mt-3 ml-3 mr-2" style="cursor:pointer;" onclick="queDelete(this.id)" id="'.$row['que_id'].'">
                               <i class="fas fa-trash-alt"></i>
                           </div> 
                           </div>
                           <a href="view_answer.php?que_id='.$row['que_id'].'">
                                <div class="media m-2 text-justify">
                                    <i class="mt-2 fas fa-chalkboard-teacher fa-2x" style="color: #2F80ED;">&nbsp;</i>
                                    <div class="media-body">
                                        <h4 class="font-weight-bold">'.$row["question"].'</h4>
                                        <br>
                                        <figcaption class="blockquote-footer">'.DateMinute($que_time).'<cite title="Source Title" class="font-weight-bold text-primary"> By <b>Faculty</b>:-'.$fac_name.'</cite>&nbsp;
                                        <span class="" style="font-size: 20px;"><i class="fas fa-pen" style="color: #2F80ED;">'.mysqli_num_rows(mysqli_query($con,"SELECT * FROM answers WHERE que_id=".$row['que_id'])).'</i></span>
                                        </figcaption>
                                    </div>
                                </div>
                                </a>
                                <hr>
                                ';
                            
                            
                        }
                    }
                } 
                
            ?>


</div>
</div>
</div>

    <div class="container mt-3">    

    <?php

    // pagination code starts here with department wise    
   
    $records=mysqli_num_rows(mysqli_query($con,$pageSql));    
            if ($records>0) {
            
                $total_page=ceil($records/$limit); 

                echo'<ul class="pagination justify-content-center">';
                for ($i=1; $i<=$total_page; $i++) {

                    if ($i==$page) {
                        $active='active';
                    } else{
                        $active="";
                    }

                    
                        if (isset($_GET['unit_id'])&& $_GET['unit_id'] != '') {
                            $PageNo='<li class="page-item '.$active.'"><a class="page-link" href="ask_question.php?d_id='.$d_id.'&semester='.$semester.'&sub_id='.$sub_id.'&unit_id='.$unit_id.'&page='.$i.'">'.$i.'</a></li>';
                        
                        }else{

                            $PageNo='<li class="page-item '.$active.'"><a class="page-link" href="ask_question.php?d_id='.$d_id.'&semester='.$semester.'&sub_id='.$sub_id.'&page='.$i.'">'.$i.'</a></li>';
                        }

                    echo $PageNo;
                }
                echo'</ul>';
                }
        
            } else {
                echo '<p class="text-center text-danger bg-light">No units found</p>';
                                
            }
        }
    } 
    // else {
    //     echo "<h2 class='text-danger text-center mt-5'>Invalid ID</h2> ";
    // }
    ?>
</div>

    <?php } include 'footer.php'; ?>