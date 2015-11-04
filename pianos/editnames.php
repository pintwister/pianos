<?php
session_start();
include("common.php");

// get ID from precious page
$forward = $_SESSION['forward'];
$_SESSION['forward'] = $forward;
$forward = new MongoId($forward); 
$ndate = $_POST['ndate'];

// convert from american format to data format
       $date1 = substr($ndate,6,4);
       $date2 = substr($ndate,0,2);
       $date3 = substr($ndate,3,2);
       $ndate = $date1 . $date2 . $date3;

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
		   $gfname = $_POST['fname'];
               $glname = $_POST['lname'];
		   $ffee = $_POST['fee'];
               $fstno = $_POST['stno'];
               $fstnm = $_POST['stnm'];
               $fcity = $_POST['city'];
               $fstate = $_POST['state'];
               $fzip = $_POST['zip'];
               
               $fphone = $_POST['phone1'] . $_POST['phone2'] . $_POST['phone3'];
               $flandline = $_POST['landline1'] . $_POST['landline2'] . $_POST['landline3'];
               $fcell1 = $_POST['cell11'] . $_POST['cell12'] . $_POST['cell13'];
               $fcell2 = $_POST['cell21'] . $_POST['cell22'] . $_POST['cell23'];

               $femail = $_POST['email'];
               $fcomments = $_POST['comments'];

		// Update collection with new document values with SAFE
               $options = array("safe" => True);
               $obj['fname'] = $gfname;
               $obj['lname'] = $glname;
               $obj['fee'] = $ffee;
               $obj['stno'] = $fstno;
               $obj['stnm'] = $fstnm;
               $obj['city'] = $fcity;
               $obj['state'] = $fstate;
               $obj['zip'] = $fzip;
               $obj['ndate'] = $ndate;
               $obj['phone'] = $fphone;
               $obj['landline'] = $flandline;
               $obj['cell1'] = $fcell1;
               $obj['cell2'] = $fcell2;

               $obj['email'] = $femail;
               $obj['comments'] = $fcomments;

               $collection->save($obj,$options);
   		   header("location: viewnames.php");

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