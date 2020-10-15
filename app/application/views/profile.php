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
        justify-content: space-around; 
		background-color: yellow;
		margin-bottom: 3%;
		color: black;
    }

    #update-button {
        background-color: yellow;
    }

    #update-button:hover {
        color: white;
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
    
    
    a:hover {
        text-decoration:none;
    }

    .active {
        background: yellow;
        color: #141B41;
		font-size: 1.2em;
		text-transform: uppercase;
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

	.rr {
		color: white;
	}

	.rr:hover {
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
			<li> <a href="<?=site_url('home/profile');?>" class="active"><?php echo $username = $this->session->userdata('username'); ?></a> </li>
            <li><a href="<?=site_url('home/upload');?>">UPLOAD</a></li>
			<li><a href="<?=site_url('home/search');?>">SEARCH</a></li>        
		</ul>
    </nav>


    <section id="upload-details">
	    <form action="<?=site_url('users/update_email');?>" method="post"> 
            <label for="myprofile">MY_PROFILE: &nbsp;</label>
            <br> <br>
            <div id='username-line'>
				<label for="username">USERNAME &nbsp;</label>
                <p name="username"> <?php echo $username = $this->session->userdata('username'); ?> <br> <br>
            </div>
            <div id="email-line">
                <label for="currentemail">EMAIL &nbsp;</label>
                <p name="currentemail"> <?php echo $email = $this->session->userdata('email'); ?> <br> <br>                              
            </div>
            <div id="verification-line">
                <label for="verificationstatus">VERIFICATION_STATUS &nbsp;</label>
                <p name="verificationstatus"> <?php echo $status = $this->User_model->echo_verification_status(); ?><br> <br>                              
            </div>
            <br> <br>
            <label for="username">USERNAME &nbsp;</label>
                <input type="text" class="upload-form" name="username"/><br> <br> <br>
            <label for="email">NEW_EMAIL &nbsp;</label>
                <input type="text" class="upload-form" name="email"/><br> <br> 
            <input type="submit" name="submit" class="button" value="UPDATE_EMAIL"/>
            <input type="submit" name="submit" class="button" value="LOG_OUT"/>
        </form>
        <form action="<?=site_url('users/verify_account');?>" method="post">
			    <label for="verifycode">VERIFY_ACCOUNT</label> <br>
			    <input type="text" class="upload-form" name="verifycode"/><br/>
			    <br>
			<input type="submit" name="submit" class="button" value="VERIFY_ACCOUNT"> 
		</form>
    </section>  

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