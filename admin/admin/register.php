<html>
<head>
<link rel="stylesheet" type="text/css" href="../admin/stylesheets/styleMain.css" />
<title> Registration Page </title>

</head>
<body>
<div class="header">
			<div class="headerContent">
				<a href="#">
					<img src="../admin/images/BannerLogoasd.png" alt="PhishyLabs Logo" title="PhishyLabs Logo" />
				</a>
				<div class="nav">
					<ul>
						<li><a href="mainPage.php">Home</a></li>
						<li><a href="aboutUs.php">About Us</a></li>
						<li><a href="http://www.facebook.com">Contact Us</a></li>
					</ul>
				</div>
			</div>
			<div class="headerBreak"></div>
		</div><div class="mainBody">
<?php if(isset($_SESSION['UserId']))
	{ header("location: mainPage.php"); } ?>
<form action="login.php" method="POST">
	<div>
		<input name="UserN" type="text" required="required" id="uNamefield" placeholder="Username">
	</div>
	<div>
		<input name="Pass" type="password" required="required" id="passField" placeholder="Password">
	</div>
	<div>
		<input name="regbtn" type="submit" id="registerbtn" value="Register">
	</div>
</form></div>
<form method="POST">
<?php
require 'inludes/DbTest.php';
//if(isset($_POST['regbtn']))
function newuser($conn)
{
	$username = $_POST["UserN"];
	$password = $_POST["Pass"];
	$add=$conn->query("INSERT INTO login_users (user_id,username,password,role_id) VALUES (null,'$username','$password','2')");
	//$data = $con->query($add);
	if ($conn->query($add) === TRUE) {
	//if($data){
    echo "New record created successfully";
} else {
    echo "Error: " . $add . "<br>" . $conn->error;
}
}
function SignUp($conn)
{
if(!empty($_POST['UserN']) && (!empty($_POST["Pass"])))   
{
	$sel = $conn->query("SELECT * FROM login_users WHERE username = '$_POST[UserN]'");
	$Sdata = $sel->fetch_array(MYSQLI_BOTH);
	if(!$Sdata)
	{
		newuser($conn);
	}
	else
	{
		echo "Sorry, this username is taken.";
	}
}
else
{
	if($_POST["UserN"] == null || $pass = $_POST["Pass"] == null)
		echo "Please enter a username and password.";
}
}
if(isset($_POST['regbtn']))
{
	SignUp($conn);
}
	?>
</form>
<?php
?>
</body>
</html>