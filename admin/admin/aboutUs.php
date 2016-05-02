<?php session_start();
require 'inludes/DbTest.php';
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../admin/stylesheets/styleMain.css" />
<title>Limited Time Only</title>
</head>
<body>
<?php if(isset($_SESSION['UserId']))
	{ ?>

	<div class="header">
			<div class="headerContent">
				<a href="#">
					<img src="../admin/images/BannerLogoasd.png" alt="PhishyLabs Logo" title="PhishyLabs Logo" />
				</a>
				<div class="nav">
					<ul>
						<li><a href="mainPage.php">Home</a></li>
						<li><a href="aboutUs.php">About Us</a></li>
						<li><a href="http://www.facebook.com">Contact Us</a></li>
						<li><a><form action='logout.php' id='logBtn' method='POST'><input type='submit' name='logout' value='Logout'></form></a></li>
					</ul>
				</div>
			</div>
			<div class="headerBreak"></div>
		</div>
		<div class="mainBody">
	
<?php }
	  else
	  {
		  ?> 
		  
		  <div class="header">
			<div class="headerContent">
				<a href="#">
					<img src="../admin/images/BannerLogoasd.png" alt="PhishyLabs Logo" title="PhishyLabs Logo" />
				</a>
				<div class="nav">
					<ul>
						<li><a href="mainPage.php">Home</a></li>
						<li><a href="aboutUs.php">About Us</a></li>
						<li><a href="http://www.facebook.com">Contact Us</a></li>
						<li><a><form action='login.php' id='logBtn' method='POST'><input type='submit' name='login' value='Login'></form></a></li>
					</ul>
				</div>
			</div>
			<div class="headerBreak"></div>
		</div>
		<div class="mainBody">


		  <?php
	  }?>
	  <h1>About Us!</h1>
	  <p>Here at LimitedTimeOnly.com, we strive to get prices to what our consumers strive for!</p>
	  </div>
</body>
</html>