<?php
	session_start();
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../admin/stylesheets/style.css" />
<head>
<body>
<?php
	require 'inludes/dbTest.php';
	if($_SESSION['roleId'] != 1 || $_SESSION['roleId'] == null ){
		header('location: login.php ');
	}
	else{
		if(isset($_POST['addItem'])){
			$name = $_POST['ItemName'];
			$price = $_POST['ItemPrice'];
			$desc = $_POST['ItemDesc'];
			$qoh = $_POST['ItemQoh'];
			$start = $_POST['ItemStart'];
			$end  = $_POST['ItemEnd'];
			echo $start;
			if($insert = $conn->query("INSERT INTO `inv_items`(`item_id`, `item_name`, `item_price`, `item_desc`, `item_qoh`, `item_image`, `sale_start`, `sale_end`, `cat_id`) VALUES ('null','{$name}',{$price},'{$desc}',{$qoh},'null','{$start}','{$end}',1)")){
				echo "added Item! :)";
			}
			else{
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);		
			}
			//$Lastid = $conn->insert_id;
			

		}
		if(isset($_POST['deleteBtn'])){
			$delIndex=$_POST['actionIndex'];
			if($delete= $conn->query("DELETE FROM `inv_items` WHERE item_id = {$delIndex}")){
				echo "deleted item! :)";
			}
			else{
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}	
		if(isset($_POST['updateBtn'])){
			$upname = $_POST['thename'];
			$upprice = $_POST['thePrice'];
			$updesc = $_POST['theDesc'];
			$upqoh = $_POST['theQoh'];
			$upsales = $_POST['thatStart'];
			$upsalee  = $_POST['theEnd'];
			$upIndex=$_POST['actionIndex'];
			if($update= $conn->query("UPDATE `inv_items` SET `item_name`= '{$upname}',`item_price`={$upprice},`item_desc`='{$updesc}',`item_qoh`={$upqoh},`sale_start`='{$upsales}',`sale_end`='{$upsalee}' WHERE item_id = {$upIndex}")){
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
						<li><a href="#">Home</a></li>
						<li><a href="usersAdmin.php">Users</a></li>
						<li><a href="orderAdmin.php">Orders</a></li>
						<li><a href="#">Log Out</a></li>
					</ul>
				</div>
			</div>
			<div class="headerBreak"></div>
		</div>
		<div class="mainBody">
		<h1>Welcome To Admin System</h1>
		<input OnClick="location.href='usersAdmin.php'" type="button" value="Users">
		<input OnClick="location.href='orderAdmin.php'" type="button" value="Orders">
		<h2>Item Information</h2>
		<?php
		if($result=$conn->query("SELECT * FROM `inv_items` ORDER BY item_id")){
			if ($result->num_rows > 0) {?>
			<div class="CSSTableGenerator" ><table border="1" style="solid"><?php
			// output data of each row
			echo "<th>Item Name</th><th>Price</th><th>description</th><th>Quantity</th><th>Sale Start</th><th>Sale End</th><th>Actions</th>" ;
			$i=0;
				while($row = $result->fetch_assoc()) {?><form action="" method="POST"><?php
					echo "<tr><td><input type='text' name='thename' value='" . $row["item_name"].  "'></td>";
					echo "<td><input type='text' name='thePrice' value='" . $row["item_price"] .  "'</td>
					<td><input type='text' name='theDesc' value='" . $row["item_desc"].  "'</td>
					<td><input type='text'name='theQoh' value='" . $row["item_qoh"].  "'</td>"
					."<td><input type='date' name='thatStart' value='" . $row["sale_start"].  "'</td>"
					."<td><input type='date' name='theEnd' value='" . $row["sale_end"].  "'</td>"
					."<td><input type='submit' name='deleteBtn' value ='Delete'>"
					."<input type='submit' name='updateBtn' value ='Update'>"
					."<input type='hidden' name='actionIndex' value='".$row["item_id"] ."'></td></tr>";?></form><?php
					$i++;
				}
				?></table></div>
				<?php
				$result-> free();
					
			} else {
				echo "0 results";
			}
			mysqli_close($conn);
		}	
		?>
		<br /><br />
		<div class="adding">
			<h2>Add Item</h2>
			<form action="" method="post">
				<input type="text" placeholder="Item Name" name="ItemName">
				<input type="text" placeholder="Item Price" name="ItemPrice"><br/><br/>
				
				<input type="text" placeholder="Item Desc" name="ItemDesc">
				<input type="text" placeholder="item QOh" name="ItemQoh"><br/><br/>
				<input type="date" placeholder="Sale Start" name="ItemStart"><br/>
				<input type="date" placeholder="Sale End" name="ItemEnd"><br/>
				<input type="submit" name="addItem"value="Add Item">
			</form>
		</div>
		</div>
	<?php
	}
	?>

</body>
</html>