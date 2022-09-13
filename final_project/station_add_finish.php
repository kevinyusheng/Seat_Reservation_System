<?php session_start(); ?>
<meta http-equiv="Content_Type" content="text/html;charset=utf-8" />
<?php
include("connection.php");

$station_num = $_POST['station_num'];
$station = $_POST['station'];
$station_ad = $_POST['station_address'];

if ($_SESSION['MNA_ID'] != null) {
    $sql = "INSERT INTO STATION(STATION_NUM, STATION_NAME, STATION_ADDRESS) VALUES('$station_num', '$station', '$station_ad')";
    if (!mysqli_query($con, $sql)) {
        echo '新增失敗！';
        echo 'Errorcode: ' . mysqli_errno($con);
        echo '<meta http-equiv=REFRESH CONTENT=3;url=station.php>';
    }else {
        echo '新增成功！';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=station.php>';
    }
}
?>