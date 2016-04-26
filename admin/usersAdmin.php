<html>
<head>
	<link rel="stylesheet" type="text/css" href="../admin/stylesheets/style.css" />
	<script>
	function myFunction(){
		alert("Cannot delete admin!");
	}
	</script>
</head>
<body>

<?php
	require 'inludes/dbTest.php';
	if(isset($_POST['addAdmin'])){
		$user = $_POST['adminUser'];
		$pass = $_POST['adminPass'];
		/*$fname = $_POST['Firstname'];
		$lname = $_POST['Lastname'];
		$street = $_POST['Street'];
		$city  = $_POST['City'];
		$province = $_POST['Province'];
		$country = $_POST['Country'];
		$postal  = $_POST['Postal'];*/
		if($insert = $conn->query("INSERT INTO `login_users`(`user_id`, `username`, `password`, `role_id`) VALUES ('null','{$user}','{$pass}', 2)")){
			echo "added User! :)";
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);		
		}
		/*$Lastid = $conn->insert_id;
		if($insertaddr = $conn->query("INSERT INTO `address`(`address_id`, `first_name`, `last_name`, `city`, `province`, `street`, `postal_code`, `country`, `user_id`) VALUES ('null','{$fname}','{$lname}','{$city}','{$province}','{$street}','{$postal}','{$country}',{$Lastid})")){
			Echo "added to address";
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);		
		}*/

	}
	if(isset($_POST['deleteBtn'])){
		$delIndex=$_POST['actionIndex'];
		if($delIndex == 13){
			echo "<script>myFunction()</script>";
		}
		else{
			/*if($deletepay= $conn->query("DELETE FROM `payment_method` WHERE user_id = {$delIndex}")){
				echo "Deleted pay!";
			}
			else{
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			if($deleteaddr= $conn->query("DELETE FROM `address` WHERE user_id = {$delIndex}")){
				echo "Deleted Address!";
			}
			else{
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}*/
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
		/*$upfname = $_POST['theFirst'];
		$uplname = $_POST['theLast'];
		$upstreet = $_POST['theStreet'];
		$upcity  = $_POST['theCity'];
		$upprovince = $_POST['thePro'];
		$upcountry = $_POST['theCo'];
		$uppostal  = $_POST['thePo'];*/
		$upIndex=$_POST['actionIndex'];
		if($update= $conn->query("UPDATE `login_users` SET `username`='{$upuser}',`password`='{$uppass}' WHERE user_id = {$upIndex}")){
			echo "updated User! :)";
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		/*if($updateAddr= $conn->query("UPDATE `address` SET `first_name`='{$upfname}',`last_name`='{$uplname}',`city`='{$upcity}',`province`='{$upprovince}',`street`='{$upstreet}',`postal_code`='{$uppostal}',`country`='{$upcountry}' WHERE user_id = {$upIndex}")){
			echo "updated address! :)";
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}*/
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
                    <li><a href="orderAdmin.php">Orders</a></li>
                    <li><a href="itemsAdmin.php">Products</a></li>
                    <li><a href="#">Log Out</a></li>
                </ul>
            </div>
        </div>
        <div class="headerBreak"></div>
    </div>
	<div class = "mainBody">
		<h1>Welcome To Admin System</h1>
		<input OnClick="location.href='itemsAdmin.php'" type="button" value="Items">
		<input OnClick="location.href='orderAdmin.php'" type="button" value="Orders">
		<h2>User Information</h2>
		<?php
		if($result=$conn->query("SELECT * FROM `login_users` INNER JOIN login_roles USING (role_id) ORDER BY user_id")){
			if ($result->num_rows > 0) {?>
			<div class="CSSTableGenerator" ><table border="1" style="solid"><?php
			// output data of each row
			echo "<th>user</th><th>password</th><th>description</th><th>Actions</th>" ;
			$i=0;
				while($row = $result->fetch_assoc()) {?><form action="" method="POST"><?php
					echo "<tr><td><input type='text' name='theUser' value='" . $row["username"].  "'></td>";
					echo "<td><input type='text' name='thePass' value='" . $row["password"] .  "'</td>
					<td>" . $row["role_desc"].  "</td>"
					."<td><input type='submit' name='deleteBtn' value ='Delete'>"
					."<input type='submit' name='updateBtn' value ='Update'>"
					."<input type='hidden' name='actionIndex' value='".$row["user_id"] ."'></td></tr>";?></form><?php
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
		<div class= "adding"> 
			<h2>Add user</h2>
			<form action="" method="post">
				<input type="text" placeholder="Username" name="adminUser">
				<input type="text" placeholder="Password" name="adminPass"><br/><br/>
				
				<input type="submit" name="addAdmin"value="Add Client">
			</form>
		</div>
	</div>
	
	
	
</body>
</html>