<?php
include '../inc/student.php';
require '../db/dbcon.php';

if (isset($_GET['semester']) && $_GET['semester']!='') {

    $semester=safe_string($_GET['semester']);
    $d_id=$_SESSION['d_id'];
    
    

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
            echo '<a class="btn btn-warning  m-2 my-4" href="view_mcqs_units.php?sub_id='.$subRow['sub_id'].'">' . sub_id($subRow['sub_id']) . '</a>';
        } else {
            echo '<a class="btn btn-secondary  m-2 my-4" href="view_mcqs_units.php?sub_id='.$subRow['sub_id'].'">' . sub_id($subRow['sub_id']) . '</a>';
        }
    }
}
echo'</center>';
}

if (isset($_GET['sub_id']) && $_GET['sub_id']!='') {
        
        $sub_id=safe_string($_GET['sub_id']);

        $unitSQL="SELECT * FROM `unit` WHERE sub_id=$sub_id";


            $unitResult = mysqli_query($con, $unitSQL);
            $num=mysqli_num_rows($unitResult);
            if ($num>0) {
?>
<div class="container ">
    <center>
                <div class="">
                <h3 class="rounded-pill shadow-lg text-light bg-light mt-4 p-3 "><b class="text-dark text-decoration-underline"><?php echo sub_id($sub_id);  ?></b></h3>
            </div>
    </center>
</div>
<div class="container bg-light mt-3 p-3" style="" >

    
        <!-- showing units according to unit start -->
        <?php
            
                while ($unitRow = mysqli_fetch_assoc($unitResult)) {
                    $unitArr=unit_id($unitRow['unit_id']);
                        
                        echo '<div class="shadow ahover my-3 rounded-lg">
                            
                        <a style="font-size: 17px; font-weight: 500;" class="col-9  p-3 text-left btn  " href="view_mcqs.php?sub_id='.$sub_id.'&unit_id='.$unitRow['unit_id'].'">'.$unitArr["unit_number"].'.&nbsp;'.$unitArr["unit_name"].'</a>
                        
                        </div>
                        ';
                    
                    
                }
            

        ?>
        <!-- showing units according to unit ends-->
    
    </div>

	

<?php
} else {
                echo '<p class="text-center text-danger bg-light font-weight-bold">No units found!!</p>';
                                
            }
        }
    

     
  include 'footer.php'; ?>