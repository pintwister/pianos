<?php
session_start();

// open connection to LOCAL MongoDB server
// $conn = new Mongo('localhost');

// open connection to CLOUD MongoDB server
 $conn = new Mongo("mongodb://pintwister:pitboss1@dbh56.mongolab.com:27567/pianos");

// access database
$db = $conn->pianos;

// access collection
$collection = $db->users;

	
	$username = $_POST['username'];
	$password = $_POST['password'];



// Store ID field to variable 
  $criteria = array('username' => $username,);

// Find single document by ID Variable 
$obj = $collection->findOne($criteria);

if($username <> $obj['username'] OR $username <= ''):
header("Location: loginform.php");
endif;

if($password == $obj['password'] AND $password > ' '): 

$username = $obj['username'];
$password = $obj['password'];
$admin = $obj['admin'];
$firstname = $obj['firstname'];
$userid = $obj['id'];

			$_SESSION['PHPSESSID'] = "ok";
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
                  $_SESSION['userid'] = $userid;
                  $_SESSION['admin'] = $admin;
                  $_SESSION['name'] = $firstname;
header("Location: admin.php");
else:
header("Location: loginform.php");

endif;


// disconnect from MONGO server
$conn->close();

?>

