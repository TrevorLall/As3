<?php 
session_start(); 
?>
<html>
<head>
<title>Payment page</title>
<link rel="stylesheet" type="text/css" href="../admin/stylesheets/styleMain.css" />
</head>
<body>
	<?php
	require 'inludes/DbTest.php';
	
	if(!isset($_SESSION['UserId'])){
		$_SESSION['AmountSelected'] = $_POST["numbox"]; 
		header('location: login.php ');
	}
	else{
		if(!isset($_SESSION['AmountSelected'])){
			$_SESSION['AmountSelected'] = $_POST["numbox"]; 
		}
	?>
	
	
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
						<li><a href="www.fb.com">Contact Us</a></li>
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
						
						<li><a><form action='www.login.php' id='logBtn' method='POST'><input type='submit' name='login' value='Login'></form></a></li>
					</ul>
				</div>
			</div>
			<div class="headerBreak"></div>
		</div>
		<div class="mainBody">


		  <?php
	  }?>
	<h1>Payment Information</h1>
	<h2>Complete the following: </h2>
	<form action="processPayment.php" method="POST">
		<table align="center">
        	<tr>
                <td>Cardholder's Name</td><td>Card Number</td>
			</tr>
				<tr>
					<td><input type="text" name= "cname" required></td>
					<td><input type="text" name= "cnumber" required></td>
            </tr>
            <tr>
                <td>Card Type</td><td>Expiration</td><td>CVS</td>
			</tr>
			<tr>
				<td><input type="text" name= "ctype" required></td>
                <td><input type="date" name= "exp" required></td>
				<td><input type="text" name= "scode" required></td>
            </tr>
           
				
			<tr><td><br /></td></tr>
			<tr>
                <td>First Name</td><td>Last Name</td>
			</tr>
				<td><input type="text" name= "firstname" required></td>
                <td><input type="text" name= "lastname" required></td>
            </tr>
            <tr>
                <td>Street</td><td>City</td> 
      		</tr>
			<tr>
				<td><input type="text" name= "street" required></td>
      			<td><input type="text" name= "city" required></td> 
			</tr>
      		<tr>
      			<td>Province</td><td>Country</td><td>Postal Code</td>
			</tr>
			<tr>
				<td><input type="text" name= "Country" required></td>
                <td><input type="text" name= "pCode" required></td>  
				<td><input type="text" name="province" required></td> 				
            </tr>
			<tr>
				<td></td>
			</tr>
	    </table>
		<input type="submit" name="payBtn" value="Continue">
    </form>
	</div>
	<?php
	 }
	?>
</body>
</html>