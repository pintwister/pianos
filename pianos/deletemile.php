<?php
session_start();
include("common.php");

$forward = $_SESSION['forward'];
$_SESSION['forward'] = $forward;

try {
// open connection to LOCAL MongoDB server
// $conn = new Mongo('localhost');

// open connection to CLOUD MongoDB server
 $conn = new Mongo("mongodb://pintwister:pitboss1@dbh56.mongolab.com:27567/pianos");


  // access database
  $db = $conn->pianos;

  // access collection
  $collection = $db->mile;

  // remove a document by ID
  $criteria = array(
    '_id' => new MongoId($forward),
  );
  $options = array("safe" => True);
  $collection->remove($criteria,$options);
  
  // disconnect from server
  $conn->close();
  header("location: mileage.php");
} catch (MongoConnectionException $e) {
  die('Error connecting to MongoDB server');
} catch (MongoException $e) {
  die('Error: ' . $e->getMessage());
}
?>
