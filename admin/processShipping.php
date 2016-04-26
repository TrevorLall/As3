<?php
// Start the session
session_start();
?>
<?php
require 'inludes/DbTest.php';
	Echo "This is addre" . $_SESSION["address_id"];
	Echo "This is the pay" . $_SESSION["pay_id"];
	
	if(isset($_POST['finalStep'])){
		
		$fname = $_POST['sfirstname'];
		$lname = $_POST['slastname'];
		$street = $_POST['sstreet'];
		$city  = $_POST['scity'];
		$province = $_POST['sprovince'];
		$country = $_POST['sCountry'];
		$postal  = $_POST['spCode'];
		
		
		
		if($insertaddr = $conn->query("INSERT INTO `address`(`address_id`, `first_name`, `last_name`, `city`, `province`, `street`, `postal_code`, `country`, `user_id`) VALUES ('null','{$fname}','{$lname}','{$city}','{$province}','{$street}','{$postal}','{$country}',17)")){
			Echo "added to address";
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);		
		}
		
		$Lastid = $conn->insert_id;
		$_SESSION["sh_address_id"] = $Lastid;
		
		if($insertOrder = $conn->query("INSERT INTO `orders`(`order_id`, `order_date`, `user_id`, `address_id`, `payment_id`) VALUES ('null','null',17,{$Lastid},{$_SESSION['address_id']})")){
			Echo "added to order";
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);		
		}
		
		$OrderLastid = $conn->insert_id;
		$_SESSION["order_id"] = $OrderLastid;
		
		header( 'Location: orderDetail.php' ) ;
	}
?>