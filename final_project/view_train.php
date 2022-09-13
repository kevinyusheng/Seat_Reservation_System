<?php session_start(); ?>
<meta http-equiv="Content_Type" content="text/html;charset=utf-8" />
<?php
include("connection.php");

$num = $_GET['num'];
if ($_SESSION['MNA_ID'] != null) {
    // $sql = "SELECT STATION_NAME, STOP_TIME FROM STOP NATURAL JOIN STATION WHERE TRAIN_NUM = '$num' ORDER BY STATION_NUM";
    // $result = mysqli_query($con, $sql);
     $sql = "SELECT TRAIN_DIR FROM TRAIN WHERE TRAIN_NUM = '$num'";
     $result_dir = mysqli_query($con, $sql);
     $dir = mysqli_fetch_row($result_dir)[0];
     if ($dir == 1) {
         $sql2 = "SELECT STATION_NAME, STOP_TIME FROM STOP NATURAL JOIN STATION WHERE TRAIN_NUM = '$num' ORDER BY STATION_NUM";
     } else {
         $sql2 = "SELECT STATION_NAME, STOP_TIME FROM STOP NATURAL JOIN STATION WHERE TRAIN_NUM = '$num' ORDER BY STATION_NUM DESC";
     }
     $result = mysqli_query($con, $sql2);
}
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
        position: fixed;
        bottom: 240px;
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
		height: 450px;
		padding: 20px;
        border-radius: 8px;
	}
	
</style>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    td, th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 8px;
    }
    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
<style>
    div.container {
        text-align: center;
    }

    ul.myUL {
        display: inline-block;
        text-align: center;
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
    <title>viex train</title>
</head>

<body>
    <div id="box">
        <div class="card">
            <div class="container">
                <h1><?php echo $num;?>次列車資訊</h1>
                <ul class="myUL">
                <table class="center">
                    <tr>
                        <th style="width:120px; height:50px">停靠站</th>
                        <th style="width:120px; height:50px">停靠時間</th>
                    </tr>
    
                    <?php
                        while($row = mysqli_fetch_assoc($result)) {?> 
                        <tr>
                            <td><?php echo $row["STATION_NAME"];?></td>
                            <td><?php echo $row["STOP_TIME"];?></td>
                        </tr>
                        <?php
                    } ?>
                 </table>
                </ul>
            </div>
        </div>
    

        <button id="button" class="button" type="button" onclick="location.href='train.php'">回上一頁</button>

    </div>

</body>

</html>