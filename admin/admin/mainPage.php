<?php session_start();
require 'inludes/DbTest.php';
if(isset($_SESSION['UserId']))
{
$person = $conn->query("SELECT username FROM login_users WHERE user_id = '$_SESSION[UserId]'");
$user = $person->fetch_assoc();
}
else
{
	$user = array( "username" => "Visitor");
}?>
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
	<h1 text-align="right"><?php echo "Hello, " . $user["username"] . ".";?></h1>
	<?php
		if(isset($_POST['Logbtn']))
	{
		session_destroy();
		header('location: mainPage.php');
	}
	if(isset($_POST['Loginbtn']))
	{
		header('location: login.php');
	}
	?>

<form action="mainPage.php" method="POST">
	<p> Select a Sorting Method </p>
	<select name="SortA">
		<option value=""> Select... </option>
		<option value="ASort"> Sort Alphabetically </option>
		<option value="LPSort"> Sort by lowest price </option>
		<option value="HPSort"> Sort by highest price </option>
		<option value="CSort"> Sort by category </option>
		<option value="NSort"> Sort by newest </option>
		<option value="ESort"> Sort by ending </option>
		<option value="MQSort"> Sort by Minimal Quantity </option>
	</select>
	<input type="submit" name="SortSubmit" value="Sort" >
</form>
<?php
	if(isset($_POST['SortSubmit']))
	{
		$SortChosen = $_POST['SortA'];
		$error = "";
		if(empty($SortChosen))
		{
			$error = "<p style='color:red;'> Please select a sorting method. </p>";
		}

		if($error != "")
		{
			echo($error);
			$sql = "SELECT * FROM inv_items WHERE sale_end >= CURDATE() ORDER BY item_id";
		}
		else
		{
			switch($SortChosen)
			{
				case "ASort": $sql = "SELECT * FROM inv_items WHERE sale_end >= CURDATE() ORDER BY item_name"; break;
				case "LPSort": $sql = "SELECT * FROM inv_items WHERE sale_end >= CURDATE() ORDER BY item_price ASC"; break;
				case "HPSort": $sql = "SELECT * FROM inv_items WHERE sale_end >= CURDATE() ORDER BY item_price DESC"; break;
				case "CSort": $sql = "SELECT * FROM inv_items WHERE sale_end >= CURDATE() ORDER BY cat_id"; break;
				case "NSort": $sql = "SELECT * FROM inv_items WHERE sale_end >= CURDATE() ORDER BY sale_start DESC"; break;
				case "ESort": $sql = "SELECT * FROM inv_items WHERE sale_end >= CURDATE() ORDER BY sale_end"; break;
				case "MQSort": $sql = "SELECT * FROM inv_items WHERE sale_end >= CURDATE() ORDER BY item_qoh"; break;
				default: echo("ERROR!"); exit(); break;
			}
		}
	}
	else
	{
		$sql = "SELECT * FROM inv_items WHERE sale_end >= CURDATE() ORDER BY item_id";
	}

	$Sdata = $conn->query($sql);

	if($Sdata)
	{ ?>
		<div class='adding'><table id="ItemsTbl"><?php
		while($row = $Sdata->fetch_assoc())
		{
			?>
			<form action='itemDetails.php' method="POST">
			<?php
				//echo '<tr><td align="center"><a href="itemDetails.php" onclick="ItemFunction($row["item_id"]);"><img src="data:image/jpeg;base64,'.base64_encode($row['item_image']).'" height="150" width="100" /></a></td></tr>';
				echo "<input type='hidden' name='idof' value='" . $row["item_id"] . "'>";
				echo '<tr><td align="center"><input type="image" src="data:image/jpeg;base64,'.base64_encode($row['item_image']).'" alt="submit" height="150" width="110px" name="imgbtn" "/>';
				echo "<tr><td align='center'>" . $row["item_name"] . " | Price: " . $row["item_price"] . "$ | Quantity left: " . $row["item_qoh"] . "</td><tr>";
				echo "<tr><td align='center'>" . $row["item_desc"] . "</td><tr>";
				$endDate = strtotime($row["sale_end"]);
				$remaining = $endDate - time();
				$days_remain = floor($remaining / 86400);
				$hours_remain = floor(($remaining % 86400) / 3600);
				echo "<tr><td align='center'>Time left on sale: $days_remain days and $hours_remain hours.<br /><br /></td></tr>";
				?></form><?php
		}
		?></table></div>
		<?php

		$Sdata-> free();
	}
	else
	{
		echo "No Sales on offer at this moment, please come back later!";
	}
	/*if(isset( $_POST['imgbtn']))
	{
		header('location: login.php');
	}*/
?>
</div>

</body>
</html>