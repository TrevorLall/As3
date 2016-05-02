<?php
	session_start();
	require "inludes/DbTest.php";
	
	if(isset($_POST['logout'])){
		session_destroy();
		header('location: mainPage.php');
	}
?>