<?php session_start(); ?>
<meta http-equiv="Content_Type" content="text/html; charset=utf-8"/>
<?php
include("connection.php");

$id = $_SESSION['user_id'];
$pw = $_SESSION['pw'];
$Fname = $_SESSION["Fname"];
$Lname = $_SESSION["Lname"];
$email = $_SESSION['email'];
$phone = $_SESSION["phone"];
$idy = $_SESSION["idy"];

if ($idy == "member") {
    $sql = "INSERT INTO `MEMBER`(MEM_ID, MEM_PASSWORD, MEM_FNAME, MEM_LNAME, MEM_EMAIL, MEM_PHONE) 
            VALUES('$id', '$pw', '$Fname', '$Lname', '$email', '$phone')";
}else {
    $sql = "INSERT INTO MANAGER(MNA_ID, MNA_PASSWORD, MNA_FNAME, MNA_LNAME, MNA_EMAIL, MNA_PHONE) 
            VALUES('$id', '$pw', '$Fname', '$Lname', '$email', '$phone')";
}

echo "  $Fname $Lname $id $email $phone $pw $idy";

if (mysqli_query($con, $sql)) {
    echo '註冊成功！';
   // echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
}else {
    echo '註冊失敗！';
    echo 'Errorcode: ' . mysqli_errno($con);
    //echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
}
?>