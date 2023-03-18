<?php
session_start();
 //db include
require '../db/dbcon.php';

// if(!isset($_SESSION['loggedin']) OR $_SESSION['loggedin'] != true)
// {
//     session_abort();
  
// } 
session_unset();
session_destroy();

?>