<?php
// Start the session
session_start();
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../admin/stylesheets/styleMain.css" />
<title> Payment page </title>
</head>
<body>
	<?php
	require 'inludes/DbTest.php';
	
	Echo "This is addre" . $_SESSION["address_id"];
	Echo "This is the pay" . $_SESSION["pay_id"];
	?>
	<div class="header">
        <div class="headerContent">
            <a href="#">
                <img src="../admin/images/BannerLogoasd.png" alt="PhishyLabs Logo" title="PhishyLabs Logo" />
            </a>
            <div class="nav">
                <ul>
                    <li><a href="homeAdmin.php">Home</a></li>
                    <li><a href="orderAdmin.php">Orders</a></li>
                    <li><a href="itemsAdmin.php">Products</a></li>
                    <li><a href="#">Log Out</a></li>
                </ul>
            </div>
        </div>
        <div class="headerBreak"></div>
    </div>
	<div class="mainBody">
	<h1>Shipping Information</h1>
	<h2>Complete the following: </h2>
	<form action="processShipping.php" method="POST">
	 <table>
			<tr>
                <td>First Name</td><td>Last Name</td>
			</tr>
			<tr>
				<td><input type="text" name= "sfirstname" required></td>
                <td><input type="text" name= "slastname" required></td>
            </tr>
            <tr>
                <td>Street</td><td>City</td><td>Province</td>
			</tr>
			</tr>
				<td><input type="text" name= "sstreet" required></td>
      			<td><input type="text" name= "scity" required></td> 
      			<td><input type="text" name="sprovince" required></td>   
      		</tr>
      		<tr>
      			<td>Country</td><td>Postal Code</td>
			</tr>
			<tr>
				<td><input type="text" name= "sCountry" required></td>
                <td><input type="text" name= "spCode" required></td>      
            </tr>
			<tr><td><input type="submit" name="finalStep" value="Checkout"></td></tr>
	    </table>
	    
    </form>
	</div>
</body>
</html>