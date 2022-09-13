<?php session_start(); ?>
<meta http-equiv="Content_Type" content="text/html;charset=utf-8" />
<?php 
include("connection.php");

$num = $_POST['order_num'];

if ($_SESSION['MNA_ID'] != null) {
    $sql = "UPDATE `ORDER` SET ORDER_STATE = 2 WHERE ORDER_NUM = '$num'";
    if (!mysqli_query($con, $sql)) {
        echo '取消失敗！';
        echo 'Errorcode: ' . mysqli_errno($con);
        echo '<meta http-equiv=REFRESH CONTENT=3;url=view_order.php>';
    }else {
        echo '取消成功！';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=view_order.php>';
    }
}?>