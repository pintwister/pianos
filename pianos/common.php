<?php
	session_start();

date_default_timezone_set("America/Detroit");

	if(!isset($_SESSION['PHPSESSID']))
{
		header("location: login.php");
}
?>
