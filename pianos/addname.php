<?php
session_start();
include("common.php");

$userid = $_SESSION['userid'];
$gfname = $_POST['fname'];
$glname = $_POST['lname'];
$ffee = $_POST['fee'];
$fstno = $_POST['stno'];
$fstnm = $_POST['stnm'];
$fcity = $_POST['city'];
$fstate = $_POST['state'];
$fzip = $_POST['zip'];

$fphone1 = $_POST['phone1'];
$fphone2 = $_POST['phone2'];
$fphone3 = $_POST['phone3'];
$fphone = $fphone1 . $fphone2 . $fphone3;

$ldate = '';

$date = $_POST['date'];
// convert from american format to data format
       $date1 = substr($date,6,4);
       $date2 = substr($date,0,2);
       $date3 = substr($date,3,2);
       $ndate = $date1 . $date2 . $date3;

$fcomments = $_POST['comments'];
$fcharge = '';
$fpayment = '';
$ftotal = '';

$flandline1 = $_POST['landline1'];
$flandline2 = $_POST['landline2'];
$flandline3 = $_POST['landline3'];
$flandline = $flandline1 . $flandline2 . $flandline3;

$fcell11 = $_POST['cell11'];
$fcell12 = $_POST['cell12'];
$fcell13 = $_POST['cell13'];
$fcell1 = $fcell11 . $fcell12 . $fcell13;

$fcell21 = $_POST['cell21'];
$fcell22 = $_POST['cell22'];
$fcell23 = $_POST['cell23'];
$fcell2 = $fcell21 . $fcell22 . $fcell23;

$femail = $_POST['email'];


try {
// open connection to LOCAL MongoDB server
// $conn = new Mongo('localhost');

// open connection to CLOUD MongoDB server
 $conn = new Mongo("mongodb://pintwister:pitboss1@dbh56.mongolab.com:27567/pianos");

  // access database
  $db = $conn->pianos;

  // access collection
  $collection = $db->names;

  // define a new document with safe insert
  $item = array(
     'userid' => $userid,
     'fname' => $gfname,
     'lname' => $glname,
     'fee' => $ffee,
     'stno' => $fstno,
     'stnm' => $fstnm,
     'city' => $fcity,
     'state' => $fstate,
     'zip' => $fzip,
     'phone' => $fphone,
     'ldate' => $ldate,
     'ndate' => $ndate,
     'comments' => $fcomments,
     'charge' => $fcharge,
     'payment' => $fpayment,
     'total' => $ftotal,
     'landline' => $flandline,
     'cell1' => $fcell1,
     'cell2' => $fcell2,
     'email' => $femail,

 
);
  $options = array("safe" => True);

// insert the new document
   $collection->insert($item,$options);
$_SESSION['forward'] = $item['_id']; 

  // disconnect from server
  $conn->close();
  header("location: viewnames.php");
} catch (MongoConnectionException $e) {
  die('Error connecting to MongoDB server');
} catch (MongoException $e) {
  die('Error: ' . $e->getMessage());
}
?>

