<?php
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
  }
    else
    {
    header("Location:AgentLogin.php");
	exit;
     }
	 
if ( isset($_POST['add']) ) {
  
  // clean user inputs to prevent sql injections
  
  $sourcepo=(string)$_SESSION['uid'];
  
   $res=mysql_query("SELECT * FROM bagid WHERE pinno='$sourcepo'");
   $row=mysql_fetch_array($res);
   $key=$row['lastbagid'];
   
   $bagid=$row['lastbagid']+1000001;
   $bagid=(string)$sourcepo.(string)$bagid;
   $bagid=(float)$bagid;
   $bagid=$bagid-1000000;
  
  
  $destpo = $_POST['destpo'];
  
  $weight = $_POST['weight'];

  $weightage = $_POST['weightage'];  
  
  // basic pino validation
  if (empty($destpo)) {
   $error = true;
   $destpoError = "Please enter PIN no.";
  } 
     else{
   // check pin no exist or not
   $query = "SELECT pinno FROM agent WHERE pinno='$destpo'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);
   if($count!=1){
    $error = true;
    $destpoError = "Please Provide pin no which is already added.";
   }
   }
  if($error&&isset($destpoError)){
  echo "<script>alert('$destpoError')</script>";
  }
  
  // basic name validation
  if (empty($weight)){
   $error = true;
   $weightError = "Please enter weight.";
  }
   else if (!preg_match("/^[0-9.]+$/",$weight)) {
   $error = true;
   $weightError = "weight must contain only numbers.";
  }
  if($error&&isset($weightError)){
  echo "<script>alert('$weightError')</script>";
  }
  
  // password validation
  if (empty($weightage)){
   $error = true;
   $weightageError = "Please select weightage.";
  }
   if($error&&isset($weightageError)){
  echo "<script>alert('$weightageError')</script>";
  }
   
   
  // if there's no error, continue
  if( !$error ) {
   $query = "INSERT INTO bag(bagid,sourcepo,destpo,lastpo,weight,weightage) VALUES('$bagid','$sourcepo','$destpo','$sourcepo','$weight','$weightage')";
   $res = mysql_query($query);
   $query=" UPDATE bagid SET lastbagid='$key'+1 WHERE pinno='$sourcepo'";
   $res1=mysql_query($query);
   if ($res&&$res1){
    $errTyp = "success";
    $errMSG = "Successfully Added";
    unset($weightage);
    unset($weight);
	unset($sourcepo);
	unset($destpo);
	unset($bagid);
	unset($_POST['add']);
    header("Location:AgentPage.php");
   }else{
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
          <li><a href="AgentPage.php">Home</a></li>
          <li class="selected"><a href="NewBag.php">New Bag </a></li>
          <li><a href="UpdateBag.php">Update Bag Status </a></li>
		   <li><a href="SendBag.php">Send Bag </a></li>
		    <li><a href="TrackBag.php">Track Bag</a></li>
			  <li><a href="Logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
	<br>
	 <form method="post">
        <h1>Add New Bag</h1>
        <fieldset>
	<?php
	    $sourcepo=$_SESSION['uid'];
		$res=mysql_query("SELECT * FROM bagid WHERE pinno='$sourcepo'");
   $row=mysql_fetch_array($res);
   $key=$row['lastbagid'];
   $bagid=$row['lastbagid']+1000001;
   $bagid=(string)$sourcepo.(string)$bagid;
   $bagid=(float)$bagid;
   $bagid=$bagid-1000000;
		echo '<label>Bag ID:</label>
          <input type="text" name="bagid" value=';echo "$bagid readonly>";
		 ?> 
          <label>Destination PO:</label>
          <input type="text" name="destpo">
		  
		  <label>Weight:(kgs)</label>
          <input type="text"  name="weight">
          
          <label>Weightage:(1 to 10)</label>
          <input type="number" min="1" max="10" name="weightage">
        </fieldset>
        <button type="submit" name="add">Add Bag</button>
      </form>
    <div id="content_footer"></div>
    <div id="footer">
     <p>Copyright &copy; Bag Tracking And Alert System </p>
    </div>
  </div>
</body>
</html>
