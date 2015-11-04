<?php
session_start();

			
			$_SESSION['PHPSESSID'] = "ok";
			$_SESSION['username'] = 'pintwister';
			$_SESSION['password'] = 'pitboss';
                $_SESSION['userid'] = 2;
                $_SESSION['admin'] = 0;
                $_SESSION['name'] = 'Bob';
			header("Location: admin.php");

		
?>

