<?php
 session_start();
 include_once 'connect.php';
 
  if ( isset($_SESSION['uname'])!="" )
 {
 $uname=$_SESSION['uname'];
  $query = "SELECT username FROM admin WHERE username='$uname'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);
   if($count!=1){
    header("Location:AgentPage.php");
	exit;
     }
  }
    else
    {
    header("Location:AdminLogin.php");
	exit;
     }
 
if ( isset($_POST['add']) ) {
  
  // clean user inputs to prevent sql injections
  $pinno=$_POST['pinno'];
  
  $aname = trim($_POST['aname']);
  $aname = strip_tags($aname);
  $aname = htmlspecialchars($aname);
  
  $aemail = trim($_POST['aemail']);
  $aemail = strip_tags($aemail);
  $aemail = htmlspecialchars($aemail);

  $aphno = trim($_POST['aphno']);
  $aphno = strip_tags($aphno);
  $aphno = htmlspecialchars($aphno);  
  
  $apass = trim($_POST['apass']);
  $apass = strip_tags($apass);
  $apass = htmlspecialchars($apass);
  
  $asex=$_POST['asex'];
  
  $aaddress=$_POST['aaddress'];
  
  $pname = trim($_POST['pname']);
  $pname = strip_tags($pname);
  $pname = htmlspecialchars($pname);
  
  $paddress=$_POST['paddress'];
  
  // basic pino validation
  if (empty($pinno)) {
   $error = true;
   $pinError = "Please enter PIN no.";
  } 
   else{
   // check pin no exist or not
   $query = "SELECT pinno FROM agent WHERE pinno='$pinno'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);
   if($count!=0){
    $error = true;
    $pinError = "Provided pin no is already added.";
   }
   }
  if($error&&isset($pinError)){
  echo "<script>alert('$pinError')</script>";
  }
  
  // basic name validation
  if (empty($aname)) {
   $error = true;
   $anameError = "Please enter Agent full name.";
  } 
   else if (!preg_match("/^[a-zA-Z ]+$/",$aname)) {
   $error = true;
   $anameError = "Agent Name must contain alphabets and space.";
  }
  if($error&&isset($anameError)){
  echo "<script>alert('$anameError')</script>";
  }
  
  //basic email validation
   if (empty($aemail)) {
   $error = true;
   $aemailError = "Please enter Valid Email.";
  } 
   else{
   // check email exist or not
   $query = "SELECT aemail FROM agent WHERE aemail='$aemail'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);
   if($count!=0){
    $error = true;
    $aemailError = "Provided Email is already in use.";
   }
   }
  if($error&&isset($aemailError)){
  echo "<script>alert('$aemailError')</script>";
  }
  
  
  //basic phno validation
   if (empty($aphno)) {
   $error = true;
   $aphnoError = "Please enter Valid Phno.";
  }
    else{
   // check phno exist or not
   $query = "SELECT aphno FROM agent WHERE aphno='$aphno'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);
   if($count!=0){
    $error = true;
    $aphnoError = "Provided PhoneNO is already in use.";
   }
   }
   if($error&&isset($aphnoError)){
  echo "<script>alert('$aphnoError')</script>";
  }
  
  // password validation
  if (empty($apass)){
   $error = true;
   $apassError = "Please enter password.";
  } else if(strlen($apass) < 6) {
   $error = true;
   $apassError = "Password must have atleast 6 characters.";
  }
/*else if($apass!=$capass)
  {
   $error = true;
  $apassError = "Passwords doesnt match.";
  }*/
   if($error&&isset($apassError)){
  echo "<script>alert('$apassError')</script>";
  }
   
   if (empty($asex)) {
   $error = true;
   $asexError = "Please enter Agent sex.";
  }
 if($error&&isset($asexError)){
  echo "<script>alert('$asexError')</script>";
 }
 
 
  if (empty($aaddress)) {
   $error = true;
   $aaddressError = "Please enter valid agent Address.";
  }
 if($error&&isset($aaddressError)){
  echo "<script>alert('$aaddressError')</script>";
 }
 
 
 if (empty($pname)) {
   $error = true;
   $pnameError = "Please enter post office full name.";
  }  else if (!preg_match("/^[a-zA-Z ]+$/",$pname)) {
   $error = true;
   $pnameError = "Post Office Name must contain alphabets and space.";
  }
  if($error&&isset($pnameError)){
  echo "<script>alert('$pnameError')</script>";
  }
 
 
   if (empty($paddress)) {
   $error = true;
   $paddressError = "Please enter valid post office Address.";
  }
 if($error&&isset($paddressError)){
  echo "<script>alert('$paddressError')</script>";
 }
 
  //$password = hash('sha256', $apass);
  // if there's no error, continue to signup
  if( !$error ) {
   $query = "INSERT INTO agent(pinno,aname,aemail,aphno,apass,agender,aaddress,pname,paddress) VALUES('$pinno','$aname','$aemail','$aphno','$apass','$asex','$aaddress','$pname','$paddress')";
   $res = mysql_query($query);
   if ($res) {
    $query = "INSERT INTO bagid(pinno) VALUES('$pinno')";
	$res = mysql_query($query);
	if($res){
    $errTyp = "success";
    $errMSG = "Successfully registered, Agent may login now";
    unset($pinno);
	unset($aname);
    unset($aemail);
    unset($aphno);
    unset($apass);
	unset($asex);
	unset($aaddress);
	unset($pname);
	unset($paddress);
	unset($_POST['add']);
    header("Location:Adminpage.php");
   } }else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } 
   echo "<script>alert('$errMSG')</script>";
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
   <link rel="stylesheet" type="text/css" href="style/style2.css" />
</head>

<body>
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
          <li><a href="Adminpage.php">Home</a></li>
          <li class="selected"><a href="NewAgent.php">New Agent</a></li>
          <li><a href="ManageAgents.php">Manage Agents </a></li>
		   <li><a href="AccidentPoints.php">View Accident Points </a></li>
		    <li><a href="TrackBag.php">Track Bag</a></li>
			  <li><a href="Logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
	<br>
	 <form method="post">
      
        <h1>Add Agent</h1>
        <fieldset>
		<label>PIN NO:</label>
          <input type="text" name="pinno">
		  
          <label>Agent Name:</label>
          <input type="text" id="name" name="aname">
          
          <label>Email:</label>
          <input type="email" name="aemail">
		  
		  <label>Agent Phone no:</label>
          <input type="text"  name="aphno">
          
          <label>Password:</label>
          <input type="password" name="apass">
		  
          <label>Sex:</label>
          <input type="radio" value="male" name="asex"><label  class="light">Male</label><br>
          <input type="radio" value="female" name="asex"><label  class="light">Female</label>
		  <br>
		  <br>		
		  <label>Agent Address:</label>
          <textarea name="aaddress"></textarea>
		  
		  <label>Post Office Name:</label>
          <input type="text" name="pname">
		  
		  <label>Post Office Address:</label>
          <textarea name="paddress"></textarea>
        </fieldset>
        <button type="submit" name="add">Add</button>
      </form>
    <div id="content_footer"></div>
    <div id="footer">
     <p>Copyright &copy; Bag Tracking And Alert System </p>
    </div>
  </div>
</body>
</html>
