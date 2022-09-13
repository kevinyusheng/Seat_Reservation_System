<?php

include "mysql_connect.inc.php";
$order_num = $_GET["order_num"];
$pay = $_GET["pay"];
$order = $_GET["order"];
$mem = $_GET["mem"];
if($pay == 1 or $pay == 2){
    $sql = "UPDATE `ticket` SET TICKET_STATE = 2 WHERE ORDER_NUM = '$order'";
    $mysqli->query($sql);
    echo '訂票完成!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}else if($pay == 3){
    echo '訂票完成!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}else if($pay == 4){
    echo "取消訂單-". $order_num;
    $sql = "UPDATE `order` SET ORDER_STATE = 2 WHERE ORDER_NUM = '$order_num'";
    $mysqli->query($sql);
    echo '<meta http-equiv=REFRESH CONTENT=2;url=order_member.php?mem=',$mem,'>';
}

?>