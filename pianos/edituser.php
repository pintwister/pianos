<html><head></head>
<body>

<?php
session_start();
include("common.php");

$user = $_SESSION['name'];


// get ID from precious page
$forward = $_SESSION['forward'];
$_SESSION['forward'] = $forward;
$forward = new MongoId($forward); 

$username = $_POST['username'];
$password = $_POST['password'];
$admin = $_POST['admin'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

// open connection to LOCAL MongoDB server
// $conn = new Mongo('localhost');

// open connection to CLOUD MongoDB server
 $conn = new Mongo("mongodb://pintwister:pitboss1@dbh56.mongolab.com:27567/pianos");

  // access database
  $db = $conn->pianos;

  // access collection
  $collection = $db->users;

  // Store ID field to variable 
  $criteria = array(
    '_id' => $forward,
  );

// Find single document by ID Variable 
$obj = $collection->findOne($criteria);
 

		// update document with new values
		// save back to collection

		
 		// Store form data to variables
		   $firstname = $_POST['firstname'];
               $lastname = $_POST['lastname'];
	         $username = $_POST['username'];
               $password = $_POST['password'];
               $admin = $_POST['admin'];
               		   

		// Update collection with new document values with SAFE
               $options = array("safe" => True);
		   $obj['firstname'] = $firstname;
               $obj['lastname'] = $lastname;
               $obj['username'] = $username;
               $obj['password'] = $password;
               $obj['admin'] = $admin;
          
               

               $collection->save($obj,$options);
		
			// disconnect from server
  			   $conn->close();
			


		
		
		header("location: viewuser.php");
            
?>		