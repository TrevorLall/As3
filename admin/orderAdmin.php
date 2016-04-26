<html>
<head>
<link rel="stylesheet" type="text/css" href="../admin/stylesheets/style.css" />
<head>
<body>
	
<?php
	require 'inludes/dbTest.php';

	?>
	<div class="header">
        <div class="headerContent">
            <a href="#">
                <img src="../admin/images/BannerLogoasd.png" alt="PhishyLabs Logo" title="PhishyLabs Logo" />
            </a>
            <div class="nav">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="usersAdmin.php">Users</a></li>
                    <li><a href="itemsAdmin.php">Products</a></li>
                    <li><a href="#">Log Out</a></li>
                </ul>
            </div>
        </div>
        <div class="headerBreak"></div>
    </div>
	<div class="mainBody">
	<h1>Welcome To Admin System</h1>
	<input OnClick="location.href='usersAdmin.php'" type="button" value="Users">
	<input OnClick="location.href='itemsAdmin.php'" type="button" value="Items">
	<h2>Orders Information</h2>
	<?php
	if($result=$conn->query("SELECT * FROM login_users INNER JOIN orders USING(user_id) INNER JOIN payment_method USING(payment_id) INNER JOIN order_detail USING (order_id) INNER JOIN inv_items USING (item_id)")){
		if ($result->num_rows > 0) {?>
		<table border="1" style="solid"><?php
		// output data of each row
		echo "<th>order_id</th><th>username</th><th>order_date</th><th>Item name</th><th>Quantity</th><th>Price</th><th> Card Type</th><th>Card Name</th><th>Card Number</th><th>Security Code</th><th>Expiration</th>" ;
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
	</div>
</body>
</html>