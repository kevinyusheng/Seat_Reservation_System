<?php
 session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
<script src="https://kit.fontawesome.com/f11705a8f4.js" crossorigin="anonymous"></script>
<style type="text/css">
	body { background-color: #fff; border-top: solid 10px #000;
		color: #333; font-size: .85em; margin: 10px; padding: 2px;
		font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
	}
	h1, h2, h3 { color: #000; margin-bottom: 0; padding-bottom: 0; }
	h1 { font-size: 2em; }
	h2 { font-size: 1.75em; }
	h3 { font-size: 1.2em; }
	th { font-size: 1.2em; text-align: center; padding-right: 15px; }
	td { padding: 0.25em 2em 0.25em 0em; }
	form{
		line-height: 2em;
	}
	form>input{
		padding: 5px, 10px; 
		border: 1px solid #888888;
		border-radius: 5px;
	}
	form>.ok{
		color: #008800;
	}
	form>input:valid+.ok{
		display: inline;
	}
	form>input:invalid+.ok{
		display: none;
	}
    a {
    text-decoration:none;
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
    margin-top: 0.75em;
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
  }
  .topnav a.active {
    background-color: #666;
    color: white;
    border-bottom: 3px solid red;
    border-radius: 8px;
  }
</style>
</head>

<title>訂單資訊</title>

<body>
<div class="header">
    <h1>訂票歷史記錄</h1>
</div>
<div class="topnav">
    <a class="active" href="index.php"><i class="fa-solid fa-house"></i> Home</a>
</div>

<?php
    include "mysql_connect.inc.php";
    
    $mem = $_GET['mem'];
    $sql = "SELECT * FROM SEAT S JOIN TICKET T ON (S.TICKET_NUM = T.TICKET_NUM AND S.ORDER_NUM = T.ORDER_NUM) JOIN `ORDER` O ON T.ORDER_NUM = O.ORDER_NUM WHERE MEM_NUM = $mem order by O.ORDER_NUM , T.TICKET_NUM" ;
    $result = $mysqli->query($sql);


?>
<table style="border:3px #FFD382 dashed;" cellpadding="10" border='1'>
<tr>
    <th>票號</th>
    <th>火車編號</th>
    <th>運行狀態</th>
    <th>發車日期</th>
    <th>發車時間</th>
    <th>預計抵達</th>
    <th>路線</th>
    <th>車票優惠</th>
    <th>車廂</th>
    <th>座位</th>
    <th>價格</th>
    <th>付款狀況</th>
    <th>訂單狀況</th>
</tr>
<?php
    while ($info = $result->fetch_assoc()) {
        ?>
        
        <tr>
        <?php
        $ticket_number = $info["ORDER_NUM"]."-".$info["TICKET_NUM"];
        $identity_num = $info["IDENTITY_NUM"];
        $sql1 = "SELECT * FROM `IDENTITY` WHERE IDENTITY_NUM = '$identity_num'";
        $result1 = $mysqli->query($sql1);
        $result1 = $result1->fetch_assoc();
        $st = $info["TICKET_START"];
        $ed = $info["TICKET_END"];
        $route = $st."->". $ed;
        $_sql = "SELECT * FROM STATION WHERE STATION_NAME = '$st' ";
        $result2 = $mysqli->query($_sql);
        $st = $result2->fetch_assoc()["STATION_NUM"]; 
        $_sql = "SELECT * FROM STATION WHERE STATION_NAME = '$ed' ";
        $result2 = $mysqli->query($_sql);
        $ed = $result2->fetch_assoc()["STATION_NUM"]; 
        $tr = $info["TRAIN_NUM"];
        
        $_sql = "SELECT * FROM TRAIN WHERE TRAIN_NUM = '$tr'";
        $result2 = $mysqli->query($_sql);
        $tr_state = $result2->fetch_assoc()["TRAIN_STATE"]; 
        
        ?>


        <td><?php echo $ticket_number ?></td>
        <td><?php echo $info["TRAIN_NUM"] ?></td>
        <?php
            if (intval($tr_state) == 1) {
                $tmp = "運行中";
            }else{
                $tmp = "停駛";
            }
        ?>
        <td><?php echo $tmp ?></td>


        <td><?php echo $info["ORDER_DATE"] ?></td>

        <?php
            
            $_sql = "SELECT * FROM `stop` WHERE STATION_NUM = $st and TRAIN_NUM = $tr";
            $result2 = $mysqli->query($_sql);
            $st = $result2->fetch_assoc()["STOP_TIME"]; 
            
        ?>
        <td><?php echo $st ?></td>

        <?php
            $tr = $info["TRAIN_NUM"];
            $_sql = "SELECT * FROM `stop` WHERE STATION_NUM = $ed and TRAIN_NUM = $tr";
            $result2 = $mysqli->query($_sql);
            $ed = $result2->fetch_assoc()["STOP_TIME"]; 
        ?>
        <td><?php echo $ed ?></td>

        <td><?php echo $route ?></td>
        <td><?php echo $result1["IDENTITY_NAME"] ?></td>

        <?php
            $car_class;
            $car = $info["SEAT_CAR"];
            if ($car == 1 or $car == 2 or $car == 3) {
                $car_class ="商務車廂-".$car;
            }else if($car == 4 or $car == 5 or $car == 6 or $car == 7 or $car == 8){
                $car_class ="標準車廂-".$car;
            }else{
                $car_class ="自由座車廂";
            }
        ?>
        <td><?php echo $car_class ?></td>
        <?php
            if ($info["SEAT_CAR"]==9) {
                ?>
                <td>自由座</td>
                <?php
            }else{
                ?>
                <td><?php echo $info["SEAT_NUM"] ?></td>
                <?php
            }
        ?>
        <td><?php echo $info["TICKET_PRICE"] ?></td>
        <?php
            $state = $info["TICKET_STATE"];
            if (intval($state) == 1) {
                $tmp = "待付款";
            }else{
                $tmp = "已付款";
            }
        ?>
        <td><?php echo $tmp ?></td>

        <?php
            $state = $info["ORDER_STATE"];
            if (intval($state) == 1 and $tr_state == 1) {
                ?>
                <td align="center"><a href="end.php?mem=<?=$mem?>&order_num=<?=$info["ORDER_NUM"]?>&pay=4"> 取消訂單</a></td>
                <?php
            }else{
                ?>
                <td>已取消</td>
                <?php
            }
        ?>
        </tr>
        <?php
    }
    
?>
</table>

<script language="JavaScript">
    window.history.go(1);
</script>