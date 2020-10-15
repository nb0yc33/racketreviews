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
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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

	.rr {
		color: white;
	}

	.rr:hover {
		color: yellow;
	}

	form {
		width: 30%;
	}

	form input[type=text] {
  		padding: 3%;
  		border: 1px solid black;
  		width: 75%;
  		float:left;
  		color: black;
	}

	form button {
  		width: 25%;
  		padding: 3%;
  		background: yellow;
  		color: #98B9F2;
  		border: 1px solid black;
  		border-left: none; 
  		cursor: pointer;
	}

	form button:hover {
  		color: white;
	}

	.username {
		color: black;
		font-size: 1.2em;
		text-transform: uppercase;
	}

	a:hover {
        text-decoration:none;
    }


	</style>



<script>
		$(function(){
			
			function timeChecker(){
				setInterval(function(){
					//compare every 3 secs
					var storedTimeStamp = sessionStorage.getItem("lastTimeStamp");
					timeCompare(storedTimeStamp);
				},3000);
			}

			function timeCompare(timeString){
				var currentTime = new Date();
				var pastTime = new Date(timeString);
				var timeDiff = currentTime - pastTime;
				//no. of minutes past is rounded to the closest minute
				var minPast = Math.floor((timeDiff/60000));

				//if cursor hasn't moved in 16 minutes then user is forcefully logged out
				if(minPast > 15){
					sessionStorage.removeItem("lastTimeStamp");
					window.location = "./force_logout";
				} 

			}

			//moving the mouse makes timeStamp the new time so the counter goes back to start
			$(document).mousemove(function(){
				var timeStamp = new Date();
				sessionStorage.setItem("lastTimeStamp", timeStamp);
			
			});

			timeChecker();
		});

		//this function listens for loading of DOM content
		document.addEventListener('DOMContentLoaded', function() {
		
		//separator is unicode for 'private use, first'
		var separator = '\uE000';  

		//this function e listens for 'pagehide'
		window.addEventListener('pagehide', function(e) {
			//add separator, pageXOffset, separator and pageYOffset to the name of the window
			window.name += separator + window.pageXOffset + separator + window.pageYOffset;
		});
		//if the name of the window and the index of separator in the name of window are greater than -1
		if(window.name && window.name.indexOf(separator) > -1){
			//parts becomes the name of window split by separator
			var parts = window.name.split(separator);
			if(parts.length >= 3){
				window.name = parts[0];
				//window parses and scrolls to floating point of the index of parts' length - 2 for x and y axes
				window.scrollTo(parseFloat(parts[parts.length - 2]), parseFloat(parts[parts.length - 1]));
			}
		}
	});

	$(document).ready(function(){

		var limit = 5;
		var start = 0;
		var action = 'inactive';

		function video_loader(limit){
  			var output = '';
  			for(var count=0; count<limit; count++){
				output += '<div class="post_data">';
        		output += '</div>';
  			}
  			$('#load_data_message').html(output);
		}

		video_loader(limit);

		function load_data(limit, start){
  			$.ajax({
				url:"<?php echo base_url(); ?>scroll_pagination/fetch",
				method:"POST",
				data:{limit:limit, start:start},
				cache: false,
				success:function(data){
	  				if(data == ''){
						$('#load_data_message').html('<h3>There are no more videos!</h3>');
						action = 'active';
	  				} else {
						$('#load_data').append(data);
						$('#load_data_message').html("");
						action = 'inactive';
	  				}
				}
  			})
		}

		if(action == 'inactive'){
			action = 'active';
			load_data(limit, start);
		}

		$(window).scroll(function(){
  			if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive'){
				video_loader(limit);
				action = 'active';
				start = start + limit;
				setTimeout(function(){
	  				load_data(limit, start);
				}, 1000);
  			}
		});

	});

</script>


</script>


</head>
<body>

<div class="container">
	<div id="logo">
		<h1><a href="<?=site_url('home/dashboard');?>" class="rr">Racket Reviews</a></h1>
	</div>

    <nav class="navbar">
        <ul class="nav navbar-nav">
			<li> <a href="<?=site_url('home/profile');?>" class="username"> <?php echo $username = $this->session->userdata('username'); ?></a> </li>
			<li><a href="<?=site_url('home/upload');?>">UPLOAD</a></li>
			<li><a href="<?=site_url('home/search');?>">SEARCH</a></li>
        </ul>
    </nav>
</div>
<br>
		<div class="container">
            <div id="load_data"></div>
            <div id="load_data_message"></div>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
        </div>

</body>

</html>

