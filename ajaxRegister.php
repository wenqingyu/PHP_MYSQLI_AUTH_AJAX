<?php



// error_reporting(-1);
// ini_set('display_errors', 'On');


$currentPath = dirname(__FILE__)."/";
include_once 'config.php';

include_once 'SR_Cookie.php';
	/*
	 * Signup Data (Permanent User):
	 * firstName
	 * lastName
	 * email
	 * password
	 */

session_start();

	if((isset($_POST['firstName'])
		&& isset($_POST['lastName'])
		&& isset($_POST['email'])
		&& isset($_POST['password']))
		// GET TEST
		||
		(isset($_GET['firstName'])
		&& isset($_GET['lastName'])
		&& isset($_GET['email'])
		&& isset($_GET['password']))
){
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		// TEST GET
		// if(isset($_GET['firstName']) && isset($_GET['password'])){
		// 	$firstName = $_GET['firstName'];
		// 	$lastName = $_GET['lastName'];
		// 	$email = $_GET['email'];
		// 	$password = $_GET['password'];
		// }
		
		// LETTER AND NUMBER ONLY
		if (preg_match('/^[\w]+$/', $firstName)
			&& preg_match('/^[\w]+$/', $lastName)
			&& preg_match('/^[\w]+$/', $password)
			&& filter_var($email, FILTER_VALIDATE_EMAIL)
			)
		{
// 			echo "FORMAT PASS!";
			// CHECK THE EXISTENCE OF EMAIL
			if(!isEmailExist($email)){
				addUser($firstName, $lastName, $email, $password);
				addCookie($email);
				// INITIALIZE CATEGORY SCORE
				
				// INITIALIZE CONTAINER (GENERATE NEW ARTICLE)
			}else{
				echoErr("EMAIL ALREAY EXIST!");
			}
			
		}else{
			// "INPUT ILLEGAL!";
			if(!preg_match('/^[\w]+$/', $firstName)){
				echoErr("FirstName: Only accept letters and numbers");
			}

			if(!preg_match('/^[\w]+$/', $lastName)){
				echoErr("LastName: Only accept letters and numbers");
			}

			if(!preg_match('/^[\w]+$/', $password) ){
				echoErr("Password: Only accept letters and numbers");
			}

			if(!filter_var($email, FILTER_VALIDATE_EMAIL) ){
				echoErr("Email is not correct format");
			}

		}
		
	}else{
		// NOT ENOUGH DATA FOR REGISTER
		echoErr("SOME INPUT MISSING!");
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
 			// EMAIL ALREADY EXIST
 				$token = new SR_Cookie();
				$token->errCode = "EMAIL ALREADY EXIST";
				echo json_encode($token);
				exit();
 			return TRUE;
 		}
 	}
 	return FALSE;
 }
	
 
 
 /*
 * Signup Data (Permanent User):
 * firstName
 * lastName
 * email
 * password
 */
 function addUser($firstName, $lastName, $email, $pwHash){
 		global $wqdb;
 		global $dbTable_users;
 		
 		// Chinese
 		$wqdb->query("set character set 'utf8'");
 		$wqdb->query("set names 'utf8'");
 		
 		$email = $wqdb->real_escape_string($email);
 		
 		$query = "INSERT INTO $dbTable_users (firstName, lastName, email, pwHash)
 		VALUES ('$firstName', '$lastName', '$email', '$pwHash')";
 		$result = $wqdb->query($query);
 		if (!$result) {
 		die('Invalid query: ');
 		}else{

		}
 }
 

function addCookie($email){
	global $USER_STATUS_USER;
	// $token = new SR_Cookie();
	// $token->errCode = 0;
	// echo json_encode($token);
	// setcookie("wqAuth", $email, time() + (86400 * 30), "/");
	// setcookie("wqAuth_isTemp", "N", time() + (86400 * 30), "/");
	$_SESSION['login_user']=$email;
	$_SESSION['login_user_status'] = $USER_STATUS_USER;
	echoErr(0);

}


function echoErr($err){
	$token = new SR_Cookie();
		$token->errCode = $err;
		echo json_encode($token);
		exit();

}
	
	
	

?>




