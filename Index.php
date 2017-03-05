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
 ?>
 
<!DOCTYPE HTML>
<html
<head>
  <title>Bag Tracking and Alert System</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
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
          <li class="selected"><a href="index.php">Home</a></li>
          <li><a href="AdminLogin.php">Admin Login</a></li>
          <li><a href="AgentLogin.php">Agent Login</a></li>
        </ul>
      </div>
    </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      <div id="banner2"></div>
	  <div id="sidebar_container">
        <div class="sidebar">
          <div class="sidebar_top"></div>
          <div class="sidebar_item">
            <!-- insert your sidebar items here -->
            <h3>Latest News</h3>
            <h4>New Website Launched</h4>
          
            <p>Login to Agent panel to manage the Bag,Track the bag and view last status of the bag</p>
          </div>
          <div class="sidebar_base"></div>
        </div>
        <div class="sidebar">
          <div class="sidebar_top"></div>
          <div class="sidebar_item">
            <h3>Goto </h3>
            <ul>
              <li><a href="#">Admin Dashboard </a></li>
              <li><a href="#">Agent Dashboard</a></li>
              <li><a href="#">Track a bag</a></li>
              
            </ul>
          </div>
          <div class="sidebar_base"></div>
        </div>
        <div class="sidebar">
          <div class="sidebar_top"></div>
          <div class="sidebar_item">
            <h3>Search</h3>
            <form method="post" action="#" id="search_form">
              <p>
                <input class="search" type="text" name="search_field" value="Enter keywords....." />
                <input name="search" type="image" style="border: 0; margin: 0 0 -9px 5px;" src="style/search.png" alt="Search" title="Search" />
              </p>
            </form>
          </div>
          <div class="sidebar_base"></div>
        </div>
      </div>
      <div id="content">
        <!-- insert the page content here -->
        <h1>Welcome to Bag Tracking and Alert System </h1>
        <p>Every Post office will register in the system, update the post office details like location, postal code, email id and all other relevant details. When there is new bag to be dispatched an Unique Bag Identification number is added to it and same is entered into the system using Bar code scanner or using manual entry. The Unique number is now used to check the status of the bag, detailed tracking of the bag, last shipment time. When a new bag is received to the predestination offices, an agent in that post office login through the portal and updates the status of bag with time and sends it to the next station. If no status is heard from the Next station in the stipulated period the bag is now assumed to be lost and the Alert is sent to the source post office.</p>
        <h2>Admin Dashboard </h2>
   
        <ul>
          <li>Internet Explorer 9</li>
          <li>FireFox 25</li>
          <li>Google Chrome 31</li>
        </ul>
      </div>
    </div>
    <div id="content_footer"></div>
    <div id="footer">
       <p><a href="index.php">Home</a> | <a href="AdminLogin.php">Admin Login</a> | <a href="AgentLogin.php">Agent Login</a> </p>
      <p>Copyright &copy; Bag Tracking And Alert System </p>
    </div>
  </div>
</body>
</html>
