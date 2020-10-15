<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Racket Reviews</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
		color: lightgreen;
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
		padding-right: 10px;
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
		<form action="<?=site_url('users/login');?>" method="post">

			<label for="username">USERNAME</label>
			<input type="text" size="30" name="username" value="<?php if (get_cookie('username')) { echo get_cookie('username'); } ?>"/><br/>
	
			<label for="email">EMAIL</label>
			<input type="text" size="30" name="email" value="<?php if (get_cookie('email')) { echo get_cookie('email'); } ?>"/><br/>
	
			<label for="password">PASSWORD</label>
			<input type="password" size="30" name="password" value="<?php if (get_cookie('password')) { echo get_cookie('password'); } ?>"/><br/>

			<input type="checkbox" id="cookiecheck" name="cookiecheck" value="Remember">
			<label for="cookiecheck" <?php if (get_cookie('username')) { ?> checked="checked" <?php } ?>>REMEMBER_ME</label><br>
		
	<div class="submit-container">
			<input type="submit" name="submit" class="button" value="LOG_IN"/>
		</form>
			<form action="<?=site_url('users/create_account');?>" method="post">
				<input type="submit" name="submit" class="button" value="CREATE_ACCOUNT"/>
			</form>
			<br> <br>
			<form action="<?=site_url('users/forgot_password');?>" method="post">
				<input type="submit" name="submit" class="button" value="FORGOT_YOUR_PASSWORD?"/>
			</form>
	</div>
	
	
	
</div>

</body>
</html>