<?php
 ob_start();
 session_start();
 include_once 'connect.php';

 if ( isset($_SESSION['uname'])!="" )
 {
 $uname=$_SESSION['uname'];
  $query = "SELECT username FROM admin WHERE username='$uname'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);
   if($count==1){
    header("Location:AdminPage.php");
	exit;
     } 
	else{
    header("Location: AgentPage.php");
  exit;}
 }
 // it will never let you open index(login) page if session is set
 $error = false;
 
 if( isset($_POST['login']) ) { 
  
  // prevent sql injections/ clear user invalid inputs
  $aemail = trim($_POST['aemail']);
  $aemail = strip_tags($aemail);
  $aemail = htmlspecialchars($aemail);
  $apass = trim($_POST['apass']);
  $apass = strip_tags($apass);
  $apass = htmlspecialchars($apass);
  // prevent sql injections / clear user invalid inputs
  
  if(empty($aemail)){
   $error = true;
   $aemailError = "Please enter your email address.";
  }
  if($error&&isset($aemailError))
  {
  echo "<script>alert('$aemailError')</script>";
  }
  
  if(empty($apass)){
   $error = true;
   $apassError = "Please enter your password.";
  }
   if($error&&isset($apassError))
  {
  echo "<script>alert('$apassError')</script>";
  }
  
  // if there's no error, continue to login
  if (!$error) {
   //$password = hash('sha256', $apass); // password hashing using SHA256
  
   $res=mysql_query("SELECT * FROM agent WHERE aemail='$aemail'");
   $row=mysql_fetch_array($res);
   $count = mysql_num_rows($res); // if aemail/apass correct it returns must be 1 row
   
   if( $count == 1 && $row['apass']==$apass ) {
	$_SESSION['uname']=$row['aemail'];
	$_SESSION['uid']=$row['pinno'];
	header("Location: AgentPage.php");
   }
   else {
    $errMSG = "Incorrect Credentials, Try again...";
	echo "<script>alert('wrong credentials')</script>";
	unset($_POST['login']);
   }
   }
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Bag Tracking And Alert System</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <link rel="stylesheet" type="text/css" href="style/style1.css" />
</head>

<body style="background-color:white;">
  <div id="main">
    <div id="header1">
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="index.php">Home</a></li>
          <li><a href="AdminLogin.php">Admin Login</a></li>
          <li class="selected"><a href="AgentLogin.php">Agent Login</a></li>
        </ul>
      </div>
    </div>
	<br>
	<br>
	<br>
        <div class="login-card">
    <h1>Log-in</h1><br>
  <form method="POST">
    <input type="text" name="aemail" placeholder="Email">
    <input type="password" name="apass" placeholder="Password">
    <input type="submit" name="login" class="login login-submit" value="login">
  </form>

  <div class="login-help">
    <a href="fpass.php">Forgot Password?</a>
  </div>
</div>
    </div>
	<br>
	<br>
	<br>
    <div id="content_footer"></div>
    <div id="footer">
      <p><a href="index.php">Home</a> | <a href="AdminLogin.php">Admin Login</a> | <a href="AgentLogin.php">Agent Login</a> </p>
      <p>Copyright &copy; Bag Tracking And Alert System </p>
    </div>
  </div>
</body>
</html>
