

<?php
session_start();
$currentPath = dirname(__FILE__)."/";
include_once $curentPath.'config.php';

include_once $currentPath.'SR_Cookie.php';



// ini_set('display_startup_errors',1);
// ini_set('display_errors',1);
// error_reporting(-1);




	if((isset($_POST['email'])
	  	&& isset($_POST['password']))
		||
		(isset($_GET['email'])
		&& isset($_GET['password']))	
	){
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		// if(isset($_GET['email'])
		// && isset($_GET['password'])){
		// 	$email = $_GET['email'];
		// 	$password = $_GET['password'];
		// }
		$password = clearPasswrod($password);
		$email = clearEmail($email);
		
		// email exist check
		if(isEmailExist($email)){
			if(isPasswordMatch($email, $password)){
				addCookie($email);
			}else{
				// PASSWORD NOT MATCH
				echoErr("PASSWORD IS NOT MATCHING");
			}
		}else{
			echoErr("EMAIL IS NOT EXIST");
		}
			
	}else{
		echoErr("INPUT MISSING");
	}






	/**
	 * CHECK EMAIL EXISTENCE
	 * @param unknown $email
	 * @return boolean
	 */
	function isEmailExist($email){
		global $wqdb;
		global $dbTable_users;
		$query = "SELECT * FROM $dbTable_users";
		$result = $wqdb->query($query);
		while($row = $result->fetch_assoc()){
			if(strcmp($row['email'], $email) == 0){
				return TRUE;
			}
		}
		return FALSE;
	}
	
	
	/**
	 * check password match
	 * @param unknown $email
	 * @return boolean
	 */
	function isPasswordMatch($email, $password){
		global $wqdb;
		global $dbTable_users;
		$query = "SELECT * FROM $dbTable_users";
		$result = $wqdb->query($query);
		while($row = $result->fetch_assoc()){
			if(strcmp($row['email'], $email) == 0){
				if(strcmp($row['pwHash'], $password) == 0){
					return TRUE;
				}
				
			}
		}
		return FALSE;
	}
	
	
	function addCookie($email){
	global $USER_STATUS_USER;
		// $token = new SR_Cookie();
		// $token->errCode = 0;
		// echo json_encode($token);
		// setcookie("wqAuth", $email, time() + (86400 * 30), "/");
		// setcookie("wqAuth_isTemp", "N", time() + (86400 * 30), "/");
		$_SESSION['login_user']=$email;
		$_SESSION['loin_user_status'] = $USER_STATUS_USER;
		echoErr(0);
	}





// LIGAL CHECK
function clearPasswrod($value){


	$value = trim($value); //remove empty spaces
	$value = strip_tags($value); //remove html tags
	$value = htmlentities($value, ENT_QUOTES,'UTF-8'); //for major security transform some other chars into html corrispective...

	return $value;
}
function clearText($value){

	$value = trim($value); //remove empty spaces
	$value = strip_tags($value); //remove html tags
	$value = filter_var($value, FILTER_SANITIZE_MAGIC_QUOTES); //addslashes();
	$value = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW); //remove /t/n/g/s
	$value = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); //remove ¨¦ ¨¤ ¨° ¨¬ ` ecc...
	$value = htmlentities($value, ENT_QUOTES,'UTF-8'); //for major security transform some other chars into html corrispective...

	return $value;
}
function clearEmail($value){


	$value = trim($value); //remove empty spaces
	$value = strip_tags($value); //remove html tags
	$value = filter_var($value, FILTER_SANITIZE_EMAIL); //e-mail filter;
	if($value = filter_var($value, FILTER_VALIDATE_EMAIL))
	{
		$value = htmlentities($value, ENT_QUOTES,'UTF-8');//for major security transform some other chars into html corrispective...
	}else{$value = "BAD";}
	return $value;
}


function echoErr($err){
	$token = new SR_Cookie();
		$token->errCode = $err;
		echo json_encode($token);
		exit();

}







?>