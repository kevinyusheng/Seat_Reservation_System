<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
	#text{
		height: 50px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}
	#button{
		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: none;
	}
	#box{
		background-color: grey;
		margin: auto;
		width: 800px;
		height: 600px;
		padding: 20px;
		border-radius: 8px;
	}
	#box_profile{
		background-color: white;
		margin: auto;
		width: 300px;
		height:300px;
		padding: 20px;
	}
	.btn {
  		background-color: lightblue; 
  		border: none; 
  		color: white; 
		height: 23px;
  		padding: 12px 16px; 
  		font-size: 20px; 
  		cursor: pointer; 
	}
	.btn:hover {
  	background-color: RoyalBlue;
	}
	form.container{
		text-align: center;
	}

</style>
<style>
		.topnav {
    		background-color: #555;
   			overflow: hidden;
			border-radius: 8px;
  		}
  		/* Style the links inside the navigation bar */
  		.topnav a {
    		float: left;
    		color: #f2f2f2;
    		text-align: center;
    		padding: 14px 16px;
    		text-decoration: none;
    		font-size: 17px;
			border-bottom: 3px solid transparent;
			border-radius: 8px;
  		}
  
 		/* Change the color of links on hover */
  		.topnav a:hover {
    		background-color: #ddd;
    		color: black;
			border-bottom: 3px solid red;
 	 	}
  
  		/* Add a color to the active/current link */
  		.topnav a.active {
    		background-color: #ffc800;
    		color: white;
			border-bottom: 3px solid red;
 	 	}
		.topnav a.col{
            width:21%;
        }
</style>
<style>
		.flip-card {
 			 background-color: transparent;
  				width: 300px;
  				height: 200px;
  				border: 1px solid #f1f1f1;
  				perspective: 1000px; /* Remove this if you don't want the 3D effect */
				border-radius: 8px;
		}
	/* This container is needed to position the front and back side */
		.flip-card-inner {
  			position: relative;
  			width: 100%;
  			height: 100%;
  			text-align: center;
			transition: transform 0.8s;
  			transform-style: preserve-3d;
		}

	/* Do an horizontal flip when you move the mouse over the flip box container */
		.flip-card:hover .flip-card-inner {
  			transform: rotateY(180deg);
		}

	/* Position the front and back side */
		.flip-card-front, .flip-card-back {
  			position: absolute;
 			width: 100%;
  			height: 100%;
  			-webkit-backface-visibility: hidden; /* Safari */
  			backface-visibility: hidden;
		}

	/* Style the front side (fallback if image is missing) */
		.flip-card-front {
  			background-color: #bbb;
 			 color: black;
		}
	/* Style the back side */
		.flip-card-back {
  			background-color: #ff8c00;
  			color: white;
  			transform: rotateY(180deg);
		}

</style>
<style>
  	.button {
    	padding: 10px 20px;
    	font-size: 20px;
    	text-align: center;
    	cursor: pointer;
    	outline: none;
    	color: #fff;
    	background-color: #ff8c00;
    	border: none;
    	border-radius: 1px;
    	box-shadow: 0 5px #999;
  	}
  	.button:active {
    	background-color: #ffc800;
    	box-shadow: 0 5px #666;
    	transform: translateY(4px);
  	}
</style>
<head>
	<title>User</title>
</head>
<?php
$mem = $user_data['MEM_NUM'];
?>
<body>
	<div id="box">
		<div class="topnav">
  			<a class="col button" href="logout.php">登出</a>
  			<a class="col" href="security.php">更新用戶資料</a>
			<a class="col" href="book_ticket.php?mem=<?=$mem?>">訂票</a>
			<a class="col" href="order_member.php?mem=<?=$mem?>">訂票歷史紀錄</a>
		</div>
		<form class="container">
			<h2  style="margin: 10px;color: white;">您好 <?php echo $user_data['MEM_LNAME']; ?> <?php echo $user_data['MEM_FNAME'];?> 歡迎登入此系統</h2>
			<br>
			<div id ="box_profile" class="flip-card">
  				<div class="flip-card-inner">
   			 		<div class="flip-card-front">
      				<img src="img_avatar.png" alt="Avatar" style="width:300px;height:300px;">
    			</div>
    			<div class="flip-card-back">
      				<h1>User: <?php echo $user_data['MEM_LNAME']; ?> <?php echo $user_data['MEM_FNAME'];?></h1>
      				<p>ID: <?php echo $user_data['MEM_ID'];?></p>
      				<p>Email: <?php echo $user_data['MEM_EMAIL'];?></p>
					<p>Phone: <?php echo $user_data['MEM_PHONE'];?></p>
    			</div>
  				</div>
			</div>
		</form>
	<div>

	




</body>
</html>