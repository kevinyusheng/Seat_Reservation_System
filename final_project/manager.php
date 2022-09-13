<?php session_start(); ?>
<meta http-equiv="Content_Type" content="text/html;charset=utf-8" />
<?php
include("connection.php");
include("functions.php");
$mna_data = get_managerdata($con);
?>
<html>
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
		width: 700px;
		height: 500px;
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
    		background-color: #ff8c00;
    		color: white;
			border-bottom: 3px solid red;
 	 	}
		.topnav a.col{
            width:15.4%;
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
        <title>manager</title>
    </head>
    <body>
        <div id = "box" >
            <div class="topnav">
  		        <a class=" col button" href="logout.php">登出</a>
  		        <a class=" col" href="view_order.php">查看訂單明細</a>
  		        <a class=" col" href="view_financial.php">財務總覽</a>
                <a class=" col" href="station.php">編輯車站資訊</a>
                <a class=" col" href="train.php">編輯列車資訊</a>
	        </div>
			<form class="container">
			<h2  style=" margin: 10px;color: white;">您好 <?php echo $mna_data['MNA_LNAME']; ?> <?php echo $mna_data['MNA_FNAME'];?> 歡迎登入此系統</h2>
            	<div id ="box_profile" class="flip-card">
  					<div class="flip-card-inner">
   			 			<div class="flip-card-front">
      						<img src="img_avatar.png" alt="Avatar" style="width:300px;height:300px;">
    					</div>
    					<div class="flip-card-back">
      						<h1>User: <?php echo $mna_data['MNA_LNAME']; ?> <?php echo $mna_data['MNA_FNAME'];?></h1>
      						<p>ID: <?php echo $mna_data['MNA_ID'];?></p>
      						<p>Email: <?php echo $mna_data['MNA_EMAIL'];?></p>
							<p>Phone: <?php echo $mna_data['MNA_PHONE'];?></p>
    					</div>
  					</div>
				</div>
			</form>
        </div>
    </body>
</html>