<?php
include '../inc/faculty.php';
require '../db/dbcon.php';
if (isset($_GET['lec_id']) && $_GET['lec_id']!='' ) {
    //pagination of 5 pages code
        $limit=5; // limit of the rows per table ex. 5 item per page

        // if page admin clicks on page then it runs
        if (isset($_GET['page'])) {
            $page=safe_string($_GET['page']);
        }else{
            $page=1;
        }

        $offset=($page-1)*$limit;

    $msg='';

    $lec_id=safe_string($_GET['lec_id']);
    if ($_SERVER['REQUEST_METHOD']=='POST'  and isset($_POST['comment_btn']) and isset($_POST['comment'])) {
        
        if (empty($_POST['comment'])) {
             $msg= '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Comment Empty!!</strong>    Empty comment can not be added
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    ';
                    }else{


        $comment=safe_string($_POST['comment']);
        $faculty_id=$_SESSION['faculty_id'];

        $sql="INSERT INTO `comments` (`lec_id`,`faculty_id`,`comment`) VALUES('$lec_id', '$faculty_id', '$comment')";
        $result=mysqli_query($con,$sql) or die(mysqli_error($con));
        if ($result) {
            $msg= '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Comment Added Successfully!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                   ';
            
               }else{
                        $msg= '
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Comment Can not added!</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                ';
                    }
        }
    }

?>

<body>   
<div class="container mt-5 bg-light p-3">
    <?php $topic=mysqli_fetch_assoc(mysqli_query($con,"SELECT topic FROM lectures WHERE lec_id=$lec_id")) ?>
            <h3 class="text-center font-weight-bold">Comments of <?php echo $topic['topic'] ?></h3>
            <h6><?php if (isset($msg)) {
                echo $msg;
            }  ?> </h6>
            <form action="<?php echo htmlentities($_SERVER['REQUEST_URI']) ?>" method="POST">
                <div class="form-group">
                    
                    <label for="">Question</label>
                    <!-- <input type="text" name="admin" class="form-control"> -->
                    <textarea class="form-control" name="comment" placeholder="Enter Question for this lecture"></textarea>
                    <!-- <input type="text" name="comment" class="form-control" placeholder="Enter Question for this lecture"> -->
                    
                </div>
                <button type="submit" name="comment_btn" class="btn btn-primary">Comment</button>
                
            </form><hr>
                <div class="m-2 p-3">
                    
                            <?php 
                $pageSql="SELECT * FROM comments WHERE lec_id=$lec_id";
                $sql1="SELECT * FROM comments WHERE lec_id=$lec_id LIMIT {$offset},{$limit}";
                // echo $sql;
                    $result1=mysqli_query($con,$sql1);
                    while ($row=mysqli_fetch_assoc($result1)) {
                        $stu_id_com=$row['stu_id'];
                        $admin_id_com=$row['admin_id'];
                        $faculty_id_com=$row['faculty_id'];
                        
                        if($row["update_time"]==NULL){
                            $comment_time=$row["create_time"];

                        }else{
                            $comment_time=$row["update_time"];

                        }
                        
                        
                        
                        if ($stu_id_com!=NULL) {
                            $stu_name=stu_id($stu_id_com);

                                    // <div class="mb-3 ml-3 mr-2" style="cursor:pointer;" id="">
                                    //     <a href="edit_comment.php?comment_id='.$row['comment_id'].'"><i class="fas fa-edit"></i></a>
                                    // </div>
                            echo '<hr>
                                <div class="float-right" style="color: #2F80ED; font-size:16px;">
                                    <div class="mt-3 ml-3 mr-2" style="cursor:pointer;" onclick="comDelete(this.id)" id="'.$row['comment_id'].'">
                                        <i class="fas fa-trash-alt"></i>
                                    </div>
                                </div>
                                <div class="media m-2 text-justify" >
                                     <i class="mt-2 fas fa-user-graduate fa-2x" style="color: #2F80ED;">&nbsp;</i>
                                    <div class="media-body">
                                        <p>'.$row["comment"].'</p>
                                        <figcaption class="blockquote-footer">'.DateMinute($comment_time).'<cite title="Source Title" class="font-weight-bold "> By <b>Student</b>:-'.$stu_name['username'].'</cite>
                                        </figcaption>
                                    </div>
                                </div><hr>
                                ';
                        } 
                        if ($admin_id_com!=NULL) {
                            $adm_name=admin_id($admin_id_com);
                            // fa-universal-access 

                            echo '<hr>
                                <div class="media m-2 text-justify" >
                                     <i class="mt-2 fas fa-university fa-3x" style="color: #2F80ED;">&nbsp;</i>
                                    <div class="media-body">
                                        <p class="font-weight-bold">'.$row["comment"].'</p>
                                        <figcaption class="blockquote-footer">'.DateMinute($comment_time).'<cite title="Source Title" class="font-weight-bold text-danger"> By <b>ADMIN</b>:-'.$adm_name.'</cite>
                                        </figcaption>
                                    </div>
                                </div><hr>
                                ';
                        } 
                        if ($faculty_id_com!=NULL) {
                            $fac_name=faculty_id($faculty_id_com);

                            echo '<hr>
                            <div class="float-right" style="color: #2F80ED; font-size:16px;">
                                    <div class="mb-3 ml-3 mr-2" style="cursor:pointer;" id="">
                                        <a href="edit_comment.php?comment_id='.$row['comment_id'].'"><i class="fas fa-edit"></i></a>
                                    </div>
                                    <div class="mt-3 ml-3 mr-2" style="cursor:pointer;" onclick="comDelete(this.id)" id="'.$row['comment_id'].'">
                                        <i class="fas fa-trash-alt"></i>
                                    </div>
                                </div>
                                <div class="media m-2 text-justify">
                                    <i class="mt-2 fas fa-chalkboard-teacher fa-2x" style="color: #2F80ED;">&nbsp;</i>
                                    <div class="media-body">
                                        <p class="font-weight-bold">'.$row["comment"].'</p>
                                        <figcaption class="blockquote-footer">'.DateMinute($comment_time).'<cite title="Source Title" class="font-weight-bold text-primary"> By <b>Faculty</b>:-'.$fac_name.'</cite>
                                        </figcaption>
                                    </div>
                                </div><hr>
                                ';
                            
                        }
                        
                        
                    }
                ?> 
                </div>
        </div>
        <div class="container mt-3">    

    <?php

    // pagination code starts here with department wise     
        $records1=mysqli_num_rows(mysqli_query($con,$pageSql));
    
        if ($records1>0) {
        
            $total_page=ceil($records1/$limit); 

            echo'<ul class="pagination justify-content-center">';
            for ($i=1; $i<=$total_page; $i++) {

                if ($i==$page) {
                    $active='active';
                } else{
                    $active="";
                }

                

                    
                    $PageNo='<li class="page-item '.$active.'"><a class="page-link" href="comments.php?lec_id='.$lec_id.'&page='.$i.'">'.$i.'</a></li>';
                
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

<script type="text/javascript">
    function comDelete(id) {
        // alert(id);
        if (confirm("Do you really want to delete comment?")) {
                // var sub_id= $(this).data("did");
                var comment_id=id;
                // alert(comment_id);

                $.ajax({
                    url:"delete.php",
                    type:"POST",
                    data:{comment_id: comment_id},
                    success: function(data){
                        if(data==1){
                            window.location.href=window.location.href;
                        } else{
                            alert("Comment not delete");
                        }
                    }
                });
         }
     }
</script>


    <?php include 'footer.php'; ?>