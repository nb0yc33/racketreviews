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

	label {
		color: black;
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
  		color: #98B9F2;
  		border: 1px solid yellow;
  		border-left: none; 
  		cursor: pointer;
	}

	form button:hover {
  		color: lightgreen;
	}

    .active {
        background: yellow;
        color: white;
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
        color: lightgreen;
    }

    #upload {
        font-family: 'Dosis', sans-serif;
    }

	label {
  		display: inline-block;
	}​

    .upload-form {
        height: 1em;
    }

    .username {
		color: white;
		font-size: 1.2em;
		text-transform: uppercase;
	}

    a:hover {
        text-decoration:none;
    }
    
    .active {
        background: yellow;
        color: black;
    }

	.username {
		color: black;
	}

	.button {
		background-color: black;
		color: white;
		border: none;
		padding: 0.4em;
		margin: 0 auto;
		display: block;
		margin: 10px 10px 10px 10px;
		font-size: 1.2em;
	}

	#uploadform {
		padding-left: 1em;
		padding-top: 1em;
		padding-bottom: 1em;
		background-color: yellow;
		margin-bottom: 3%;
	}

	.rr {
		color: white;
	}

	.rr:hover{
		color: yellow;
	}

	</style>

</head>
<body>

<div class="container">
	<div id="logo">
		<h1><a href="<?=site_url('home/dashboard');?>" class="rr">Racket Reviews</a></h1>
	</div>

    <nav class="navbar">
        <ul class="nav navbar-nav">
            <li> <a href="<?=site_url('home/profile');?>" class="username"> <?php echo $username = $this->session->userdata('username'); ?></a> </li>
            <li><a href="<?=site_url('home/upload'); ?>" class="active">UPLOAD</a></li>
			<li><a href="<?=site_url('home/search');?>">SEARCH</a></li>        
		</ul>
    </nav>

    <div id="uploadform">
    <?php echo form_open_multipart('upload_controller/do_upload');?>
        <label for="title">VIDEO_TITLE: &nbsp;</label>
        <input type="text" style="width: 450px;" height="1em" name="title"/><br/>
        <br>
        <label for="tag">VIDEO_TAG: &nbsp;</label>
        <input type="text" style="width: 450px;" height="1em" name="tag"/><br/>
        <br>
        <label for="desc">VIDEO_DESCRIPTION: &nbsp;</label>
        <input type="text" style="width: 450px;" height="1em" name="desc"/><br/>
        <br> <br> <br>
        <label for="userfile">UPLOAD_VIDEO: &nbsp;</label>
        <br>
        <?php echo "<input type='file' name='userfile' size='20' />"; ?>
        <br>
        <input type="submit" name="submit" class="button" value="UPLOAD_VIDEO"/>

    </div> 
</div>

<script>
		$(function(){
			
			function timeChecker(){
				setInterval(function(){
					var storedTimeStamp = sessionStorage.getItem("lastTimeStamp");
					timeCompare(storedTimeStamp);
				},3000);
			}

			function timeCompare(timeString){
				var currentTime = new Date();
				var pastTime = new Date(timeString);
				var timeDiff = currentTime - pastTime;
				var minPast = Math.floor((timeDiff/60000));


				if(minPast > 15){
					sessionStorage.removeItem("lastTimeStamp");
					window.location = "./force_logout";
				} else {

				}

			}

			$(document).mousemove(function(){
				var timeStamp = new Date();
				sessionStorage.setItem("lastTimeStamp", timeStamp);
			
			});

			timeChecker();
		});

</script>
</body>
</html>

