<html>
<head>
<title> Login page </title>
</head>
<body>
<form method="POST">
	<input type="text" name="userval">
	<input type="password" name="passval">
	<input type="submit" name="subbtn" value="Login">
</form>
<form method="POST">
<?php
require 'inludes/DbTest.php';
	if ( isset( $_POST['subbtn'] ) ) 
	{ 
		if($_POST["userval"] == null || $pass = $_POST["passval"] == null)
		{
			echo "Please fill in both fields.";
		}
		else
		{
		$usernme = $_POST["userval"];
		$pass = $_POST["passval"];
			login($usernme, $pass, $conn);
		}
	}
		function login($user, $passw, $conn) {
			// Using prepared statements means that SQL injection is not possible. 
			$res = $conn->query("SELECT username, password, user_id, role_id
				FROM login_users
			   WHERE username = '$user' AND password = '$passw'");
			   
				$row = $res->fetch_array(MYSQLI_BOTH);
				if($row != null)
				{
					session_start();
					if($row['role_id'] == 1)
					{
						$_SESSION['roleId'] = $row['role_id'];
						header('location: homeAdmin.php');
					}
					else
					{
						$_SESSION['UserId'] = $row['user_id'];
						//$_SESSION['roleId'] = $row['role_id'];
						header('location: mainPage.php');
					}
				}
				else
				{
					echo "Login Invalid.";
				}
			
			}
			
?>
</form>
<form>
	<a href="register.php">
		<input type="button" value="Register" />
	</a>
</form>
</body>
</html>