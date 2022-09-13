<?php session_start(); ?>
<meta http-equiv="Content_Type" content="text/html;charset=utf-8" />
<?php 
include("connection.php");

if ($_SESSION['MNA_ID'] != null) {
    $sql = "SELECT CONCAT(CONCAT(MEM_FNAME, ', '), UPPER(MEM_LNAME)) AS NAME, MEM_ID, `ORDER`.ORDER_NUM, ORDER_DATE, ORDER_STATE, TRAIN.TRAIN_NUM, TRAIN_DATE, TRAIN_STATE, COUNT(TICKET.TICKET_NUM) AS ORDER_TICKET, ROUND(SUM(TICKET_PRICE*IDENTITY_MULTIPLE), 0) AS ORDER_SUM
    FROM `MEMBER` JOIN `ORDER` ON `MEMBER`.MEM_NUM = `ORDER`.MEM_NUM
    JOIN TICKET ON `ORDER`.ORDER_NUM = TICKET.ORDER_NUM
    JOIN TRAIN ON `ORDER`.TRAIN_NUM = TRAIN.TRAIN_NUM
    JOIN IDENTITY ON TICKET.IDENTITY_NUM = IDENTITY.IDENTITY_NUM
    GROUP BY `ORDER`.ORDER_NUM ORDER BY `MEMBER`.MEM_NUM";
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
  .topnav-right {
    float: right;
    padding: 5px;
    border-radius: 15px;
  }
  .topnav-right:hover {
    background-color: #666;
    color: black;
    border-bottom: 3px solid red;
  }
  .topnav.active {
    background-color: #666;
    color: white;
    border-radius: 8px;
  }
  
</style>
<style>
  .button {
    	padding: 2px 20px;
    	font-size: 15px;
      height: 25px;
    	text-align: center;
    	cursor: pointer;
    	outline: none;
    	color: #fff;
    	background-color: #ff8c00;
    	border: none;
    	border-radius: 8px;
    	box-shadow: 0 4px #999;
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
  <title> view order</title>
</head>
<body>
  <div class="header">
    <h2>訂單總覽</h2>
  </div>
<form name="form" method="post" action="get_member_order.php">
<div class="topnav">
      <a >查詢特定會員的訂單紀錄</a>
      <a >會員帳號：<input type="text" name="id" /> &nbsp;<input class="button" type="submit" name="button" value="查詢" /></a>
      <div class="topnav-right">
        <a class="active" href="manager.php"><i class="fa-solid fa-house"></i> Home</a>
      </div>
    </div>
</form>

<table style="width:100%">
  <tr>
    <th>訂單編號</th>
    <th>姓名</th>
    <th>會員帳號</th>
    <th>訂購日期</th>
    <th>車次</th>
    <th>車次日期</th>
    <th>運行狀態</th>
    <th>訂購張數</th>
    <th>訂單總價</th>
    <th>訂單取消</th>
  </tr>
  <?php
  while($row = mysqli_fetch_assoc($result)) { ?>
  <tr><?php
  if ($row["ORDER_STATE"] == 1) {?>
      <td><?php echo '<a href="view_ticket.php?num=',$row['ORDER_NUM'],'">',$row['ORDER_NUM'],'</a>';?></td>
      <td><?php echo $row["NAME"]; ?></td>
      <td><?php echo $row["MEM_ID"]; ?></td>
      <td><?php echo $row["ORDER_DATE"]; ?></td>
      <td><?php echo $row["TRAIN_NUM"]; ?></td>
      <td><?php echo $row["TRAIN_DATE"]; ?></td>
      <td><?php
      if ($row["TRAIN_STATE"] == 1) {
        echo '正常';
      }else {
        echo '取消';
      }
      ?></td>
      <td><?php echo $row["ORDER_TICKET"]; ?></td>
      <td><?php echo $row["ORDER_SUM"]; ?></td>
      <td>
        <form name="cancel" method="post" action="order_cancel.php">
        <input type="hidden" name="order_num" value="<?php echo $row['ORDER_NUM']; ?>"/>
        <button type="submit" class="button" onclick="return confirm('確定取消這筆訂單嗎？');">取消</button>
        </form>
      </td>
    <?php
    }?>
  </tr>    
  <?php 
  } ?>
    
</table>

</body>
</html>