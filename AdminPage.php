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
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Bag Tracking And Alert System</title>
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
      <li class="selected"><a href="Adminpage.php">Home</a></li>
          <li><a href="NewAgent.php">New Agent</a></li>
          <li><a href="ManageAgents.php">Manage Agents </a></li>
		   <li><a href="AccidentPoints.php">View Accident Points </a></li>
		    <li><a href="TrackBag.php">Track Bag</a></li>
			  <li><a href="Logout.php">Logout</a></li>
			  
        </ul>
      </div>
    </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      <div id="banner"></div>
	  <div id="sidebar_container">
        <div class="sidebar">
          <div class="sidebar_top"></div>
          <div class="sidebar_item">
            <!-- insert your sidebar items here -->
            <h3 style="color:red;">Admin Panel </h3>
           
      Here You can Manage Agents , Create New post office and visit the accident points 

	  
</ul>

          </div>
          <div class="sidebar_base"></div>
        </div>
        <div class="sidebar">
          <div class="sidebar_top"></div>
          <div class="sidebar_item">
            <h3>Track a bag </h3>
            <form method="post" action="#" id="search_form">
              <p>
                <input class="search" type="text" name="search_field" value="Enter Bag Number" />
                <input name="search" type="image" style="border: 0; margin: 0 0 -9px 5px;" src="style/search.png" alt="Search" title="Search" />
              </p>
            </form>
          </div>
          <div class="sidebar_base"></div>
        </div>
      </div>
      <div id="content">
        <!-- insert the page content here -->
        <h1><b>Welcome to Admin Panel</b></h1>
        <mark><h3>Latest Alerts </mark>
       <table border=5 height=300 width=600 >
	    <tr><td><p> All Alerts Goes Here</P></tr></td>
	   </table>
	   <mark><h3>Latest Accident Points </mark>
	   <table border=5 height=300 width=600 >
	   <tr><td><p>Latest Accident points goes here</p></tr></td>
	   </table>
	   
       
        
      </div>
    </div>
    <div id="content_footer"></div>
    <div id="footer">
     <p>Copyright &copy; Bag Tracking And Alert System </p>
    </div>
  </div>
</body>
</html>
