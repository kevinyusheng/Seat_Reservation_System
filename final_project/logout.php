<?php

session_start();

if(isset($_SESSION['MEM_ID']))
{
	unset($_SESSION['MEM_ID']);

}

if(isset($_SESSION['MNA_ID']))
{
	unset($_SESSION['MNA_ID']);

}
header("Location: login.php");
die;