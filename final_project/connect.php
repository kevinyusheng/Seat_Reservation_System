<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("connection.php");
$id = $_POST['id'];
$pw = $_POST['pw'];
$idy = $_POST['idy'];

if($idy == 'member'){
	$sql = "SELECT * FROM `member` where MEM_ID = '$id'";
}
else{
	$sql = "SELECT * FROM `manager` where MNA_ID = '$id'";
}
 //$sql = "SELECT * FROM `member` where MEM_ID = '$id'";
$result = mysqli_query($con,$sql);
$row = @mysqli_fetch_row($result);
//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if($id != null && $pw != null && $row[5] == $id && $row[6] == $pw)
{
	//將帳號寫入session，方便驗證使用者身份
	$_session['idy'] = $idy;
	echo '登入成功!';
	if($idy == 'member'){
		$_SESSION['MEM_ID'] = $id;
		echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
	}
	else{
		$_SESSION['MNA_ID'] = $id;
		$p = $_SESSION['MNA_ID'];
		echo '<meta http-equiv=REFRESH CONTENT=1;url=manager.php>';
	}
}
else
{
	echo '登入失敗! 請確認帳號密碼!';
	echo '<meta http-equiv=REFRESH CONTENT=1;url=login.php>';
}
?>
