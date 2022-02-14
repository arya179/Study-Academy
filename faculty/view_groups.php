<?php
include '../inc/faculty.php';
require '../db/dbcon.php';

if (isset($_GET['d_id'])>0 && $_GET['d_id']<5 && $_GET['d_id']!='') 
    {
        // pagination of 5 pages code
        $limit=5; // limit of the rows per table ex. 5 item per page

        // if page admin clicks on page then it runs
        if (isset($_GET['page'])) {
            $page=$_GET['page'];
        }else{
            $page=1;
        }

        $offset=($page-1)*$limit;
        $d_id=$_GET['d_id'];
        
?>

<body>
        <div class="container-fluid">
            <center>

        <?php 
        $dark = $semActive = $semEcho = $sub = $subActive = $sub_id1='';
        $flag=false;

            // data fetching through department wise
        $sql="SELECT  exam_group.*, department.department FROM exam_group,department WHERE exam_group.d_id=$d_id && department.d_id=$d_id LIMIT {$offset},{$limit}";


        //pagination query through department wise
        $pageSql="SELECT * FROM `exam_group` WHERE exam_group.d_id=$d_id";

        // this condition checks get variable of sem_id  if admin click on semester 1 then sem_id available and records will view as semester wise
            if (isset($_GET['sem_id']) && $_GET['sem_id']!='' ) 
            {
                if ($_GET['d_id']>0 && $_GET['sem_id']<=8) {

                $semActive=$_GET['sem_id'];
                $semEcho='Semester&nbsp;'.$semActive.'&nbsp;in';
                

                    $sem_id=$_GET['sem_id'];

                    //pagination query through semester wise
                    $pageSql="SELECT * FROM `exam_group` WHERE exam_group.d_id=$d_id and exam_group.semester=$sem_id";

                    $subSql = "SELECT * FROM `subject` WHERE subject.d_id=$d_id and subject.semester=$sem_id";

                    // data fetching through semester wise with row limit
                    $sql="SELECT exam_group.*, department.department FROM exam_group,department WHERE exam_group.d_id=$d_id && department.d_id=$d_id && exam_group.semester=$sem_id LIMIT {$offset},{$limit}";
                    // die($sql);
                        if (isset($_GET['sub_id']) && $_GET['sub_id'] != '') {
                            $sub_id1 = $_GET['sub_id'];
                            $flag=true;
                            
                            $pageSql="SELECT * FROM `exam_group` WHERE exam_group.d_id=$d_id and exam_group.semester=$sem_id and sub_id=$sub_id1 ";
                            $sql="SELECT * FROM `exam_group` WHERE exam_group.d_id=$d_id and exam_group.semester=$sem_id and sub_id=$sub_id1 LIMIT {$offset},{$limit}";
                                
                        }
                }else{
                    echo "<td class='text-center text-danger font-weight-bold' colspan='9'> sem_id must between 1 to 8. Data is shown according to department wise </td>"; 
                }
            }
            

        for ($sem=1; $sem<=8; $sem++) {

                if ($sem==$semActive) {
                    $dark='btn-purple';
                } else{
                    $dark="btn-warning";
                }
                    echo '<a class="btn '.$dark.' m-2 my-4" href="view_groups.php?d_id='.$d_id.'&sem_id='.$sem.'">Semester '.$sem.'</a>';
                 
            }
            ?>
    </center>
        <div class="card">
            <div class="card-header">
                <h3 class="text-center "><em class="text-primary font-weight-bold text-decoration-underline"><?php echo $semEcho ?></em>&nbsp; <b class="text-decoration-underline text-danger"><?php echo d_id($d_id); ?></b>  &nbsp;<b class=" font-weight-normal text-decoration-underline">Groups</b></h3>
            </div>
            <center>
                    <!-- showing sujects according to semester start -->
                    <?php
                    if (isset($subSql)) {
                        
                        $subResult = mysqli_query($con, $subSql);
                        while ($subRow = mysqli_fetch_assoc($subResult)) {

                            if ($subRow['sub_id'] == $sub_id1) {
                                echo '<a class="btn btn-success  m-2 my-4" href="view_groups.php?d_id=' . $d_id . '&sem_id=' . $sem_id . '&sub_id=' . $subRow['sub_id'] . '">' . sub_id($subRow['sub_id']) . '</a>';
                            } else {
                                echo '<a class="btn btn-secondary  m-2 my-4" href="view_groups.php?d_id=' . $d_id . '&sem_id=' . $sem_id . '&sub_id=' . $subRow['sub_id'] . '">' . sub_id($subRow['sub_id']) . '</a>';
                            }
                            
                        }
                    }

                    ?>
                    <!-- showing sujects according to semester ends-->
                </center>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table thover ts table-bordered ">
                        <thead class="table-success">
                            <tr>
                                <th  width="2%">No</th>
                                <?php

                                    if (!isset($subSql)) {
                                        echo "<th width='3%'>Semester</th>
                                              ";
                                    }
                                    ?>
                                    <?php

                                    if ($flag==false) {
                                        echo "
                                              <th width='8%'>Subject</th>";
                                    }
                                    ?>
                                <th  width="6%">Total Questions</th>
                                <th  width="6%">Duration</th>
                                <th  width="10%">Date</th>
                                <th  width="10%">Time</th>
                                <th  width="10%">Group Token</th>
                                <!-- <th  width="4%">Admin</th> -->
                                <th colspan="2" width="15%">Questions</th>
                                <th width="10%" colspan="2">Action</th>
                                <th  width="8%">Given Exam</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
        
            
        //fetch the student data from databse

                            // die(mysqli_error($con));
        $result=mysqli_query($con,$sql);

        $records=mysqli_num_rows($result);
        // die($records);

        if ($records==0){
            echo "<td colspan='15' align='center' class='text-danger'><b>No groups!</td></b>";

        }else{          
         
            $No = $offset;
        while ($row = mysqli_fetch_assoc($result)) {
            $No = $No + 1;
             // time added
            // prx($row);
                                    $date=$row['date'];
                                    $time=$row['time'];
                                    $group_id=$row['group_id'];
                                    $start_time = date('Y-m-d H:i:s', strtotime("$date $time"));
                                    // $start_time=$combinedDT;
                                    $now=date("Y-m-d H:i:s");
                                    // $time_minutes=$row['time'];
                                    $total_time_minutes=$row['total_time_minutes'];
                                    $added_time=date("h:i:s A",strtotime($time."+".$total_time_minutes." Minutes"));
                                    $end_time=date('Y-m-d H:i:s', strtotime("$date $added_time"));

                                // time added ends
        ?>
                        <?php
                            // $sql="SELECT * FROM exam_group ORDER BY group_id  DESC";
                            // $result=mysqli_query($con,$sql) or die(mysqli_error($con));
                            // $num=mysqli_num_rows($result);
                        
                            // if ($num>0) {
                            //     $No=0;
                            // while ($row=mysqli_fetch_array($result)) {
                            //     $No = $No + 1;
                               
                        ?>
                            
                            <tr>
                                <td><?php echo "<b>".$No."</b>"; ?></td>
                                <?php

                                            if (!isset($subSql)) {
                                                echo "<td>" . $row['semester'] . "</td>
                                                      ";
                                            }
                                            ?>
                                            <?php

                                            if ($flag==false) {
                                                echo "
                                                      <td>" . sub_id($row['sub_id']) . "</td>";
                                            }
                                            ?>
                                <td> <?php echo $row['total_questions']; ?> </td>
                                <td> <?php echo $row['total_time_minutes']; ?> </td>
                                <td> <?php echo DateWeek($date); ?> </td>
                                <td> <?php echo TimeMinute($time)." to ".$added_time; ?> </td>
                                <td> <?php echo $row['group_token']; ?> </td>
                                <!-- <td> <?php echo admin_id($row['admin_id']); ?> </td> -->

                                <?php 
                                
                                // die($combinedDT);
                                if ($now>$end_time) {

                                    echo '<td class="text-right">
                                            <p class="btn btn-sm btn-secondary " name="">Exam Over</p>
                                        </td>';
                                }elseif($now>$start_time && $now<$end_time){
                                    // die($start_time);
                                     echo '<td class="text-right">
                                                <p class="btn btn-sm btn-warning " name="">Exam Running</p>
                                            </td>';
                                }else{
                                    echo '<td class="text-right">
                                    <a href="add_questions.php?group_id='.$group_id.'" class="btn btn-sm btn-warning " name="">Add Questions</a>
                                </td>';
                                }

                                 ?>
                                <td class="text-left">
                                    <a href="view_questions.php?group_id=<?php echo $group_id; ?>" class="btn btn-sm btn-success ">View Questions</a>
                                </td>
                                 <?php 
                                
                                // die($combinedDT);
                                    if($now>$start_time && $now<$end_time){
                                         echo '<td class="text-right">
                                                <p class="btn btn-sm btn-warning " name="">Exam Running</p>
                                            </td>';
                                    }elseif ($now>$end_time) {
                                        echo '<td class="text-right">
                                            <p class="btn btn-sm btn-secondary " name="">Exam Over</p>
                                        </td>';
                                    }else{
                                    echo '<td class="text-right">
                                            <a href="edit_group.php?group_id='.$group_id.'" class="btn  btn-primary" href="">Edit</a>
                                        </td>';
                                    }

                                 ?>

                                
                               <!--  <td >
                                    <a href="edit_group.php?group_id='.$group_id.'" class="btn  btn-primary" href="">Edit</a>
                                </td> -->
                                <td>
                                    <a href="delete.php?group_id=<?php echo $group_id; ?>" class="btn btn-danger" href="">Delete</a>
                                </td>
                                <?php 
                                
                                // die($combinedDT);
                                if ($now<$start_time) {
                                    echo '<td >
                                    <p class="btn btn-sm btn-info " name="">Exam not Started</p>
                                </td>';
                                }elseif($now>$start_time && $now<$end_time){
                                     echo '<td>
                                                <p class="btn btn-sm btn-warning " name="">Exam Running</p>
                                            </td>';
                                }else{
                                    echo '<td >
                                            <a href="given_exam.php?group_id='.$group_id.'" class="btn  btn-purple" href="">Given exam</a>
                                        </td>';
                                }

                                 ?>

                            </tr>
                            <?php
                        }
                    }
                        ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
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

                if (isset($_GET['sem_id']) && $_GET['d_id']>0 && $_GET['sem_id']<=8 && $_GET['sem_id']!='') {

                    if (isset($_GET['sem_id']) && $_GET['d_id']>0 && $_GET['sem_id']<=8 && $_GET['sem_id']!=''&& isset($_GET['sub_id']) && $_GET['sub_id']!='' ) {
                        $PageNo='<li class="page-item '.$active.'"><a class="page-link" href="view_groups.php?d_id='.$d_id.'&sem_id='.$sem_id.'&sub_id='.$sub_id1.'&page='.$i.'">'.$i.'</a></li>';
                    }else{

                    $PageNo='<li class="page-item '.$active.'"><a class="page-link" href="view_groups.php?d_id='.$d_id.'&sem_id='.$sem_id.'&page='.$i.'">'.$i.'</a></li>';
                    }
                }else{
                    $PageNo='<li class="page-item '.$active.'"><a class="page-link" href="view_groups.php?d_id='.$d_id.'&page='.$i.'">'.$i.'</a></li>';
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
</body>
</html>
