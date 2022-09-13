<?php session_start(); ?>
<meta http-equiv="Content_Type" content="text/html;charset=utf-8" />
<?php
include("connection.php");

if ($_SESSION["MNA_ID"] != null) {
    $station_num = $_POST['station_num'];
    $station_name = $_POST['station_name'];
    $sql_check = "SELECT COUNT(*) FROM STOP WHERE STATION_NUM = '$station_num'";
    $result_check = mysqli_query($con, $sql_check);
    $check = mysqli_fetch_row($result_check)[0];
    if ($check == 0) {
        $sql = "DELETE FROM STATION WHERE STATION_NUM = '$station_num'";
        #$sql2 = "UPDATE TRAIN SET TRAIN_STATE = 0 WHERE TRAIN_NUM IN (SELECT TRAIN_NUM FROM STOP WHERE STATION_NUM = '$station_num')";
        if (!mysqli_query($con, $sql)) {
            echo '刪除失敗！';
            echo 'Errorcode: ' . mysqli_errno($con);
            echo '<meta http-equiv=REFRESH CONTENT=2;url=station.php>';
        }else {
            echo '刪除成功！';
            echo '<meta http-equiv=REFRESH CONTENT=1;url=station.php>';
        }
    } else {
        echo '無法刪除', $station_name, '站，已有列車停靠！';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=station.php>';
    }
}