
<?php
session_start();
include("common.php");

$date = $_POST['date'];

// convert from american format to data format
       $date1 = substr($date,6,4);
       $date2 = substr($date,0,2);
       $date3 = substr($date,3,2);
       $fsdate = $date1 . $date2 . $date3;

$fserv = $_POST['serv'];
$fpartamnt = $_POST['partamnt'];
       $fpartamnt = number_format($fpartamnt,2);
$fchkno = 'Charge';
$fcomment = $_POST['comment'];
$fchgno = '1';

// get ID from precious page

$forward = $_SESSION['forward'];
$_SESSION['forward'] = $forward;
$forward = new MongoId($forward); 

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
  $criteria = array('_id' => $forward);
 
$service = array('sdate' => $fsdate, 'serv' => $fserv, 'chkno' => $fchkno, 'servamnt' => $servamnt, 'partamnt' => $fpartamnt, 'comment' => $fcomment, 'chgno' => $fchgno);

// Find single document by ID Variable 
$obj = $collection->findOne($criteria);

$upsert = true; 
			$collection->update($obj, array('$push' => $service), array("upsert" => $upsert));

// disconnect from server
  			   $conn->close();


// open connection to MongoDB server
//  $conn = new Mongo('localhost');

// open connection to CLOUD MongoDB server
 $conn = new Mongo("mongodb://pintwister:pitboss1@dbh56.mongolab.com:27567/pianos");


  // access database
  $db = $conn->pianos;

  // access collection
  $collection = $db->names;

  // Store ID field to variable 
  $criteria = array('_id' => $forward);

// Find single document by ID Variable 
$obj = $collection->findOne($criteria);


$options = array("safe" => True);
$charge = $obj['charge'];
$total = $obj['total'];
$charge = ereg_replace(',','', $charge);
$total = ereg_replace(',','', $total);
$fpartamnt = ereg_replace(',','', $fpartamnt);
$total = $total + $fpartamnt;
$charge = $charge + $fpartamnt;
$charge = number_format($charge,2);
$total = number_format($total,2);
$fpartamnt = number_format($fpartamnt,2);


$obj['ldate'] = $fsdate;
$obj['charge'] = $charge;
$obj['total'] = $total;


$collection->save($obj,$options);


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
		
