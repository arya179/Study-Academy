<?php
include '../inc/top.php';
?>
<!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->
<!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script>	 -->
<style type="text/css">
.container{
            margin-left: 10%;
            margin-top: 3%;
            height: 20rem;
            width: 16rem;
            transition: bottom 0.4s, opacity 0.4s;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.3);
            border-radius: 10px;
        }
        .container .fa-user-lock{

            font-size: 2rem;
            color: #FAFFD1;
            /* margin-left: 40%; */


        }
        .container .texts{
            font-size: 1.3rem;
            font-weight: 600;
            color: #FAFFD1;
        }
        .container .close-btn button{
            padding: 0.3rem 0.4rem;
            font-size: 1rem;
            display: block;
            margin: auto;
            text-transform: uppercase;
            font-weight: 600;
            cursor: pointer;
            border: 2px solid wheat;
            border-radius: 5px;	
        }

    </style>
</head>
<body>

    <div class="container">

            <div class="fas fa-user-lock mt-3">
                <h2>Hello</h2>
            </div>
            <div class="texts">

                <?php echo"Welcome Admin";
                echo"<br>";
                echo"Name :- "; echo $_SESSION['username'];
                echo"<br>";
                // echo"Email-Id:- ";echo $_SESSION['email'];
                ?>

            </div>
            <div class="close-btn p-1 pb-3">
                <button class="mb-1"><a href="#">UPDATE</a></button>
                <button><a href="#">Change Password</a></button>
            </div>
    </div><!--container div -->

    <?php include 'footer.php'; ?>