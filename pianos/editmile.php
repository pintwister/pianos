
<?php
session_start();
include("common.php");


// get ID from precious page
$forward = $_SESSION['forward'];
$_SESSION['forward'] = $forward;
$forward = new MongoId($forward);
 
$date = $_POST['date'];
$start = $_POST['start'];
$end = $_POST['end'];
$expl = $_POST['expl'];
$tot = $end-$start;


try {


// open connection to LOCAL MongoDB server
// $conn = new Mongo('localhost');

// open connection to CLOUD MongoDB server
 $conn = new Mongo("mongodb://pintwister:pitboss1@dbh56.mongolab.com:27567/pianos");

  // access database
  $db = $conn->pianos;

  // access collection
  $collection = $db->mile;

  // Store ID field to variable 
  $criteria = array(
    '_id' => $forward,
  );

// Find single document by ID Variable 
$obj = $collection->findOne($criteria);

// convert from american format to data format
       $date1 = substr($date,6,4);
       $date2 = substr($date,0,2);
       $date3 = substr($date,3,2);
       $date = $date1 . $date2 . $date3;

		// Update collection with new document values with SAFE
               $options = array("safe" => True);
               $obj['ldate'] = $date;
               $obj['start'] = $start;
               $obj['end'] = $end;
               $obj['tot'] = $tot;
               $obj['expl'] = $expl;



 $collection->save($obj,$options);
		header("location: viewmile.php");

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


		