<?php
session_start();

include("connection.php");
function check_login($con)
{

	if(isset($_SESSION['MEM_ID']))
	{
		$id = $_SESSION['MEM_ID'];
		$query = "select * from `member` where MEM_ID = '$id'";

		$result = mysqli_query($con,$query);

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
	}

}

function get_managerdata($con)
{

	if(isset($_SESSION['MNA_ID']))
	{
		$id = $_SESSION['MNA_ID'];
		$query = "select * from `manager` where MNA_ID = '$id'";

		$result = mysqli_query($con,$query);
		//if($result)
		//{

			$mna_data = mysqli_fetch_assoc($result);
			return $mna_data;
		//}
	}

	//redirect to login
	//header("Location: login.php");
	//die;

}

function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}