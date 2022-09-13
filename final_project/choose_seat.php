<?php
 session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<head>
	<title>座位選擇</title>
<style type="text/css">
	body { background-color: #fff; border-top: solid 10px #000;
		color: #333; font-size: .85em; margin: 10px; padding: 2px;
		font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
	}
	table { border:3px #FFD382 dashed;
               position:absolute; 
               top:250px;
               left:500px;
               border:1;
               width:500;
               height:80;
               background-color:#000;
               border:5px #fff dashed;  
            }
	th { font-size: 1.4em; text-align: center; padding-right: 15px; }
	td { font-size: 1.4em; padding: 0.25em 2em 0.25em 0em; }
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
        width: 1505px;
        height:500px;
        border-radius: 8px;
	}
    #圖片 {
			position: absolute;
			left : 50px;
			top :55px;
	}
    #連結 {
        color:#FF4500;
    }
</style>
</head>

<body>
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

    $same_order = $_GET["same_order"];

    
    
    if ($car == 1 or $car == 2 or $car == 3) {
        ?>
        <div id="header"><h1>商務車廂-<?php echo $car ?> 座位表</h1></div>
		<div id="列表"></div>
        
		<table  style="table" cellpadding="10" border='1'>

        <?php for($t=0;$t<10;$t++){?>
                <tr>
                
                <?php for($d=1;$d<=2;$d++){
                    $seat_num = $t*4 + $d;
                    $sql = "SELECT SEAT_NUM FROM SEAT WHERE SEAT_CAR = '$car' AND TRAIN_NUM = '$train_num' AND SEAT_NUM = '$seat_num'";
                    $check = $mysqli->query($sql);
                    $nums=mysqli_num_rows($check);
                    
                    if (intval($nums)>0) { ?>
                        <td style="background-color:#78FFFF" align="center"><?php echo $seat_num ?></td>
                    <?php }else{?>
                        <td align="center"><a href="ticket.php?car=<?=$car?>&seat_num=<?=$seat_num?>&same_order=<?=$same_order?>" id="連結"><?php echo $seat_num ?></a></td>
                    <?php } ?>

                <?php } ?>

                <td class="space">&nbsp;</td>
                
                <?php for($d=3;$d<=4;$d++){ 

                    $seat_num = $t*4 + $d;
                    $sql = "SELECT SEAT_NUM FROM SEAT WHERE SEAT_CAR = '$car' AND SEAT_NUM = '$seat_num'";
                    $check = $mysqli->query($sql);
                    $nums=mysqli_num_rows($check);

                    if (intval($nums)>0) { ?>
                        <td style="background-color:#78FFFF" align="center"><?php echo $seat_num ?></td>
                    <?php }else{?>
                        <td align="center"><a href="ticket.php?car=<?=$car?>&seat_num=<?=$seat_num?>&same_order=<?=$same_order?>" id="連結"><?php echo $seat_num ?></a></td>
                    <?php } ?>
                <?php } ?>

                </tr>
        <?php } ?>
		</table>

        

		<?php
    }else{
        
        
		?>
        <div id="header"><h1>標準車廂-<?php echo $car ?> 座位表</h1></div>
        <div id="列表"></div>
		<table style="table" cellpadding="10" border='1'>
        <?php for($t=0;$t<10;$t++){?>
                <tr>
                
                <?php for($d=1;$d<=3;$d++){

                    $seat_num = $t*5 + $d;
                    $sql = "SELECT SEAT_NUM FROM SEAT WHERE SEAT_CAR = '$car' AND TRAIN_NUM = '$train_num' AND SEAT_NUM = '$seat_num'";
                    $check = $mysqli->query($sql);
                    $nums=mysqli_num_rows($check);

                    if (intval($nums)>0) { ?>
                        <td style="background-color:#78FFFF" align="center"><?php echo $seat_num ?></td>
                    <?php }else{?>
                        <td align="center"><a href="ticket.php?car=<?=$car?>&seat_num=<?=$seat_num?>&same_order=<?=$same_order?>" id="連結"><?php echo $seat_num ?></a></td>
                    <?php } ?>

                <?php } ?>

                <td class="space">&nbsp;</td>
                
                <?php for($d=4;$d<=5;$d++){ 

                    $seat_num = $t*5 + $d;
                    $sql = "SELECT SEAT_NUM FROM SEAT WHERE SEAT_CAR = '$car' AND SEAT_NUM = '$seat_num'";
                    $check = $mysqli->query($sql);
                    $nums=mysqli_num_rows($check);

                    if (intval($nums)>0) { ?>
                        <td style="background-color:#78FFFF" align="center"><?php echo $seat_num ?></td>
                    <?php }else{?>
                        <td align="center"><a href="ticket.php?car=<?=$car?>&car=<?=$car?>&seat_num=<?=$seat_num?>&same_order=<?=$same_order?>" id="連結"><?php echo $seat_num ?> </a></td>
                    <?php } ?>
                <?php } ?>

                </tr>
        <?php } ?>
		</table>
		<?php
    }
?>
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSqHz7vIFoHJMQ5JtzgxYUoEhuA5bai4pe7EQ&usqp=CAU" id="圖片">
</body>

<script language="JavaScript">
    window.history.go(1);
</script>