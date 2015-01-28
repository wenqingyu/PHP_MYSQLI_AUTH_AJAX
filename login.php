<?php
session_start();
if(!empty($_SESSION['login_user']))
{
	session_unset();
// header('Location: home.php');
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta name = "viewport" content = "user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">

<link rel="stylesheet" href="css/style.css"/>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.shake.js"></script>
<meta charset="UTF-8" />
<title>Login</title>
	<script>
			$(document).ready(function() {
			
			$('#login').click(function()
			{
			var email=$("#email").val();
			var password=$("#password").val();
		    var dataString = 'email='+email+'&password='+password;
			if($.trim(email).length>0 && $.trim(password).length>0)
			{
			
 
			$.ajax({
            type: "POST",
            url: "ajaxLogin.php",
            data: dataString,
            cache: false,
            beforeSend: function(){ $("#login").val('Connecting...');},
            success: function(data){
            if(data)
            {
            	var json = JSON.parse(data);
            	if(json.errCode != 0){
            		  $('#box').shake();
				 $("#login").val('Login')
				 var err = "<span style='color:#cc0000'>Error: </span>" + json.errCode;
				 $("#error").html(err);

            	}else{
            		$("body").load("home.php").hide().fadeIn(1500).delay(6000);
            	}
            }
            else
            {
             $('#box').shake();
			 $("#login").val('Login')
			 $("#error").html("<span style='color:#cc0000'>Error:</span> Invalid username and password. ");
            }
            }
            });
			
			}
			return false;
			});
			
				
			});
		</script>
</head>

<body>
<div id="main">
<h1>Login</h1>

<div id="box">
<form action="" method="post">
<label>Email</label> 
<input type="text" name="email" class="input" autocomplete="off" id="email"/>
<label>Password </label>
<input type="password" name="password" class="input" autocomplete="off" id="password"/><br/>
<input type="submit" class="button button-primary" value="Log In" id="login"/><br>
<a href="register.php">Register</a>
<span class='msg'></span> 

<div id="error">

</div>	

</div>
</form>	
</div>

</div>
</body>
</html>