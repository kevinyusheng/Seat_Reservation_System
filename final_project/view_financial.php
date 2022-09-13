<?php session_start(); ?>
<meta http-equiv="Content_Type" content="text/html;charset=utf-8" />
<?php
include("connection.php");

if($_SESSION['MNA_ID'] != null) {
    $sql = "SELECT SUM(TICKET_PRICE*IDENTITY_MULTIPLE) FROM TICKET NATURAL JOIN IDENTITY";
    $sql2 = "SELECT SUM(TICKET_PRICE*IDENTITY_MULTIPLE) FROM TICKET NATURAL JOIN IDENTITY NATURAL JOIN TRAIN GROUP BY MONTH(TRAIN_DATE)";
    $result = mysqli_query($con, $sql);
    $result_month = mysqli_query($con, $sql2);
    $total = mysqli_fetch_row($result)[0];
    $month = 1;
}
?>
<html>
<script src="https://kit.fontawesome.com/f11705a8f4.js" crossorigin="anonymous"></script>
<style type="text/css">
	#text{

		height: 50px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}
	#button{
        position: fixed;
        bottom: 200px;
		padding: 10px;
		width: 500px;
		color: white;
		background-color: #ff8c00;
		border: none;
        border-radius: 50px;
	}
	#box{
		background-color: grey;
		margin: auto;
		width: 500px;
		height: 500px;
		padding: 20px;
        border-radius: 8px;
	}
</style>
<style>
    div.container {
        text-align: center;
    }
    ul.myUL {
        display: inline-block;
        text-align: left;
    }
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        border-radius: 50px; /* 5px rounded corners */
        background: white;
        height:350px;
    }
    .center {
        margin-left: auto;
        margin-right: auto;
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
    	border-radius: 0px;
    	box-shadow: 0 5px #999;
  	}
  	.button:active {
    	background-color: #ffc800;
    	box-shadow: 0 5px #666;
    	transform: translateY(4px);
  	}
</style>
    <head>
        <title>financial</title>
    </head>
<body>
    <div id = "box">
        <div class = "card">
        <div class="container">
            <br>
            <h1>財務總覽</h1>
            <ul class="myUL">
                <li><h2>總營收: <?php echo "$$total"; ?></h2></li>
            </ul>
        </div>
        </div>
        <button class="button" id="button" type="button" onclick="location.href='manager.php'"><i class="fa-solid fa-arrow-left-long"></i> 回上一頁</button>
    </div>
</body>
</html>