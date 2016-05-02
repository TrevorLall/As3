<?php session_start(); ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../admin/stylesheets/styleMain.css" />
<title>Item Details</title>
</head>
<body>
	<?php 
	require 'inludes/DbTest.php';
		$_SESSION['Itemid'] = $_POST['idof'];
		if(!isset($_SESSION['Itemid']))
		{
			header('location: mainPage.php');
		}	
		else
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
		<div class="mainBody"> <?php
				
			$data = $conn->query("SELECT * FROM inv_items WHERE item_id = '$_SESSION[Itemid]'");
			$item = $data->fetch_assoc();
			?> <h3 style="underline"> <?php echo $item['item_name']?></h3> <?php
			echo '<img src="data:image/jpeg;base64,'.base64_encode($item['item_image']).'" height="150" width="100" /><br />';
			echo "Item Price: " . $item["item_price"] . "<br />";
			echo "Quantity remaining: " . $item["item_qoh"] . "<br />";
			echo "Description of Item: " . $item["item_desc"] . "<br />"; 
			$endDate = strtotime($item["sale_end"]);
			$remaining = $endDate - time();
			if($remaining > 0)
			{
				$days_remain = floor($remaining / 86400);
				$hours_remain = floor(($remaining % 86400) / 3600);
				echo "Time left on sale: $days_remain days and $hours_remain hours.<br />";
			}
			else
			{
				echo "Sale has ended!";
			}
			?>
			<br/><br/>
			<div class= "adding"> 
			<form action="payment.php" method="POST">
				
					Select an Amount: <input type="number" name="numbox" value="1" min="1"><br /><br />
					<input type="submit" name="subbtn" value="Buy Now!">
					
			
			
			</form></div>
		<?php
		}
		?>
		</div>
</body>
</html>