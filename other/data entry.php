<?php
 include_once 'connect.php'; 
  $uname ="Admin";
  $pass = "123456789";
  $password = hash('sha256', $pass);
  $res=mysql_query("INSERT INTO admin(username,password) VALUES('$uname','$password')");
  
 ?>