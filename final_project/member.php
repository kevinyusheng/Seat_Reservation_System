<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
include("connection.php");
include("functions.php");
echo'<a href="logout.php">登出</a><br><br>';
//此判斷為判定觀看此頁有沒有權限
//說不定是路人或不相關的使用者
//因此要給予排除
if($_SESSION['cus_id'] != null)
{
    echo'<a href="regiser.php">新增</a><br>';
    echo'<a href="updata.php">修改</a><br>';
    echo'<a href="delete.php">刪除</a><br><br>';
    $id = $_SESSION['cus_id'];
    //將資料庫裡的所有會員資料顯示在畫面上
    $sql = "SELECT * FROM customers WHERE cus_id = '$id'";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_row($result))
    {
        echo "$row[0] - cus_id : $row[1]<br>".
        "Firstname : $row[2]<br>"."Lastname : $row[3]<br>"."password : $row[4]<br>".
        "email : $row[5]<br>"."phone : $row[6]<br>";
    }
    $user_data = check_login($con);
   
}
else
{
    echo '您無權限觀看此頁面!';
	echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
}
?>
<html>
    <head>
        cus_id: <?php echo $user_data['cus_id'];?>
    </head>

</html>