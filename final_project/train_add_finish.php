<?php session_start(); ?>
<meta http-equiv="Content_Type" content="text/html;charset=utf-8" />
<?php 
include("connection.php");

$train_num = $_POST['train_num'];
$train_date = $_POST['train_date'];
$stop = $_POST['checkbox'];
$time = $_POST['time'];
$dir = $_POST['dir'];
if ($_SESSION['MNA_ID'] != null) {
    $sql = "INSERT INTO `TRAIN` (`TRAIN_NUM`, `TRAIN_DATE`, TRAIN_DIR) VALUES ('$train_num', '$train_date', '$dir')";
    mysqli_query($con, $sql);
    for ($i = 0; $i < sizeof($stop); $i++) {
        $sql = "INSERT INTO `STOP` (`TRAIN_NUM`, `STATION_NUM`, `STOP_TIME`) VALUES ('$train_num', '$stop[$i]', '$time[$i]')";
        mysqli_query($con, $sql);
    }
    echo '新增成功！';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=train.php>';
}
?>