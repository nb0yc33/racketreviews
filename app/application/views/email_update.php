<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Racket Reviews</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    p {
        text-transform: uppercase;
        color: black;
        font-size: 1.5em;
    }


	</style>

</head>
<body>

<div class="container">
	<div id="logo">
		<h1>Racket Reviews</h1>
	</div>

    <p> Your email has been updated successfully! </p>

	<form action="<?=site_url('home/profile');?>" method="post"> 
		<div class="submit-container">
			<input type="submit" name="submit" class="button" value= "RETURN">
		</div>
	</form>


</div>

</body>
</html>