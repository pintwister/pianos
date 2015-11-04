<?php
session_start();
include("common.php");


// get ID from precious page
$forward = $_SESSION['forward'];
$_SESSION['forward'] = $forward;
$forward = new MongoId($forward); 
$i = $_SESSION['single'];
$_SESSION['single'] = $i;

try {

// open connection to LOCAL MongoDB server
// $conn = new Mongo('localhost');

// open connection to CLOUD MongoDB server
 $conn = new Mongo("mongodb://pintwister:pitboss1@dbh56.mongolab.com:27567/pianos");

  // access database
  $db = $conn->pianos;

  // access collection
  $collection = $db->names;

  // Store ID field to variable 
  $criteria = array(
    '_id' => $forward,
  );

// Find single document by ID Variable 
$obj = $collection->findOne($criteria);

		// update document with new values
		// save back to collection

		
 		// Store form data to variables
               $sdate = $_POST['date'];
       	   $serv = $_POST['serv'];
       	   $servamnt = $_POST['servamnt'];
               $chkno = $_POST['chkno'];
               $partamnt = $_POST['partamnt'];
               $comment = $_POST['comment'];
               $servamnt = number_format($servamnt,2);
               $partamnt = number_format($partamnt,2);


// convert from american format to data format
       $date1 = substr($sdate,6,4);
       $date2 = substr($sdate,0,2);
       $date3 = substr($sdate,3,2);
       $sdate = $date1 . $date2 . $date3;

		// Update collection with new document values with SAFE
               $options = array("safe" => True);

               $obj['sdate'] [$i] = $sdate;
               $obj['serv'] [$i] = $serv;
               $obj['servamnt'] [$i] = $servamnt;
               $obj['chkno'] [$i] = $chkno;
               $obj['partamnt'] [$i] = $partamnt;
               $obj['comment'] [$i] = $comment;

             $collection->save($obj,$options);
  header("location: viewservice.php");

                 // disconnect from server
  			   $conn->close();
			}  
                     catch (MongoConnectionException $e)
                  {
  					die('Error connecting to MongoDB server');
			}  
                     catch (MongoException $e)
                  {
  			   die('Error: ' . $e->getMessage());
			}

?>
