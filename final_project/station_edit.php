<?php session_start(); ?>
<meta http-equiv="Content_Type" content="text/html;charset=utf-8" />
<?php
include("connection.php");
    
if($_SESSION['MNA_ID'] != null) {
    $station_num = $_POST["station_num"];
    $sql = "SELECT * FROM STATION WHERE STATION_NUM = '$station_num'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>
<html>
<script src="https://kit.fontawesome.com/f11705a8f4.js" crossorigin="anonymous"></script>
<style type="text/css">
	
	#text{

		height: 45px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 200px;
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
		width: 600px;
		padding: 20px;
        border-radius: 8px;
	}
    div.container {
        text-align: center;
    }
    form.container{
        text-align: center;
    }
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        border-radius: 50px; /* 5px rounded corners */
        background: white;
        height:355px;
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
    border-radius: 15px;
    box-shadow: 0 5px #999;
  }
  .button:active {
    background-color: #ffc800;
    box-shadow: 0 5px #666;
    transform: translateY(4px);
  }
</style>
    <head>
        <title>station edit</title>
    </head>
<body>
    <div id="box">
        <div class="card">
            <div class="container">
                <br>
                <h1>編輯 <?php echo $row["STATION_NAME"];?>站 資訊</h1><br><br>
            </div>
            <form class="container"name="form" method="post" action="station_edit_finish.php">
                車站名稱：<input id="text" type="text" name="new_name" value="<?php echo $row["STATION_NAME"];?>" /><br><br><br>
                車站地址：<input id="text" type="text" name="new_address" value="<?php echo $row["STATION_ADDRESS"];?>" /><br><br>
                <input type="hidden" name="station_num" value="<?php echo $station_num;?>">
                <!-- <input type="submit" name="submit" value="完成" /> &nbsp;&nbsp;&nbsp; -->
                <button class="button" type="submit"><i class="fa-solid fa-circle-check"></i> 完成</button>
                <button class="button" type="button" onclick="location.href='station.php'"><i class="fa-solid fa-xmark"></i> 取消</button>
            </form>
        </div>
    </div>

</body>
</html>