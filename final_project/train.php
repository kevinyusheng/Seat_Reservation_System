<?php session_start(); ?>
<meta http-equiv="Content_Type" content="text/html;charset=utf-8" />
<?php
include("connection.php");
if($_SESSION['MNA_ID'] != null) {
    $sql = "SELECT TRAIN_NUM, TRAIN_STATE, TRAIN_DIR, DATE_FORMAT(TRAIN_DATE, '%Y/%m/%d') AS TRAIN_DATE, min(STATION_NUM) AS START, MAX(STATION_NUM) AS DEST FROM TRAIN NATURAL JOIN STOP 
    WHERE TRAIN_NUM IN (SELECT DISTINCT TRAIN_NUM FROM TRAIN) GROUP BY TRAIN_NUM ORDER BY TRAIN_DATE, TRAIN_NUM";
    $result = mysqli_query($con, $sql);
}else {
    echo '您無權觀看此畫面！';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
}
?>
<html>
<script src="https://kit.fontawesome.com/f11705a8f4.js" crossorigin="anonymous"></script>
<style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }
  tr:nth-child(even) {
    background-color: #dddddd;
  }
  .header {
    padding: 80px;
    text-align: center;
    background: #ff8c00;
    color: white;
    border-radius: 8px;
  }
</style>
<style>
  /* Add a black background color to the top navigation */
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
    border-radius: 8px;
  }
  /* Add a color to the active/current link */
  .topnav a.active {
    background-color: #666;
    color: white;
    border-radius: 8px;
  }
</style>
<style>
  .button_home {
    padding: 10px 20px;
    font-size: 20px;
    text-align: center;
    cursor: pointer;
    outline: none;
    color: #fff;
    background-color: #ff8c00;
    border: none;
    border-radius: 0px;
    box-shadow: 0 6px #999;
  }
  .button {
    padding: 10px 15px;
    font-size: 20px;
    text-align: center;
    cursor: pointer;
    outline: none;
    background-color: #ff8c00;
    border: none;
    border-radius: 15px;
    box-shadow: 0 6px #999;
  }
  .button:active {
    background-color: #ffc800;
    box-shadow: 0 5px #666;
    transform: translateY(4px);
  }
  .btn {
    border: none;
    background-color: inherit;
    padding: 14px 15px;
    font-size: 20px;
    cursor: pointer;
    display: inline-block;
    }
    .btn:hover {background: #eee;}
    .info {color: dodgerblue;}
</style>
<head>
 <title> train information</title>
</head>

<body>
    <div class="header">
        <h1>列車資訊</h1>
    </div>
    <div class="topnav">
      <a class="active button_home" href="manager.php"><i class="fa-solid fa-house"></i> Home</a>
      <a href="train_add.php">新增班次</a>
    </div>


<!-- <button type="button" onclick="location.href='train_add.php'">新增班次</button>&nbsp;&nbsp;&nbsp;
<button type="button" onclick="location.href='manager.php'">回上一頁</button> -->
<table>
    <tr>
        <th style="width:25px">車次</th>
        <th>日期</th>
        <th>起始站</th>
        <th>終點站</th>
        <th>運行狀態</th>
        <th>取消開行</th>
    </tr>
    <?php
    while($row = mysqli_fetch_assoc($result)) { 
        include("connection.php");?>
    <tr>
        <td><?php echo '<a class="btn info" href="view_train.php?num=',$row['TRAIN_NUM'],'">',$row['TRAIN_NUM'],'</a>';?></td>
        <td><?php echo $row["TRAIN_DATE"];?></td>
        <td>
             <?php
                // $start_num = $row["START"];
                // $sql2 = "SELECT STATION_NAME FROM STATION WHERE STATION_NUM = '$start_num'";
                // $result2 = mysqli_query($con, $sql2);
                // echo mysqli_fetch_row($result2)[0];
                if ($row["TRAIN_DIR"] == 1) {
                    $start_num = $row["START"];
                } else {
                    $start_num = $row["DEST"];
                }
                $sql2 = "SELECT STATION_NAME FROM STATION WHERE STATION_NUM = '$start_num'";
                $result2 = mysqli_query($con, $sql2);
                echo mysqli_fetch_row($result2)[0];
           ?> 
        </td>
        <td>
            <?php 
                // $dest_num = $row["DEST"];
                // $sql3 = "SELECT STATION_NAME FROM STATION WHERE STATION_NUM = '$dest_num'";
                // $result3 = mysqli_query($con, $sql3);
                // echo mysqli_fetch_row($result3)[0];
                if ($row["TRAIN_DIR"] == 1) {
                    $dest_num = $row["DEST"];
                } else {
                    $dest_num = $row["START"];
                }
                $sql3 = "SELECT STATION_NAME FROM STATION WHERE STATION_NUM = '$dest_num'";
                $result3 = mysqli_query($con, $sql3);
                echo mysqli_fetch_row($result3)[0];
            ?>
        </td>
        <td><?php
            if ($row["TRAIN_STATE"] == 1) {
                echo '正常';
            }else {
                echo '取消';
            }?>
        </td>
        <td>
             
            <form name="edit" method="post" action="train_cancel.php">
                <input type="hidden" name="train_num" value="<?php echo $row['TRAIN_NUM']; ?>"/>
                <button class="button" type="submit" onclick="return confirm('確認取消<?php echo $row['TRAIN_DATE'],' ', $row['TRAIN_NUM'];?>次列車嗎？');" 
                <?php echo ($row["TRAIN_STATE"]==0)?'disabled':''?>> <i class="fa-solid fa-trash-can"></i> 取消</button>
                <button class="button" type="submit" onclick="return confirm('確認恢復<?php echo $row['TRAIN_DATE'],' ', $row['TRAIN_NUM'];?>次列車開行嗎？');" 
                formaction="train_recover.php" <?php echo ($row["TRAIN_STATE"]==1)?'disabled':''?>><i class="fa-solid fa-arrow-rotate-left"></i> 恢復開行</button>
            </form>
        </td>
    </tr>
    <?php
    } ?>
</table>

</body>
</html>