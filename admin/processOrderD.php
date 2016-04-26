<?php
	session_start();
	require "inludes/DbTest.php";
	
	if(isset($_POST['confirmBtn'])){
		$price = $_SESSION['item_quantity'] * $_SESSION['item_price'];
		if($insert = $conn->query("INSERT INTO `order_detail`(`od_id`, `quantity`, `sale_price`, `item_id`, `order_id`) VALUES ('null',{$_SESSION['item_quantity']},{$price},{$_SESSION['item_id']},{$_SESSION['order_id']})")){
			echo "added Item! :)";
			header('Location: MainPage.php')
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);		
		}
	}
?>