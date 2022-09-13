<?php
 session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
<style type="text/css">
	body { background-color: #fff; border-top: solid 10px #000;
		color: #333; font-size: .85em; margin: 10px; padding: 2px;
		font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
	}
	
	table { 
        margin-top: 2em;
            position:absolute;
            left:550px;
            top:210px;
            height: 600px;
            width: 500px;
            background-color:#000;
            color:#fff;
            border:5px #fff dashed;
    }
	th { font-size: 1.2em; text-align: center; padding-right: 15px; }
	td { font-size: 1.5em; text-align: center;  }
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
    #header {
        width: 1500px;
        height: 180px;
        padding: 2px;
        text-align: center;
        background: #FF8C00;
        color: #fff;
        border-radius: 8px;
    }
    #列表 {
		background-color: #000;
        position: absolute;
        width: 1505px;
        height: 650px;
        border-radius: 8px;
	}
    #圖片 {
			position: absolute;
			left :50px;
			top :40px;
	}
    #連結 {
        color:#FF4500;
    }

    #information{
        color:#FF8C00;
    }
	</style>
</head>

<title>高鐵訂票確認</title>


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
    $car = $_GET["car"];
    $seat_num = $_GET["seat_num"];
    $same_order = $_GET["same_order"];
    $ticket_state = 1;
    
    $sql = "SELECT * FROM `IDENTITY` WHERE IDENTITY_NUM = '$identity_num'";
    $result = $mysqli->query($sql);
    $result = $result->fetch_assoc();

    $ticket_price = abs(100*($end-$start) * $result["IDENTITY_MULTIPLE"]);
    $sql = "SELECT STATION_NAME FROM STATION WHERE STATION_NUM = '$start'";
    $result = $mysqli->query($sql);
    $st =$result->fetch_assoc()["STATION_NAME"];
    $sql = "SELECT STATION_NAME FROM STATION WHERE STATION_NUM = '$end'";
    $result = $mysqli->query($sql);
    $ed =$result->fetch_assoc()["STATION_NAME"];
    $route = $st."->".$ed;
    
    $sql = "INSERT INTO TICKET(TICKET_NUM, ORDER_NUM, IDENTITY_NUM, TRAIN_NUM, TICKET_PRICE,TICKET_STATE,TICKET_START,TICKET_END) 
    VALUES('$count','$same_order','$identity_num','$train_num','$ticket_price','$ticket_state','$st','$ed')";
    $mysqli->query($sql);

    if($car==9){
        $tmp = 1;
        $rand;
        while (intval($tmp) != 0) {
            $rand = rand(100,2000);
            $sql = "SELECT * FROM SEAT WHERE SEAT_NUM = '$rand' AND ORDER_NUM = '$same_order' AND SEAT_CAR = '$car' " ;
            $result = $mysqli->query($sql);
            $tmp = mysqli_num_rows($result);
        }
        
        $sql = "INSERT INTO SEAT(TRAIN_NUM, SEAT_NUM, ORDER_NUM, SEAT_CAR, TICKET_NUM) VALUES('$train_num','$rand','$same_order','$car','$count')"; 
    }else{
        $sql = "INSERT INTO SEAT(TRAIN_NUM, SEAT_NUM, ORDER_NUM, SEAT_CAR, TICKET_NUM) VALUES('$train_num','$seat_num','$same_order','$car','$count')";
    }
    
    $mysqli->query($sql);

?>

<body>
<div id="header"><h1>高鐵訂票確認</h1></div>
<div id="列表"></div>


<table style="table" cellpadding="10" border='1'>
<?php
    $temp = "第 ".$count." 張票";
?>
<tr>
    <td id="information">票卷</td>
    <td><?php echo $temp ?></td>
</tr>
<tr>
    <td id="information">日期</td>
    <td><?php echo $date ?></td>
</tr>
<tr>
    <td id="information">時間</td>
    <td><?php echo $time ?></td>
</tr>
<tr>
    <td id="information">火車編號</td>
    <td><?php echo $train_num ?></td>
</tr>


<?php
    $sql = "SELECT STATION_NAME FROM STATION WHERE STATION_NUM = '$start'";
    $result = $mysqli->query($sql);
    $st =$result->fetch_assoc()["STATION_NAME"];
    $sql = "SELECT STATION_NAME FROM STATION WHERE STATION_NUM = '$end'";
    $result = $mysqli->query($sql);
    $ed =$result->fetch_assoc()["STATION_NAME"];
    $route = $st."->".$ed;
?>
<tr>
    <td id="information">路線</td>
    <td><?php echo $route ?></td>
</tr>
<?php
    $car_class;
    if ($car == 1 or $car == 2 or $car == 3) {
        $car_class ="商務車廂-".$car;
    }else if($car == 4 or $car == 5 or $car == 6 or $car == 7 or $car == 8){
        $car_class ="標準車廂-".$car;
    }else{
        $car_class ="自由座車廂";
    }
?>
<tr>
    <td id="information">車廂</td>
    <td><?php echo $car_class ?></td>
</tr>
<tr>
    <td id="information">座位號碼</td>
<?php
    if ($car == 9) {
        ?>
        <td>自由座</td>
        <?php
    }else{
        ?>
        <td><?php echo $seat_num ?></td>
        <?php
    }
?>
</tr>
<tr>
    <td id="information">票價</td>
    <td><?php echo $ticket_price ?></td>
</tr>
    <td colspan="2" align="center">
<?php
    if (intval($count) == intval($quantity)){
        ?>
        <a href="order_check.php?same_order=<?=$same_order?>" id="連結"> 確認 </a>
        <?php
    }else {
        ?>
        <a href="choose_car.php?same_order=<?=$same_order?>&train_num=<?=$train_num?>" id="連結"> 確認 </a>
        <?php
    }
?>
    </td>
</table>
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSqHz7vIFoHJMQ5JtzgxYUoEhuA5bai4pe7EQ&usqp=CAU" id="圖片">
</body>

<script language="JavaScript">
    window.history.go(1);
</script>

