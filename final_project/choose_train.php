

<?php
 session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>

	<title>符合條件車種</title>
    
<style type="text/css">
	body { background-color:#fff; border-top: solid 10px #000;
		color: #000; font-size: .85em; margin: 10px; padding: 2px;
		font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;

	}

    #one {
        background-color:#000;
    }
    #header {
        width: 1510px;
        padding: 2px;
        height: 200px;
        text-align: center;
        background: #FF8C00;
        color: white;
        border-radius: 8px;
    }
	table { 
            position:absolute;
            width: 1514px;
            margin-top: 0em;
            background-color:#000;
            color:#fff;  
            border-radius: 8px;  
    }
	th { font-size: 2em; text-align: center; border: none; color:#FF8C00 ;width: 200px; padding-right: 260px; height: 100px;}
	td { font-size: 2em;  border: 0; text-align: center;width:200px; padding-right:260px; height: 100px;}
	form{
		line-height: 2em;
	}

    #圖片 {
			position: absolute;
			left : 50px;
			top :50px;
	}
    #連結 {
        color:#FF4500;
    }
	</style>
</head>



<body>
<?php  

    include "mysql_connect.inc.php";
    $_SESSION["start"] = $_POST["start_stop"];
    $_SESSION["end"] = $_POST["end_stop"];
    $_SESSION["date"] = $_POST["order_date"];
    $_SESSION["time"] = $_POST["time_field"] . ":00";
    $_SESSION["identity_num"] = $_POST["identity_num"];
    $_SESSION["quantity"] = $_POST["quantity"];
    $_SESSION["count"] = 0;

    $start = $_SESSION["start"];
    $end = $_SESSION["end"];
    $date = $_SESSION["date"];
    $time = $_SESSION["time"];
    $identity_num = $_SESSION["identity_num"];
    $quantity = $_SESSION["quantity"];
    $count = $_SESSION["count"];
    
    




    if(intval($start) == intval($end)){
        echo "<h1>起站與迄站相同，請重新輸入!</h1>";
        echo '<meta http-equiv=REFRESH CONTENT=2;url=book_ticket.php>';
    }else{
        if(intval($start) > intval($end)){
            $dir = 2;
        }else{
            $dir = 1;
        }

        $sql = "SELECT * FROM `stop` JOIN `TRAIN` USING(TRAIN_NUM) WHERE STATION_NUM = '$start' and STOP_TIME >= '$time' and TRAIN_DIR = '$dir' and TRAIN_STATE = 1 ORDER BY STOP_TIME";
        $result = $mysqli->query($sql);
        $nums=mysqli_num_rows($result);

        if (intval($nums) > 0)
        {
            ?>
            
            <div id="header"><h1>符合條件車種</h1></div>
            <table border='1'>
                    <tr>
                        <th>火車編號</th>
                        <th>日期</th>
                        <th>時間</th>
                        <th>選擇</th>
                    </tr>

            <?php
        }
        else
        {
            echo '<h1>無查詢結果</h1>';
            echo '<meta http-equiv=REFRESH CONTENT=1;url=book_ticket.php>';
        }        
    }

  
?>  
</body>
<body>
<?php
    $flg = 0;
    while($Ctrain = $result->fetch_assoc())
    {
        
        $train_num = $Ctrain["TRAIN_NUM"];
        $time = $Ctrain["STOP_TIME"];
        $sql = "SELECT * FROM `stop` JOIN `TRAIN` USING(TRAIN_NUM) WHERE STATION_NUM = '$end' and TRAIN_NUM = '$train_num'";
        $check = $mysqli->query($sql);
        $nums=mysqli_num_rows($check);
        
        if(intval($nums)>0){
            $flg =1 ;
           echo "<tr>
                <td>"      . $train_num .     "</td>
                <td>" . $date . "</td>
                <td>" . $time . "</td>";

            echo "<td>" 
            ?>

                <a  href="choose_car.php?same_order= 0&train_num=<?=$train_num?>" id="連結"> opt </a>
            </td>
            <?php
            echo  "</tr>";
        }
        
        
        
    }
    if($flg == 0)
    {
        ?>
        <td colspan="4" align = 'center'>無查詢結果</td>
        <meta http-equiv=REFRESH CONTENT=1;url=book_ticket.php>
        <?php
    }  
    

    echo "</table>";
?>
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSqHz7vIFoHJMQ5JtzgxYUoEhuA5bai4pe7EQ&usqp=CAU" id="圖片">
</body>
<script type="text/javascript">

window.history.forward(1);

</script>


