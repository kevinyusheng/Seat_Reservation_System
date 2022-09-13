<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$idErr = $pwErr = $pw2Err = $fnameErr = $lnameErr = $emailErr = $phoneErr = $idyErr = "";
	$id = $pw = $Fname = $Lname = $email = $phone = "";
	$check = 0;

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	function test_name($name) {
		if (preg_match("/^[a-zA-Z-']*$/", $name)) {
			return false;
		}else {
			return true;
		}
	}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	//something was posted
		$Lname = $_POST['Lname'];
		$Fname = $_POST['Fname'];
		$pw = $_POST['pw'];
		$pw2 = $_POST['pw2'];
		$user_id = $_POST['user_id'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$idy = $_POST['idy'];
	//檢查是否符合限制
		if (empty($_POST["user_id"])) {
			$idErr = "UserID is required";
		}else {
			$_SESSION["user_id"] = test_input($_POST["user_id"]);
			$check += 1;
		}

		if (empty($_POST["pw"])) {
			$pwErr = "Password is required";
		}else {
			$_SESSION["pw"] = test_input($_POST["pw"]);
			$check += 1;
		}
		if (empty($_POST["pw2"])) {
			$pw2Err = "Please repeat passowrd again";
			$pw = "";
			$check = 0;
		} 
		if ($_POST["pw"] != $_POST["pw2"]) {
			$pw2Err = "Password repeated wrong";
			$pw = "";
			$check = 0;
		}

		if (empty($_POST["Fname"])) {
			$fnameErr = "First name is required";
		}elseif (test_name($_POST["Fname"])) {
			$fnameErr = "Only letters and hyphen allowed";
			$Fname = "";
		}else {
			$_SESSION["Fname"] = test_input($_POST["Fname"]);
			$check += 1;
		}

		if (empty($_POST["Lname"])) {
			$lnameErr = "Last name is required";
		}elseif (test_name($_POST["Lname"])) {
			$lnameErr = "Only letters and hyphen allowed";
			$Lname = "";
		}else {
			$_SESSION["Lname"] = test_input($_POST["Lname"]);
			$check += 1;
		}

		if (empty($_POST["email"])) {
			$emailErr = "Email is required";
		}elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
			#echo $_POST["email"];
			$emailErr = "Invalid email format";
			$email = "";
		}else {
			$_SESSION["email"] = test_input($_POST["email"]);
			$check += 1;
		}

		if (empty($_POST["phone"])) {
			$phoneErr = "Phone is required";
		}else {
			$_SESSION["phone"] = test_input($_POST["phone"]);
			$check += 1;
		}

		if (empty($_POST["idy"])) {
			$idyErr = "Please select your identity";
		}elseif ($_POST["idy"]=='manager' && strpos($_POST["email"], '@thsr.com')==false) {
			$idyErr = "You cannot register as manager without a THRC email";
		}else {
			$_SESSION["idy"] = test_input($_POST["idy"]);
			$check += 1;
		}

	if($check == 7){
		if($idy == "member")
			{
				$query = "INSERT INTO `member` (MEM_LNAME, MEM_FNAME, MEM_ID, MEM_PASSWORD, MEM_EMAIL, MEM_PHONE) VALUES ('$Lname','$Fname','$user_id', '$pw', '$email', '$phone')";
			}
		else
			{
				$query = "INSERT INTO manager (MNA_LNAME, MNA_FNAME, MNA_ID, MNA_PASSWORD, MNA_EMAIL, MNA_PHONE)  VALUES ('$Lname','$Fname','$user_id', '$pw', '$email', '$phone')"; 
			}

		if(mysqli_query($con, $query))
			{
				echo "註冊成功!";
				echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
			}
		else
			{
				echo '註冊失敗!';
				echo '<meta http-equiv=REFRESH CONTENT=5;url=signup.php>';
			}

			//echo '<meta http-equiv=REFRESH CONTENT=0;url=register_finish.php>';
		}
	/*		
	else{
		echo '不符和限制，請在試一次!';
		echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
		}*/
}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<head>
	<title>Signup</title>
</head>
<body>

<style type="text/css">
	#text{

		height: 50px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 591px;
	}
	#button{

		padding: 10px;
		width: 100%;
		color: white;
		background-color: #ff8c00;
		border: none;
	}
	#backbutton{
        padding: 10px;
		width: 150px;
		color: white;
		background-color: #666;
		border: none;
    }
	#box{
		background-color: grey;
		margin: auto;
		width: 600px;
		height: 650px;
		padding: 30px;
		border-radius: 8px;
	}
</style>
<style>
  	.button {
    	padding: 10px 20px;
    	font-size: 20px;
    	text-align: center;
    	cursor: pointer;
    	outline: none;
    	color: #fff;
    	background-color: grey;
    	border: none;
    	border-radius: 15px;
    	box-shadow: 0 5px #999;
  	}
  	.button:hover {background-color: #3e8e41}

  	.button:active {
    	background-color: #3e8e41;
    	box-shadow: 0 5px #666;
    	transform: translateY(4px);
  	}
</style>
<style>
	.error {color: #FF0000;}
</style>

	<div id="box">
		<button class="button" id="backbutton" onclick="javascript:history.back();" value="返回到上一個頁面"><i class="fa fa-arrow-left" aria-hidden="true"></i> 回上一頁</button>
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Signup</div>
			<p><span class = "error">* required</span></p>
			<form name="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<input id="text" type="text" name="Lname" placeholder = "姓氏" value="<?php echo $fname?>"><span class="error">* <?php echo $fnameErr;?></span>
			<input id="text" type="text" name="Fname" placeholder = "名字" value="<?php echo $lname?>"><span class="error">* <?php echo $lnameErr;?></span><br><br>
			<input id="text" type="text" maxlength="10" placeholder="身分證字號" name="user_id" value="<?php echo $id?>"><span class="error">* <?php echo $idErr;?></span><br><br>
			<input id="text" type="email" name="email"  placeholder = "name@example.com" value="<?php echo $email?>"><span class="error">* <?php echo $emailErr;?></span><br><br>
			<input id="text" type="text" name="phone" placeholder="電話號碼" value="<?php echo $phone?>"><span class="error">* <?php echo $phoneErr;?></span><br><br>
			<input id="text" type="password" name="pw" autocomplete="off" placeholder="密碼" value="<?php echo $pw?>"><span class="error">* <?php echo $pwErr;?></span>
			<input id="text" type="password" name="pw2" autocomplete="off" placeholder="確認密碼" value="<?php echo $pw2?>"><span class="error">* <?php echo $pw2Err;?></span><br><br>
			Identity:
    		<input type="radio" name="idy" value="member">Member
    		<input type="radio" name="idy" value="manager">Manager
    		<span class="error">* <?php echo $idyErr;?></span><br><br>

			<input class="button" id="button" type="submit" value="Signup"><br><br>
		</form>
	</div>
</body>
</html>