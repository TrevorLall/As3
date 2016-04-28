<?php session_start(); ?>
<html>
<head>
<title>Item Details</title>
</head>
<body>
	<?php 
	require 'inludes/DbTest.php';
		$_SESSION['Itemid'] = 2;
		if(!isset($_SESSION['Itemid']))
		{
			header('location: mainPage.php');
		}	
		else
		{
			$data = $conn->query("SELECT * FROM inv_items WHERE item_id = '$_SESSION[Itemid]'");
			$item = $data->fetch_assoc();
			?> <h3 style="underline"> <?php $item['item_name']?></h3> <?php
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
			<form action="payment.php" method="POST">
				<div style="float:right;">
					Select an Amount: <input type="number" name="numbox" value="1" min="1"><br />
					<input type="submit" name="subbtn" value="Buy Now!">
					
				</div>
			<?php
		}
	?>
</form>
</body>
</html>