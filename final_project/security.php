<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$chpw = $_POST['chpw'];
		$chpw2 = $_POST['chpw2'];
        $id = $_SESSION['MEM_ID'];
		$sql = "SELECT * FROM `member` where MEM_ID = '$id'";
        $result = mysqli_query($con,$sql);
        $row = @mysqli_fetch_row($result);
		if( $chpw == $chpw2 && $chpw == $row[6])
		{
			echo "認證成功";
			echo '<meta http-equiv=REFRESH CONTENT=1;url=updata.php>';
		}
		else
		{
			echo '認證失敗! 請在確認您的密碼';
			echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
		}
	}
?>

<!DOCTYPE html>
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
		width: 100%;
		color: white;
		background-color: #ff8c00;
		border: none;
	}
    #backbutton{
        padding: 10px;
		width: 100pw;
		color: white;
		background-color: #666;
		border: none;
    }
	#box{
		background-color: grey;
		margin: auto;
		width: 400px;
		height: 300px;
		padding: 20px;
		border-radius: 8px;
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
    	background-color: grey;
    	border: none;
    	border-radius: 15px;
    	box-shadow: 0 5px #999;
  	}
  	.button:hover {background-color: #3e8e41}

  	.button:active {
    	background-color: #3e8e41;
    	box-shadow: 0 5px #666;
    	transform: translateY(4px);
  	}
</style>
<script src="https://kit.fontawesome.com/f11705a8f4.js" crossorigin="anonymous"></script>
<head>
	<title>Security</title>
</head>
<body>
	<div id="box">
        <button class="button" id= "backbutton" onclick="javascript:history.back();" value="返回到上一個頁面"><i class="fa fa-arrow-left" aria-hidden="true"></i> 回上一頁</button>
		<form method="post">
            
			<div style="font-size: 20px;margin: 10px;color: white;">確認用戶安全</div>
			<input id="text" type="password" name="chpw" autocomplete="off" placeholder="請輸入目前的密碼">
			<input id="text" type="password" name="chpw2" autocomplete="off" placeholder="確認密碼"><br><br>

			<input  class="button" id="button" type="submit" value="確定"><br><br>
		</form>
	</div>
</body>
</html>