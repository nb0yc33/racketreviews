<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Racket Reviews</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Dosis&display=swap" rel="stylesheet">
	<style type="text/css">



	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body, * {
		background-color: green;
		font-family: 'Dosis', sans-serif;
		color: white;
		font-size: 14px;
	}

	#logo {
		padding-top: 5%;
		padding-bottom: 50px;
	}

	h1 {
		font-size: 5em;
	}

	.button:hover {
		color: white;
	}

	.container {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}
	
	.button {
		background-color: yellow;
		color: black;
		border: none;
		padding: 0.4em;
		margin: 0 auto;
		display: block;
		margin: 10px 10px 10px 10px;
		font-size: 1.2em;
	}

	.submit-container {
		display: flex;
		flex-direction: column;
	}

	.checkbox-container {
		display: inline-block;
	}

	#loginform {
		display: flex;
		flex-direction: column;
		align-items: center;
	}

	label {
  		display: inline-block;
  		width: 80px;
	}​

	</style>



</head>
<body>

<div class="container">
	<div id="logo">
		<h1>Racket Reviews</h1>
	</div>


	<?php echo validation_errors(); ?>
	<br> <br>
		<form action="<?=site_url('users/submit_account');?>" method="post">

			<label for="username">USERNAME</label>
			<input type="text" size="30" name="username"/><br/>
	
			<label for="email">EMAIL</label>
			<input type="email" size="30" name="email"/><br/>
			
	
			<label for="password">PASSWORD</label>
			<input type="password" size="30" name="new_password" value="<?php echo set_value('new_password'); ?>"/><br/>
            <br> <br>
			<label for="q1">WHAT'S_YOUR_MOTHER'S_MAIDEN_NAME?</label> <br>
			<input type="text" size="30" name="q1"/><br/>
            <br>
			<label for="q2">WHAT_WAS_THE_FIRST_SCHOOL_YOU_ATTENDED?</label> <br>
			<input type="text" size="30" name="q2"/><br/>
            <br>
			<label for="q3">WHAT_WAS_THE_FIRST_CAR_YOU_DROVE?</label> <br>
			<input type="text" size="30" name="q3"/><br/><br/><br/>
			<div class="g-recaptcha" data-sitekey="6LcCSv0UAAAAAEPRC63LqiUagxjxIO9U8hNoIv3t"></div>	
			<span id="captcha_error" class="text-danger"></span>
	<div class="submit-container">
            <br>
			<input type="submit" name="submit" class="button" value="CREATE_ACCOUNT"/>
		</form> <br>
        <form action="<?=site_url('home/login_page');?>" method="post"> 
		    <input type="submit" name="submit" class="button" value="RETURN">
	    </form>	
	</div>

	
	
</div>

</body>
</html>