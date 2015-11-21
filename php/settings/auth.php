<?php
  
  session_start();
  if(!isset($_SESSION['USERID']) || (trim($_SESSION['NAME']) == '')) {
    header("location: ../index.php");
    exit();
  }
?>