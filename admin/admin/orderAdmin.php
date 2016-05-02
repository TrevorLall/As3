<html>
<head>
<link rel="stylesheet" type="text/css" href="../admin/stylesheets/style.css" />
<head>
<body>
	
<?php
	require 'inludes/dbTest.php';
	/*if(!isset($_SESSION['roleId'])){
		header('location: login.php ');
	}
	else{*/
	if(isset($_POST['updateBtn'])){
		$upname = $_POST['item_name'];
		$upprice = $_POST['quantity'];
		$updesc = $_POST['sale_price'];
		$upqoh = $_POST['credit_type'];
		$upsales = $_POST['card_name'];
		$upnum  = $_POST['card_number'];
		$upsc = $_POST['security_code'];
		$upexp  = $_POST['exp_date'];
		
		$payIndex=$_POST['payIndex'];
		$upIndex=$_POST['actionIndex'];
		if($update= $conn->query("UPDATE `payment_method` SET `credit_type`= '{$upqoh}',`card_number`='{$upnum}',`security_code`='{$upsc }',`exp_date`='{$upexp}',`card_name`='{$upsales}' where payment_id= {$payIndex}")){
			echo "updated User! :)";
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	?>
	<div class="header">
        <div class="headerContent">
            <a href="#">
                <img src="../admin/images/BannerLogoasd.png" alt="PhishyLabs Logo" title="PhishyLabs Logo" />
            </a>
            <div class="nav">
                <ul>
                    <li><a href="homeAdmin.php">Home</a></li>
                    <li><a href="usersAdmin.php">Users</a></li>
                    <li><a href="itemsAdmin.php">Products</a></li>
                    <li><a><form action='logout.php' id='logBtn' method='POST'><input type='submit' name='logout' value='Logout'></form></li>
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
		<div class="CSSTableGenerator"><table border="1" style="solid"><?php
		// output data of each row
		echo "<th>order_id</th><th>username</th><th>order_date</th><th>Item name</th><th>Quantity</th><th>Price</th><th> Card Type</th><th>Card Name</th><th>Card Number</th><th>Security Code</th><th>Expiration</th><th>Action</th>" ;
			while($row = $result->fetch_assoc()) {?><form action="" method="POST"><?php
				echo "<tr><td>" . $row["order_id"].  "</td>";
				echo "<td>" . $row["username"] .  "</td>
				<td>" . $row["order_date"].  "</td>
				<td>" . $row["item_name"].  "</td>"
				."<td>" . $row["quantity"].  "</td>"
				."<td>" . $row["sale_price"].  "</td>"
				."<td><input type='text' name='credit_type' value='" . $row["credit_type"].  "'</td>"
				."<td><input type='text' name='card_name' value='" . $row["card_name"].  "'</td>"
				."<td><input type='text' name='card_number' value='" . $row["card_number"].  "'</td>"
				."<td><input type='text' name='security_code' value='" . $row["security_code"].  "'</td>"
				."<td><input type='date' name='exp_date' value='" . $row["exp_date"].  "'</td>"
				."<td><input type='submit' name='updateBtn' value ='Update'>'"
				."<input type='hidden' name='actionIndex' value='".$row["order_id"] ."'>"
				."<input type='hidden' name='payIndex' value='".$row["payment_id"] ."'></td></tr>";?></form><?php
			}
			?></table></div>
			<?php
			$result-> free();
				
		} else {
			echo "No Sales Made To LimitedTimeOnly.com";
		}
		mysqli_close($conn);
	}	

?>
	</div>
	<?php
	//}
	?>
</body>
</html>