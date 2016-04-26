<html>
<head>
<head>
<body>
	
<?php
	require 'dbTest.php';
	
	
	
	?>
	
	<h1>Welcome To Admin System</h1>
	<a href="usersAdmin.php">Users</a>
	<a href="itemsAdmin.php">Items</a>
	<h2>Orders Information</h2>
	<?php
	if($result=$conn->query("SELECT * FROM login_users INNER JOIN orders USING(user_id) INNER JOIN payment_method USING(payment_id) INNER JOIN order_detail USING (order_id) INNER JOIN inv_items USING (item_id)")){
		if ($result->num_rows > 0) {?>
		<table border="1" style="solid"><?php
		// output data of each row
		echo "<th>order_id</th><th>username</th><th>order_date</th><th>Item name</th><th>Quantity</th><th>Price</th><th> Card Type</th><th>Card Name</th><th>Card Number</th><th>Security Code</th><th>Expiration</th>" ;
		$i=0;
			while($row = $result->fetch_assoc()) {?><form action="" method="POST"><?php
				echo "<tr><td>" . $row["order_id"].  "></td>";
				echo "<td>" . $row["username"] .  "</td>
				<td>" . $row["order_date"].  "</td>
				<td>" . $row["item_name"].  "</td>"
				."<td>" . $row["quantity"].  "</td>"
				."<td>" . $row["sale_price"].  "</td>"
				."<td>" . $row["credit_type"].  "</td>"
				."<td>" . $row["card_name"].  "</td>"
				."<td>" . $row["card_number"].  "</td>"
				."<td>" . $row["security_code"].  "</td>"
				."<td>" . $row["exp_date"].  "</td>"
				."<td><input type='submit' name='deleteBtn' value ='Delete'>"
				."<input type='submit' name='updateBtn' value ='Update'>"
				."<input type='hidden' name='actionIndex' value='".$row["order_id"] ."'></td></tr>";?></form><?php
				$i++;
			}
			?></table>
			<?php
			$result-> free();
				
		} else {
			echo "No Sales Made To LimitedTimeOnly.com";
		}
		mysqli_close($conn);
	}	
?>
</body>
</html>