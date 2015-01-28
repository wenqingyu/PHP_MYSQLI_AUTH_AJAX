<?php 
// DB CONNECTION
$host = '';
$user = '';
$pass = '';
$dbname = '';

$db_pre = "sr_";
$dbTable_users = $db_pre."users";
$dbTable_deal = $db_pre."deals";
$dbTable_rest_users = $db_pre."rest_users";

$wqdb = new mysqli($host, $user, $pass, $dbname);
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

// utf-8 Uncomment this part for support Chinese version
// $wqdb->query("set names 'utf8' ");
// $wqdb->query("set character_set_client=utf8");
// $wqdb->query("set character_set_results=utf8");

$USER_STATUS_REST = "REST_OWNER";
$USER_STATUS_USER = "USER";




?>