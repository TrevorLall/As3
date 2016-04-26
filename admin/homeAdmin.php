<html>
<head>
<link rel="stylesheet" type="text/css" href="../admin/stylesheets/style.css" />
<head>
<body>
	
<?php
	require 'inludes/dbTest.php';

	?>
	<div class="header">
        <div class="headerContent">
            <a href="#">
                <img src="../admin/images/BannerLogoasd.png" alt="PhishyLabs Logo" title="PhishyLabs Logo" />
            </a>
            <div class="nav">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="usersAdmin.php">Users</a></li>
                    <li><a href="itemsAdmin.php">Products</a></li>
                    <li><a href="#">Log Out</a></li>
                </ul>
            </div>
        </div>
        <div class="headerBreak"></div>
    </div>
	<div class="homeBody">
	<h1>Welcome To Admin System</h1>
	<input OnClick="location.href='usersAdmin.php'" type="button" value="Users">
	<input OnClick="location.href='itemsAdmin.php'" type="button" value="Items">
	<input OnClick="location.href='orderAdmin.php'" type="button" value="Orders">

</body>
</html>