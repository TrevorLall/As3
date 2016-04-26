<?php session_start();
require 'DbTest.php';
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
<title>Limited Time Only</title>
</head>
<body>
<form method = "POST">
<?php if(isset($_SESSION['UserId']))
	{ ?>
	<h2 text-align="center">Limited Time Only.com</h2> <input type="submit" name="Logbtn" value="Logout">
<?php }
	  else
	  {
		  ?> <input type="submit" name="Loginbtn" value="Login"> <?php
	  }?>
	<h3 text-align="right"><?php echo "Hello, " . $user["username"] . ".";?></h3>
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
</form>
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
<form method="POST">
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
			$sql = "SELECT * FROM inv_items ORDER BY item_id";
		}
		else
		{
			switch($SortChosen)
			{
				case "ASort": $sql = "SELECT * FROM inv_items ORDER BY item_name"; break;
				case "LPSort": $sql = "SELECT * FROM inv_items ORDER BY item_price ASC"; break;
				case "HPSort": $sql = "SELECT * FROM inv_items ORDER BY item_price DESC"; break;
				case "CSort": $sql = "SELECT * FROM inv_items ORDER BY cat_id"; break;
				case "NSort": $sql = "SELECT * FROM inv_items ORDER BY sale_start DESC"; break;
				case "ESort": $sql = "SELECT * FROM inv_items ORDER BY sale_end"; break;
				case "MQSort": $sql = "SELECT * FROM inv_items ORDER BY item_qoh"; break;
				default: echo("ERROR!"); exit(); break;
			}
		}
	}
	else
	{
		$sql = "SELECT * FROM inv_items ORDER BY item_id"; 
	}

	$Sdata = $conn->query($sql);

	if($Sdata)
	{ ?>
		<table id="ItemsTbl"><?php
		$i = 0;
		while($row = $Sdata->fetch_assoc())
		{
			?>
			<form method="POST">
			<?php
			$_SESSION['Itemid'] = "1";
				echo '<tr><td align="center"><a href="itemDetails.php" name="item'.'"><img src="data:image/jpeg;base64,'.base64_encode($row['item_image']).'" height="150" width="100" /></a></td></tr>';
				//echo "<tr><td><input type='image' src='data:image/jpeg;base64,'". base64_encode($row['item_image']) ."' border='0' alt='Submit' /></td></tr>";
				echo "<tr><td align='center'>" . $row["item_name"] . " | Price: " . $row["item_price"] . "$ | Quantity left: " . $row["item_qoh"] . "</td><tr>";
				echo "<tr><td align='center'>" . $row["item_desc"] . "</td><tr>";
				//if($_POST['item'.$i.''])
			//	{
			//		$_SESSION['Itemid'] = $row['item_id'];
				//}
				?></form><?php
				
				$i++;
		}
		?></table>
		<?php 
		
		$Sdata-> free();
	}
	else
	{
		echo "No Sales on offer at this moment, please come back later!";
	}
?>
</form>
</body>
</html>
