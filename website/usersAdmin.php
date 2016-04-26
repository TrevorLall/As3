<html>
<head>
	<script type="text/javascript">
		function myFunction(){
			alert("Cannot Delete the Admin!!"); // this is the message in ""
		}
	</script>
</head>
<body>
<?php
	require 'dbTest.php';
	if(isset($_POST['addAdmin'])){
		$user = $_POST['adminUser'];
		$pass = $_POST['adminPass'];
		$fname = $_POST['Firstname'];
		$lname = $_POST['Lastname'];
		$street = $_POST['Street'];
		$city  = $_POST['City'];
		$province = $_POST['Province'];
		$country = $_POST['Country'];
		$postal  = $_POST['Postal'];
		if($insert = $conn->query("INSERT INTO `login_users`(`user_id`, `username`, `password`, `role_id`) VALUES ('null','{$user}','{$pass}', 2)")){
			echo "added User! :)";
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);		
		}
		$Lastid = $conn->insert_id;
		if($insertaddr = $conn->query("INSERT INTO `address`(`address_id`, `first_name`, `last_name`, `city`, `province`, `street`, `postal_code`, `country`, `user_id`) VALUES ('null','{$fname}','{$lname}','{$city}','{$province}','{$street}','{$postal}','{$country}',{$Lastid})")){
			Echo "added to address";
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);		
		}

	}
	if(isset($_POST['deleteBtn'])){
		$delIndex=$_POST['actionIndex'];
		if($delIndex == 13){
			echo "<script>myFunction()</script>";
		}
		else{
			if($deleteaddr= $conn->query("DELETE FROM `address` WHERE user_id = {$delIndex}")){
				echo "Deleted Address!";
			}
			if($delete= $conn->query("DELETE FROM `login_users` WHERE user_id = {$delIndex}")){
				echo "Deleted user!";
			}
			else{
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
	}	
	if(isset($_POST['updateBtn'])){
		$upuser = $_POST['theUser'];
		$uppass = $_POST['thePass'];
		$upfname = $_POST['theFirst'];
		$uplname = $_POST['theLast'];
		$upstreet = $_POST['theStreet'];
		$upcity  = $_POST['theCity'];
		$upprovince = $_POST['thePro'];
		$upcountry = $_POST['theCo'];
		$uppostal  = $_POST['thePo'];
		$upIndex=$_POST['actionIndex'];
		if($update= $conn->query("UPDATE `login_users` SET `username`='{$upuser}',`password`='{$uppass}' WHERE user_id = {$upIndex}")){
			echo "updated User! :)";
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		if($updateAddr= $conn->query("UPDATE `address` SET `first_name`='{$upfname}',`last_name`='{$uplname}',`city`='{$upcity}',`province`='{$upprovince}',`street`='{$upstreet}',`postal_code`='{$uppostal}',`country`='{$upcountry}' WHERE user_id = {$upIndex}")){
			echo "updated address! :)";
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}	
	?>
	
	<h1>Welcome To Admin System</h1>
	<a href="itemsAdmin.php">Items</a>
	<a href="orderAdmin.php">Orders</a>
	<h2>User Information</h2>
	<?php
	if($result=$conn->query("SELECT * FROM `login_users` INNER JOIN login_roles USING (role_id) LEFT JOIN address USING (user_id) ORDER BY user_id")){
		if ($result->num_rows > 0) {?>
		<table border="1" style="solid"><?php
		// output data of each row
		echo "<th>user</th><th>password</th><th>description</th><th>First Name</th><th>Last Name</th><th>Street</th><th>City</th><th>Province</th><th>Country</th><th>Postal Code</th><th>Actions</th>" ;
		$i=0;
			while($row = $result->fetch_assoc()) {?><form action="" method="POST"><?php
				echo "<tr><td><input type='text' name='theUser' value='" . $row["username"].  "'></td>";
				echo "<td><input type='text' name='thePass' value='" . $row["password"] .  "'</td>
				<td>" . $row["role_desc"].  "</td>
				<td><input type='text'name='theFirst' value='" . $row["first_name"].  "'</td>"
				."<td><input type='text' name='theLast' value='" . $row["last_name"].  "'</td>"
				."<td><input type='text' name='theStreet' value='" . $row["street"].  "'</td>"
				."<td><input type='text' name='theCity' value='" . $row["city"].  "'</td>"
				."<td><input type='text' name='thePro' value='" . $row["province"].  "'</td>"
				."<td><input type='text' name='theCo' value='" . $row["country"].  "'</td>"
				."<td><input type='text' name='thePo' value='" . $row["postal_code"].  "'</td>"
				."<td><input type='submit' name='deleteBtn' value ='Delete'>"
				."<input type='submit' name='updateBtn' value ='Update'>"
				."<input type='hidden' name='actionIndex' value='".$row["user_id"] ."'></td></tr>";?></form><?php
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
	<h2>Add user</h2>
	<form action="" method="post">
		<input type="text" placeholder="Username" name="adminUser">
		<input type="text" placeholder="Password" name="adminPass"><br/><br/>
		
		<input type="text" placeholder="Firstname" name="Firstname">
		<input type="text" placeholder="Lastname" name="Lastname"><br/><br/>
		<input type="text" placeholder="Street" name="Street">
		<input type="text" placeholder="City" name="City"><br/><br/>
		<input type="text" placeholder="Province" name="Province">
		<input type="text" placeholder="Country" name="Country">
		<input type="text" placeholder="Postal Code" name="Postal">
		<input type="submit" name="addAdmin"value="Add Client">
	</form>
	
</body>
</html>