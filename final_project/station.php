<?php session_start(); ?>
<meta http-equiv="Content_Type" content="text/html;charset=utf-8" />
<?php
include("connection.php");
if ($_SESSION['MNA_ID'] != null) {
    $sql = "SELECT * FROM STATION";
    $result = mysqli_query($con, $sql);
}
else {
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
  .topnav {
      background-color: #555;
      overflow: hidden;
      border-radius: 8px;
  }
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
  .topnav a:hover {
    background-color: #ddd;
    color: black;
    border-bottom: 3px solid red;
  }
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
    padding: 10px 20px;
    font-size: 20px;
    text-align: center;
    cursor: pointer;
    outline: none;
    color: #fff;
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
</style>
<head>
  <title>station</title>
</head>
<body>
  <div class="header">
    <h1>車站資訊</h1>
  </div>
  <div class="topnav">
    <a class=" active button_home" href="manager.php"><i class="fa-solid fa-house"></i> Home</a>
    <a href="station_add.php">新增車站</a>
  </div>

<!-- <button type="button" onclick="location.href='station_add.php'">新增車站</button>
<button type="button" onclick="location.href='manager.php'">回上一頁</button> -->
<table style="width:100%">
  <tr>
    <th>編號</th>
    <th>站名</th>
    <th>地址</th>
    <th>動作</th>
  </tr>
  <?php
  while($row = mysqli_fetch_assoc($result)) { ?>
  <tr>
    <td><?php echo $row["STATION_NUM"]; ?></td>
    <td><?php echo $row["STATION_NAME"]; ?></td>
    <td><?php echo $row["STATION_ADDRESS"]; ?></td>
    <td>
      <form name="edit" method="post" action="station_edit.php">
        <input type="hidden" name="station_num" value="<?php echo $row['STATION_NUM']; ?>"/>
        <input type="hidden" name="station_name" value="<?php echo $row['STATION_NAME']; ?>"/>
        <input type="hidden" name="station_address" value="<?php echo $row['STATION_ADDRESS']; ?>"/>
        <button type="submit" class="button"><i class="fa-solid fa-pen-to-square"></i> 編輯</button>
        <button type="submit" class="button" onclick="return confirm('確認刪除<?php echo $row['STATION_NAME'];?>站嗎？');" formaction="station_delete.php"><i class="fa-solid fa-trash-can"></i> 刪除</button>
      </form>
    </td>
  </tr>
  <?php
  } ?>
</table>

</body>
</html>