<?php
	session_start();
	require "inludes/DbTest.php";
	
	if(isset($_POST['confirmBtn'])){
		$price = $_SESSION['AmountSelected'] * $_SESSION['itemPrice'];
		if($insert = $conn->query("INSERT INTO `order_detail`(`od_id`, `quantity`, `sale_price`, `item_id`, `order_id`) VALUES ('null',{$_SESSION['AmountSelected']},{$price},{$_SESSION['Itemid']},{$_SESSION["order_id"]})")){
			echo "added Item! :)";
			$data = $conn->query("UPDATE `inv_items` SET `item_qoh`= item_qoh - {$_SESSION['AmountSelected']}  WHERE item_id  = {$_SESSION[Itemid]}");
			header('Location: MainPage.php');
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);		
		}
	}
?>