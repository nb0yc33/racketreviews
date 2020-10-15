<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Racket Reviews</title>

    <link href="https://fonts.googleapis.com/css?family=Dosis&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: green;
		font-family: 'Dosis', sans-serif;
		color: white;
		font-size: 14px;
	}

	h1 {
		font-size: 5em;
        padding-bottom: 0.2em;
        padding-top: 0.2em;
	}

	.container {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}
	
    .navbar {
	    background-color: yellow;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    } 

    a {
        color: black;
        font-size: 1.1em;
    }

	form {
		width: 30%;

	}

	form input[type=text] {
  		padding: 3%;
  		border: 1px solid black;
  		width: 75%;
  		float: left;
  		color: black;
	}

	form button {
  		width: 25%;
  		padding: 3%;
  		background: yellow;
  		color: black;
  		border: 1px solid black;
  		border-left: none; 
  		cursor: pointer;
	}

	form button:hover {
  		color: white;
	}

    .active {
        background: yellow;
        color: black;
    }

    #upload-details {
        padding: 2%;
        width: 100%;
        display: flex; 
        justify-content: center; 
    }

    #update-button {
        background-color: yellow;
    }

    #update-button:hover {
    	color: black;
    }

    #upload {
        font-family: 'Dosis', sans-serif;
    }

    label {
        float: left;
    }

    .upload-form {
        height: 1em;
    }
    
    .username {
		color: white;
		font-size: 1.2em;
		text-transform: uppercase;
	}

	h1 {
		color: white;
	}

	h1:hover {
		color: yellow;
	}

	</style>

</head>
<body>

<div class="container">
	<div id="logo">
		<h1>Racket Reviews</h1>
	</div>

    <nav class="navbar">
        <ul class="nav navbar-nav">
			<li> <a href="<?=site_url('home/profile');?>" class="username"> <?php echo $username = $this->session->userdata('username'); ?></a> </li>
            <li><a href="<?=site_url('home/upload');?>">UPLOAD</a></li>
            <li><a href="<?=site_url('home/notifications');?>">NOTIFICATIONS <i class="fa fa-bell" style="color:#918EF4; font-size:1.1em"> </i></a></li>
        </ul>
		<form action="search.php">
  			<input type="text" placeholder="SEARCH..." style="text-transform:uppercase;" name="search">
 			<button type="submit"><i class="fa fa-search"></i></button>
		</form> 
    </nav>

    <p> Your upload was unsuccessful </p>

	<form action="<?=site_url('home/dashboard');?>" method="post"> 
		<div class="submit-container">
			<input type="submit" name="submit" class="button" value= "RETURN">
		</div>
	</form>

</div>
</body>
</html>
