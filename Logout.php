<?php
 session_start();
 if (!isset($_SESSION['uname'])) {
  header("Location: index.php");
 } else if(isset($_SESSION['uname'])!="") {
  unset($_SESSION['uname']);
  session_unset();
  session_destroy();
  header("Location: index.php");
 }
 ?>