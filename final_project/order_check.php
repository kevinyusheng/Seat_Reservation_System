<?php
 session_start();
 ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
	<title>訂單結帳資訊</title>
<style type="text/css">
     #header {
        width: 1510px;
        height: 200px;
        padding: 2px;
        text-align: center;
        background: #FF8C00;
        color: white;
        border-radius: 8px;
    }
    #列表 {
		background-color: #000;
        position: absolute;
        width: 1510px;
        height: 450px;
        padding: 2px; 
        border-radius: 8px;
	}
	body { background-color: #fff; border-top: solid 10px #000;
		color: #000; font-size: .85em; margin: 10px; padding: 2px;
		font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
	}
	table { margin-top: 0.75em;
            position:absolute;
            left:135px;
            top:250px;
            background-color:#000;
            color:#fff;}
	th { font-size: 1.4em; text-align: center; padding-right: 15px; }
	td { font-size: 1.4em; text-align: center; }
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

    #連結 {
        color:#FF4500;
    }
    #圖片 {
			position: absolute;
			left : 50px;
			top :55px;
	}
    #information{
        color:#fff;
    }
    #top{
            color:#FF8C00; 
    }

   
	</style>
</head>

<title>訂單資訊</title>

<body>
<div id="header"><h1>訂票資訊</h1></div>

<?php
    include "mysql_connect.inc.php";
    $start = $_SESSION["start"];
    $end = $_SESSION["end"];
    $date = $_SESSION["date"];
    $time = $_SESSION["time"];
    $identity_num = $_SESSION["identity_num"];
    $quantity = $_SESSION["quantity"];
    $count = $_SESSION["count"];
    $train_num = $_SESSION["train_num"];
    $car = $_SESSION["car"];
    $same_order = $_GET["same_order"];
    $car = $_SESSION["car"];

    $sql = "SELECT * FROM SEAT S JOIN TICKET T ON S.TICKET_NUM = T.TICKET_NUM AND S.ORDER_NUM = T.ORDER_NUM AND T.TRAIN_NUM = S.TRAIN_NUM WHERE T.ORDER_NUM = $same_order AND T.TRAIN_NUM = $train_num order by T.TICKET_NUM" ;
    $result = $mysqli->query($sql);


    $sql = "SELECT STATION_NAME FROM STATION WHERE STATION_NUM = '$start'";
    $result2 = $mysqli->query($sql);
    $st =$result2->fetch_assoc()["STATION_NAME"];
    $sql = "SELECT STATION_NAME FROM STATION WHERE STATION_NUM = '$end'";
    $result2 = $mysqli->query($sql);
    $ed =$result2->fetch_assoc()["STATION_NAME"];
    $route = $st."->".$ed;
    $sql = "SELECT * FROM `stop` WHERE STATION_NUM = '$end' and TRAIN_NUM ='$train_num'";
    $result2 = $mysqli->query($sql);
    $arrive_time = $result2->fetch_assoc()["STOP_TIME"];

?>
<table style="border:3px #fff dashed;" cellpadding="10" border='1'>
<div id="列表">
<tr>
    <th id="top">票號</th>
    <th id="top">火車編號</th>
    <th id="top">發車日期</th>
    <th id="top">發車時間</th>
    <th id="top">預計抵達</th>
    <th id="top">路線</th>
    <th id="top">車票優惠</th>
    <th id="top">車廂</th>
    <th id="top">座位</th>
    <th id="top">價格</th>
    <th id="top">付款狀況</th>
</tr>
</div>
<?php
    while ($info = $result->fetch_assoc()) {
        ?>
        <tr>
        <?php
        $ticket_number = $same_order."-".$info["TICKET_NUM"];
        $sql1 = "SELECT * FROM `IDENTITY` WHERE IDENTITY_NUM = '$identity_num'";
        $result1 = $mysqli->query($sql1);
        $result1 = $result1->fetch_assoc();
        ?>
        <td id="information"><?php echo $ticket_number ?></td>
        <td id="information"><?php echo $train_num ?></td>
        <td id="information"><?php echo $date ?></td>
        <td id="information"><?php echo $time ?></td>
        <td id="information"><?php echo $arrive_time ?></td>
        <td id="information"><?php echo $route ?></td>
        <td id="information"><?php echo $result1["IDENTITY_NAME"] ?></td>
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
        </tr>
        <?php
    }
    
?>
<td colspan="11" align="center"><a href="pay.php?same_order=<?=$same_order?>" id="連結"> 前往付款</a></td>
</table>

<script language="JavaScript">
    window.history.go(1);
</script>
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSqHz7vIFoHJMQ5JtzgxYUoEhuA5bai4pe7EQ&usqp=CAU" id="圖片">
</body>