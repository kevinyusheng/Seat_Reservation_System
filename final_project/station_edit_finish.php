<?php session_start(); ?>
<meta http-equiv="Content_Type" content="text/html;charset=utf-8" />
<?php
include("connection.php");

if ($_SESSION['MNA_ID'] != null) {
    $station_num = $_POST['station_num'];
    $new_name = $_POST['new_name'];
    $new_ad = $_POST['new_address'];
    $sql = "UPDATE STATION SET STATION_NAME = '$new_name', STATION_ADDRESS = '$new_ad' WHERE STATION_NUM = '$station_num'";
    if (!mysqli_query($con, $sql)) {
        echo '編輯失敗！';
        echo 'Errorcode: ' . mysqli_errno($con);
        echo '<meta http-equiv=REFRESH CONTENT=3;url=station.php>';
    }else {
        echo '編輯成功！';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=station.php>';
    }
}
?>