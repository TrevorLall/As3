<?php
// Start the session
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="stylesheet" type="text/css" href="../admin/stylesheets/styleMain.css" />
<title>Insert title here</title>
</head>
<body>
<?php  require 'inludes/DbTest.php'; 
Echo "This is addre" . $_SESSION["address_id"];
	Echo "This is the pay" . $_SESSION["pay_id"];
	echo "ORder ".$_SESSION["order_id"];
	echo "shadreess  ".$_SESSION["sh_address_id"];
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
	<h1>Confirmation Of Order</h1><br />
	<h2>Purchase Information</h2>

	<?php
		if($result=$conn->query("SELECT * From inv_items where item_id = 3")){
			if ($result->num_rows > 0) {?>
			<div class="CSSTableGenerator" ><table border="1" style="solid"><?php
			// output data of each row
			echo "<th>order Number</th><th>Item Name</th><th>description</th><th>Price</th><th>Quantity</th><th>Order</th>" ;
			$i=0;
				while($row = $result->fetch_assoc()) {?><form action="processOrderD" method="POST"><?php
					echo "<tr><td><input type='text' name='theUser' value='" . $_SESSION['order_id'] .  "'></td>";
					echo "<td><input type='text' name='thePass' value='" . $row["item_name"] .  "'</td>
					<td>" . $row["item_desc"].  "</td>"
					."<td>" . $row["item_price"].  "</td>"
					."<td>" . $row["item_qoh"].  "</td>"
					."<td><input type='submit' name='confirmBtn' value ='Order'>";?></form><?php
					$i++;
				}
				?></table></div>
				<?php
				$result-> free();
					
			} else {
				echo "0 results";
			}
			
		}	
	?>
	
	<br />
	<h2>User/Billing Info</h2>
	<h3>Shipping Information</h3>
	<?php
		if($results=$conn->query("SELECT * FROM address where address_id = {$_SESSION["sh_address_id"]}")){
			if ($results->num_rows > 0) {?>
			<div class="CSSTableGenerator" ><table border="1" style="solid"><?php
			// output data of each row
			echo "<th>Name</th><th>Shipping Address</th>" ;
			$i=0;
				while($row = $results->fetch_assoc()) {?><form action="" method="POST"><?php
					echo "<tr><td><input type='text' name='theUser' value='" . $row["first_name"].  " ". $row["last_name"]."'></td>";
					echo "<td><input type='text' name='thePass' value='" . $row["street"] .  " ". $row["city"] .  " ". $row["province"] .  "''</td>";?></form><?php
					$i++;
				}
				?></table></div>
				<?php
				$results-> free();
					
			} else {
				echo "0 results";
			}
		}	
	?>
	<h3>Billing Information</h3>	
	
	<?php
		if($resultpay=$conn->query("SELECT * FROM payment_method INNER JOIN address USING (address_id) where payment_id = {$_SESSION["pay_id"]}")){
			if ($resultpay->num_rows > 0) {?>
			<div class="CSSTableGenerator" ><table border="1" style="solid"><?php
			// output data of each row
			echo "<th>Name</th><th>Billing Address</th><th>Card Name</th><th>Card Number</th><th>Card Type</th>";
			$i=0;
				while($row = $resultpay->fetch_assoc()) {?><form action="" method="POST"><?php
					echo "<tr><td><input type='text' name='theUser' value='" . $row["first_name"].  " ". $row["last_name"]."'></td>";
					echo "<td><input type='text' name='thePass' value='" . $row["street"] .  " ". $row["city"] .  " ". $row["province"] .  "''</td>";
					echo "<td>".$row["card_name"]."</td><td>".$row["card_number"] ."</td><td>". $row["credit_type"] . "</td>";?></form><?php
					$i++;
				}
				?></table></div>
				<?php
				$resultpay-> free();
					
			} else {
				echo "0 results";
			}
			mysqli_close($conn);
		}	
	?>
	</div>
</body>
</html>