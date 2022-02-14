<?php
include '../inc/faculty.php';
?>
        <style type="text/css">
        .container{
            margin-left: 10%;
            margin-top: 3%;
            height: 480px;
            width: 460px;
            transition: bottom 0.4s, opacity 0.4s;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.3);
            border-radius: 10px;
        }
        .container .fa-user-graduate{
            font-size: 80px;
            color: #FAFFD1;
            margin-left: 40%;
            margin-top: 5% ;
        }
        .container .text{
            font-size: 28px;
            font-weight: 600;
            color: #FAFFD1;
        }
        .container .close-btn button{
            padding: 9px 13px;
            font-size: 18px;
            margin-left: 37%;
            text-transform: uppercase;
            border-radius: 3px;
            font-weight: 600;
            cursor: pointer;
            border: 2px solid wheat;
            border-radius: 5px;
        }

        </style>

<body>

<div class="container">
<div class="fas fa-user-graduate">
    <h1>Hello</h1>
</div>
<div class="text">
<h3>
<?php echo"Welcome Faculty";
      // echo"<br>";
      // echo"Faculty-Id:- "; echo $_SESSION['faculty_id'];
      echo"<br>";
      echo"Username:- ";echo $_SESSION['username'];
      echo"<br>";
      echo"Email-Id:- ";echo $_SESSION['email'];
      echo"<br>";
      echo"Mobile-No:- ";echo $_SESSION['mobile'];
      echo"<br>";
      echo"Department-Id:- ";echo d_id($_SESSION['d_id']);
  ?>
</h3>
</div>
<div class="close-btn">
<button><a href="#">UPDATE</a></button>
</div>
</div><!--container div -->

    
</body>
</html>