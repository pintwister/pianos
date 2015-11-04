<html>
<head></head>
</body>

<?php
session_start();
include("common.php");

$forward = $_SESSION['forward'];
$_SESSION['forward'] = $forward;
$forward = new MongoId($forward); 
$i = $_SESSION[single];

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
  $criteria = array('_id' => $forward,);
  

// Find single document by ID Variable 
$obj = $collection->findOne($criteria);

// If you wish to delete a single record, you must first edit every field
// and supply them with data that will never be entered in real life.
// The reason for this is that if any field has duplicate data in another record,
// then all of those records will be deleted also.
 
               $sdate1 = '123ypo';
       	   $serv1 = 'xx25yt';
       	   $servamnt1 = 'tyr5';
               $chkno1 = 'tu345z';
               $comment1 = 't120ha';
               $partamnt1 = 'kuy675d';
               $chgno1 = 'jgp45st';

		// Update collection with new document values with SAFE
               $options = array("safe" => True);

               $obj['sdate'] [$i] = $sdate1;
               $obj['serv'] [$i] = $serv1;
               $obj['servamnt'] [$i] = $servamnt1;
               $obj['chkno'] [$i] = $chkno1;
               $obj['comment'] [$i] = $comment1;
               $obj['partamnt'] [$i] = $partamnt1;
               $obj['chgno'] [$i] = $chgno1;

               $collection->save($obj,$options);

// Now you can delete the record updated with the bogus data, and
// you can be assured that there are no other records with field data that
// matches what you have just edited in.

// define variables for Array objects
$sdate = $obj['sdate'] [$i];
$serv = $obj['serv'] [$i];
$servamnt = $obj['servamnt'] [$i];
$chkno = $obj['chkno'] [$i];
$partamnt = $obj['partamnt'] [$i];
$comment = $obj['comment'] [$i];
$chgno = $obj['chgno'] [$i];

 $service = array('sdate' => $sdate, 'serv' => $serv, 'servamnt' => $servamnt, 'chkno' => $chkno, 'partamnt' => $partamnt, 'comment' => $comment, 
 'chgno' => $chgno);

 $upsert = true; 
			$collection->update($obj, array('$pull' => $service) ,array("upsert" => $upsert));


// disconnect from server
  			   $conn->close();

 header("location: viewnames.php");

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

</body></html>