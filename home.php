<?php
session_start();
if(empty($_SESSION['login_user']))
{
header('Location: login.php');
}

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Home - Login Box Shake Effect</title>
<link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<div id="main">
<h1>Welcome to Home Page</h1>
<a href="login.php">Logout</a>
</div>
</body>
</html>