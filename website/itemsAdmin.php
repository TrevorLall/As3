<html>
<head>
<head>
<body>
<?php
	require 'dbTest.php';
	
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
	
	<h1>Welcome To Admin System</h1>
	<a href="usersAdmin.php">Users</a>
	<a href="orderAdmin.php">Orders</a>
	<h2>Item Information</h2>
	<?php
	if($result=$conn->query("SELECT * FROM `inv_items` ORDER BY item_id")){
		if ($result->num_rows > 0) {?>
		<table border="1" style="solid"><?php
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
			?></table>
			<?php
			$result-> free();
				
		} else {
			echo "0 results";
		}
		mysqli_close($conn);
	}	
?>
	<br /><br />
	<h2>Add Item</h2>
	<form action="" method="post">
		<input type="text" placeholder="Item Name" name="ItemName">
		<input type="text" placeholder="Item Price" name="ItemPrice"><br/><br/>
		
		<input type="text" placeholder="Item Desc" name="ItemDesc">
		<input type="text" placeholder="item QOh" name="ItemQoh"><br/><br/>
		<input type="date" placeholder="Sale Start" name="ItemStart">
		<input type="date" placeholder="Sale End" name="ItemEnd">
		<input type="submit" name="addItem"value="Add Item">
	</form>
	
</body>
</html>