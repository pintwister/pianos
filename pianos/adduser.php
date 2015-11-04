<?php
session_start();
include("common.php");

$counter = 0;
$newcount = 0;
$count2 = 0;

$ffirstname = $_POST['firstname'];
$flastname = $_POST['lastname'];
$fusername = $_POST['username'];
$fpassword = $_POST['password'];
$ftype = $_POST['admin'];

try {
// open connection to LOCAL MongoDB server
// $conn = new Mongo('localhost');

// open connection to CLOUD MongoDB server
 $conn = new Mongo("mongodb://pintwister:pitboss1@dbh56.mongolab.com:27567/pianos");


  // access database
  $db = $conn->pianos;

  // access collection
  $collection = $db->users;

  $cursor = $collection->find();

  // iterate through the result set
  foreach ($cursor as $obj) {
$counter = $obj['id'];
// echo 'ID ' , $counter . ' ' , $count2 . '<br>';


if($counter >= $count2):
$count2 = $counter+1;
$newcount = $count2;
endif;


 }


echo 'Count to carry over is ... ' . $newcount; 

// define a new document with safe insert
  $item = array(
     'id' => $newcount,
     'username' => $fusername,
     'password' => $fpassword,
     'admin' => $ftype,
     'firstname' => $ffirstname,
     'lastname' => $flastname,
     
 );
    
  $options = array("safe" => True);

// insert the new document
  $collection->insert($item,$options);

  // disconnect from server
  $conn->close();



 header("location: admin.php");

} catch (MongoConnectionException $e) {
  die('Error connecting to MongoDB server');
} catch (MongoException $e) {
  die('Error: ' . $e->getMessage());
}
?>
