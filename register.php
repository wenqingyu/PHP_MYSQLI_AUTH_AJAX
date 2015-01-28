<?php
session_start();
// if(!empty($_SESSION['login_user']))
// {
// header('Location: home.php');
// }
?>
<!doctype html>
<html lang="en">
<head>
	<meta name = "viewport" content = "user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width">
<meta charset="UTF-8" />
<!-- <meta name="viewport" content="width=device-width, initial-scale=1" /> -->

<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.shake.js"></script>
<title>Register</title>
<link rel="stylesheet" href="css/style.css"/>
	<script>
			$(document).ready(function() {
			
			$('#register').click(function()
			{
			var firstName=$("#firstName").val();
			var lastName=$("#lastName").val();
			var email=$("#email").val();
			var password=$("#password").val();
		    var dataString = 'firstName='+firstName+'&lastName='+lastName+'&password='+password+'&email='+email;
			if($.trim(firstName).length>0 && $.trim(lastName).length>0 && $.trim(password).length>0 && $.trim(email).length>0)
			{
			
 
			$.ajax({
            type: "POST",
            url: "ajaxRegister.php",
            data: dataString,
            cache: false,
            beforeSend: function(){ $("#register").val('Connecting...');},
            success: function(data){
            if(data)
            {
            	var json = JSON.parse(data);
            	if(json.errCode != 0){
            		  $('#box').shake();
				 $("#register").val('Register')
				 var err = "<span style='color:#cc0000'>Error: </span>" + json.errCode;
				 $("#error").html(err);

            	}else{
            		$("body").load("home.php").hide().fadeIn(1500).delay(6000);
            	}
            }
            else
            {
             $('#box').shake();
			 $("#register").val('Register')
			 $("#error").html("<span style='color:#cc0000'>Error:</span>NO RESPONSE");
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
<h1>Register</h1>

<div id="box">
<form action="" method="post">
<label>FirstName</label> 
<input type="text" name="firstName" class="input" autocomplete="off" id="firstName"/>
<label>LastName</label> 
<input type="text" name="lastName" class="input" autocomplete="off" id="lastName"/>
<label>Email</label> 
<input type="text" name="email" class="input" autocomplete="off" id="email"/>
<label>Password </label>
<input type="password" name="password" class="input" autocomplete="off" id="password"/><br/>
<input type="submit" class="button button-primary" value="Register" id="register"/> 
<span class='msg'></span> 

<div id="error">

</div>	

</div>
</form>	
</div>

</div>
</body>
</html>