<?php
session_start();
include("common.php");

$userid = $_SESSION['userid'];
$fstart = $_POST['start'];
$fend = $_POST['end'];
$fexpl = $_POST['expl'];
$ftot = $fend-$fstart;

$date = $_POST['date'];
// convert from american format to data format
       $date1 = substr($date,6,4);
       $date2 = substr($date,0,2);
       $date3 = substr($date,3,2);
       $date = $date1 . $date2 . $date3;

try {
// open connection to LOCAL MongoDB server
// $conn = new Mongo('localhost');

// open connection to CLOUD MongoDB server
 $conn = new Mongo("mongodb://pintwister:pitboss1@dbh56.mongolab.com:27567/pianos");

  // access database
  $db = $conn->pianos;

  // access collection
  $collection = $db->mile;

  // define a new document with safe insert
  $item = array(
     'userid' => $userid,
     'ldate' => $date,
     'start' => $fstart,
     'end' => $fend,
     'tot' => $ftot,
     'expl' => $fexpl,
);
    
  $options = array("safe" => True);

// insert the new document
  $collection->insert($item,$options);

  // disconnect from server
  $conn->close();
  header("location: mileage.php");
 } catch (MongoConnectionException $e) {
   die('Error connecting to MongoDB server');
 } catch (MongoException $e) {
  die('Error: ' . $e->getMessage());
 }
?>

