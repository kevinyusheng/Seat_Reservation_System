<?php session_start(); ?>
<meta http-equiv="Content_Type" content="text/html;charset=utf-8" />
<?php
include("connection.php");

$recover_train = $_POST['train_num'];
if($_SESSION['MNA_ID'] != null) {
    $sql = "UPDATE TRAIN SET TRAIN_STATE = 1 WHERE TRAIN_NUM = '$recover_train'";
    if (!mysqli_query($con, $sql)) {
        echo '失敗！';
        echo 'Errorcode: ' . mysqli_errno($con);
        echo '<meta http-equiv=REFRESH CONTENT=3;url=train.php>';
    }else {
        echo '成功！';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=train.php>';
    }
}
?>