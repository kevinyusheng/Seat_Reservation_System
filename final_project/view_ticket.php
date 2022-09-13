<?php session_start(); ?>
<meta http-equiv="Content_Type" content="text/html;charset=utf-8" />
<?php 
include("connection.php");

$order_num = $_GET['num'];

if ($_SESSION['MNA_ID'] != null) {
  $sql = "SELECT `ORDER`.ORDER_NUM, TICKET.TICKET_NUM, TICKET_STATE, TICKET_START, TICKET_END, TRAIN.TRAIN_NUM, TRAIN_STATE, TRAIN_DATE, SEAT_CAR, SEAT_NUM, IDENTITY_NAME, ROUND(TICKET_PRICE*IDENTITY_MULTIPLE, 0) AS PRICE
  FROM `MEMBER` JOIN `ORDER` ON `MEMBER`.MEM_NUM = `ORDER`.MEM_NUM
  JOIN TICKET ON `ORDER`.ORDER_NUM = TICKET.ORDER_NUM
  JOIN `IDENTITY` ON TICKET.IDENTITY_NUM = `IDENTITY`.IDENTITY_NUM
  JOIN TRAIN ON TICKET.TRAIN_NUM = TRAIN.TRAIN_NUM
  JOIN SEAT ON TICKET.ORDER_NUM = SEAT.ORDER_NUM
  WHERE `ORDER`.ORDER_NUM = '$order_num'";
  $result = mysqli_query($con, $sql);
}
else {
  echo '您無權觀看此畫面！';
  //echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
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
<head>
  <title>view ticket</title>
</head>
<body>
  <div class="header">
    <h2>訂單編號：<?php echo $order_num;?></h2>
  </div>
  <div class="topnav">
    <a class="active" href="view_order.php"><i class="fa-solid fa-arrow-left-long"></i>回上一頁</a>
  </div>
<table style="width:100%">
  <tr>
    <th>車次</th>
    <th>車次日期</th>
    <th>運行狀態</th>
    <th>乘坐區間</th>
    <th>車廂</th>
    <th>座位</th>
    <th>票種</th>
    <th>票價</th>
    <th>付款狀態</th>
  </tr>
  <?php
  while($row = mysqli_fetch_assoc($result)) { ?>
  <tr>
    <td><?php echo $row["TRAIN_NUM"]; ?></td>
    <td><?php echo $row["TRAIN_DATE"]; ?></td>
    <td><?php
    if ($row["TRAIN_STATE"] == 1) {
      echo '正常';
    }else {
      echo '取消';
    }
    ?></td>
    <td><?php echo $row["TICKET_START"], ' -> ' , $row["TICKET_END"]; ?></td>
    <td><?php echo $row["SEAT_CAR"]; ?></td>
    <td><?php echo $row["SEAT_NUM"]; ?></td>
    <td><?php echo $row["IDENTITY_NAME"]; ?></td>
    <td><?php echo $row["PRICE"]; ?></td>
    <td><?php
    if ($row["TICKET_STATE"] == 2) {
      echo '已付款';
    }else {
      echo '未付款';
    }
    ?></td>
  </tr>    
  <?php 
  } ?>
    
</table>

</body>
</html>