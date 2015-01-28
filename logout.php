<?php
session_start();
if(!empty($_SESSION['login_user']))
{
$_SESSION['login_user']='';
$_SESSION['login_user_status'] = '';
session_unset();
}

header("Location:login.php");
?>
