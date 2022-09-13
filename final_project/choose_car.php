<?php

use LDAP\Result;

 session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<head>
	<title>車廂選擇</title>
<style type="text/css">
	body { background-color: #fff; border-top: solid 10px #000;
		color: #000; font-size: .85em; margin: 10px; padding: 2px;
		font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
	}
	
	table { 
            margin-top: 0.75em;
            position:absolute;
            left:350px;
            top:300px;
            background-color:#000;
            color:#FF8C00;
            border:3px #fff dashed;
        }
	th { font-size: 1.5em; text-align: center; padding-right: 200px; }
	td { font-size: 1.5em; text-align: center}
	form{
		line-height: 2em;
	}
    #header {
        width: 1510px;
        height: 200px;
        padding: 2px;
        text-align: center;
        background: #FF8C00;
        color: #fff;
        border-radius: 8px;
    }
    #列表 {
		background-color: #000000;
        position: absolute;
        width: 1510px;
        height:250px;
        padding: 2px;
        border-radius: 8px;
	}
    #圖片 {
			position: absolute;
			left : 50px;
			top :55px;
	}

    #連結 {
        color:#fff;
    }

	</style>
</head>

<body>
<div id="header"><h1>車廂選擇</h1></div>

<?php

    include "mysql_connect.inc.php";

    $train_num = $_GET["train_num"];
    $start = $_SESSION["start"];
    $end = $_SESSION["end"];
    $date = $_SESSION["date"];
    $time = $_SESSION["time"];
    $identity_num = $_SESSION["identity_num"];
    $quantity = $_SESSION["quantity"];
    $count = $_SESSION["count"];
    $_SESSION["train_num"] = $train_num;
    $mem_num = $_SESSION['mem'];
    $_SESSION["count"] = $_SESSION["count"] + 1;
    $same_order = $_GET["same_order"];

    $num2 = 2;
 
    $sql = "SELECT * FROM `order` WHERE ORDER_NUM ='$same_order'";
    $check = $mysqli->query($sql);
    $num2 =  mysqli_num_rows($check);
    if(intval($num2) == 0){
        $sql = "INSERT INTO `order`(MEM_NUM, TRAIN_NUM, ORDER_DATE,ORDER_STATE) VALUES('$mem_num','$train_num','$date','1')";
        $mysqli->query($sql)==true;
        $sql = "SELECT MAX(ORDER_NUM) FROM `order`";
        $result = $mysqli->query($sql);
        $order = $result->fetch_assoc();
        $same_order = $order["MAX(ORDER_NUM)"];
        
    }
    


?>
<div id="列表"></div>
<table style="table" cellpadding="10" border='1'>

    <tr>
        <th colspan="3">商務</th>
        <th colspan="5">標準</th>
        <th colspan="4">自由座</th>
    </tr>
    <tr>
        <td><a href="choose_seat.php?&same_order=<?=$same_order?>&car=1" id="連結"> 1 </a></td>
        <td><a href="choose_seat.php?&same_order=<?=$same_order?>&car=2" id="連結"> 2 </a></td>
        <td><a href="choose_seat.php?&same_order=<?=$same_order?>&car=3" id="連結"> 3 </a></td>
        <td><a href="choose_seat.php?&same_order=<?=$same_order?>&car=4" id="連結"> 4 </a></td>
        <td><a href="choose_seat.php?&same_order=<?=$same_order?>&car=5" id="連結"> 5 </a></td>
        <td><a href="choose_seat.php?&same_order=<?=$same_order?>&car=6" id="連結"> 6 </a></td>
        <td><a href="choose_seat.php?&same_order=<?=$same_order?>&car=7" id="連結"> 7 </a></td>
        <td><a href="choose_seat.php?&same_order=<?=$same_order?>&car=8" id="連結"> 8 </a></td>
        <td colspan="4"><a href="ticket.php?&same_order=<?=$same_order?>&car=9" id="連結">9~12</td>
    </tr>

</table>



<script language="JavaScript">
window.history.go(1);
</script>
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSqHz7vIFoHJMQ5JtzgxYUoEhuA5bai4pe7EQ&usqp=CAU" id="圖片">
</body>