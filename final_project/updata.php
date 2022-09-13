<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<?php 
session_start();

	include("connection.php");
	include("functions.php");
	$id = $_SESSION["MEM_ID"];
	$query = "select * from `member` where MEM_ID = '$id'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($result);


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$upLname = $_POST['upLname'];
		$upFname = $_POST['upFname'];
		$uppw = $_POST['uppw'];;
		$uppw2 = $_POST['uppw2'];
		$upemail = $_POST['upemail'];
		$upphone = $_POST['upphone'];
        $user_id = $_SESSION['MEM_ID'];

		if( $user_id != null)
		{
			$query = "UPDATE `member` SET MEM_LNAME = '$upLname', MEM_FNAME = '$upFname', MEM_PASSWORD = '$uppw', MEM_EMAIL = '$upemail', MEM_PHONE = '$upphone' WHERE MEM_ID = '$user_id'";

			if(mysqli_query($con, $query))
			{
				echo '更新成功!';
				echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
			}
			else
			{
				echo '更新失敗!';
				echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
			}
		}
		else
		{
			echo '您無權限觀看此頁面!';
			echo "Please enter some valid information!";
			echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
		}
	}
?>

<!DOCTYPE html>
<html>
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
			width: 500px;
			height: 600px;
			padding: 20px;
			border-radius: 8px;
		}
</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<head>
	<title>更新資料</title>
</head>
<body>



	<div id="box">
        <button class="button" id="backbutton" onclick="javascript:history.back();" value="返回到上一個頁面"><i class="fa fa-arrow-left" aria-hidden="true"></i> 回上一頁</button>
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">更新會員資料</div>
			<input id="text" type="text" name="upLname" placeholder = "姓氏" value = "<?php echo $row['MEM_LNAME'];?>">
			<input id="text" type="text" name="upFname" placeholder = "名字" value = "<?php echo $row['MEM_FNAME'];?>"><br><br>
			<input id="text" type="email" name="upemail"  placeholder = "name@example.com" value = "<?php echo $row['MEM_EMAIL'];?>"><br><br>
			<input id="text" type="text" name="upphone" placeholder="電話號碼" value = "<?php echo $row['MEM_PHONE'];?>"><br><br>
			<input id="text" type="password" name="uppw" autocomplete="off" placeholder="密碼" value = "<?php echo $row['MEM_PASSWORD'];?>">
			<input id="text" type="password" name="uppw2" autocomplete="off" placeholder="確認密碼" value = "<?php echo $row['MEM_PASSWORD'];?>">	<br><br>

			<input class="button" id="button" type="submit" value="確定更新"><br><br>
		</form>
	</div>
</body>
</html>