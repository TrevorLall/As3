<?php
// Start the session
session_start();
?>
<?php
require 'inludes/DbTest.php';
	if(isset($_POST['payBtn'])){
		$cname = $_POST['cname'];
		$cnum = $_POST['cnumber'];
		$ctype = $_POST['ctype'];
		$exp = $_POST['exp'];
		$cvs = $_POST['scode'];
		
		$fname = $_POST['firstname'];
		$lname = $_POST['lastname'];
		$street = $_POST['street'];
		$city  = $_POST['city'];
		$province = $_POST['province'];
		$country = $_POST['Country'];
		$postal  = $_POST['pCode'];
		
		
		
		if($insertaddr = $conn->query("INSERT INTO `address`(`address_id`, `first_name`, `last_name`, `city`, `province`, `street`, `postal_code`, `country`, `user_id`) VALUES ('null','{$fname}','{$lname}','{$city}','{$province}','{$street}','{$postal}','{$country}',{$_SESSION['UserId']})")){
			Echo "added to address";
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);		
		}
		$Lastid = $conn->insert_id;
		$_SESSION["address_id"] = $Lastid;
		if($insertpay = $conn->query("INSERT INTO `payment_method`(`payment_id`, `credit_type`, `card_number`, `security_code`, `exp_date`, `user_id`, `address_id`, `card_name`) VALUES ('null','{$ctype}','{$cnum}','{$ctype}','{$exp}',{$_SESSION['UserId']},{$_SESSION["address_id"]},'{$cname}')")){
			Echo "added to address";
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);		
		}
		$PayLastid = $conn->insert_id;
		$_SESSION["pay_id"] = $PayLastid;
		header( 'Location: shippingInformation.php' ) ;
	}
?>