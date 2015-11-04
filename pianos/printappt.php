<?php
session_start();
include("common.php");

session_cache_limiter('none'); 

$admin = $_SESSION['admin'];
$userid = $_SESSION['userid'];
$user = $_SESSION['name'];

$date1 = $_SESSION['date1'];
$date1head = $date1;
// convert from american format to data format
       $date1a = substr($date1,6,4);
       $date2a = substr($date1,0,2);
       $date3a = substr($date1,3,2);
       $date1 = $date1a . $date2a . $date3a;

$date2 = $_SESSION['date2'];
$date2head = $date2;
// convert from american format to data format
       $date1b = substr($date2,6,4);
       $date2b = substr($date2,0,2);
       $date3b = substr($date2,3,2);
       $date2 = $date1b . $date2b . $date3b;

$totalmiles = 0;
$tot = 0;
$extra = '.';
$spacer = "";

// ********************* START ***************************
error_reporting(E_ALL);                           // include PDF class and set error reporting
include('class.ezpdf.php'); 
$pdf =& new Cezpdf('LETTER','portrait');          // create PDF doc and select font
$pdf->selectFont('./fonts/Helvetica'); 
$ypos = 740;
// ********************* END ***************************

$headldate = 'Last Entry:';
$headndate = 'Next Appt:';
$headphone = 'Phone:';
$headname = 'Name:';                               // variables for page header
$headcity = 'City:';

//************************* START ***************************************

$ypos = $ypos;

$pdf->ezsetY($ypos); 
$pdf->ezSetMargins(0,0,70,0); 
$pdf->ezText('Appointments Through' . ' ' . $date2head,10);

$ypos = $ypos-30;

$pdf->ezsetY($ypos);                                 
$pdf->ezSetMargins(0,0,70,0);                     // print page header
$pdf->ezText($headldate,10);

$pdf->ezsetY($ypos);                                 
$pdf->ezSetMargins(0,0,142,0);
$pdf->ezText($headndate,10);

$pdf->ezsetY($ypos);                                 
$pdf->ezSetMargins(0,0,215,0);
$pdf->ezText($headphone,10);

$pdf->ezsetY($ypos);                                 
$pdf->ezSetMargins(0,0,315,0);
$pdf->ezText($headcity,10);

$pdf->ezsetY($ypos);                                 
$pdf->ezSetMargins(0,0,419,0);
$pdf->ezText($headname,10);

$ypos = $ypos-20;                    
// ************************ END ***************************

try {

// open connection to LOCAL MongoDB server
// $conn = new Mongo('localhost');

// open connection to CLOUD MongoDB server
 $conn = new Mongo("mongodb://pintwister:pitboss1@dbh56.mongolab.com:27567/pianos");

// access database
  $db = $conn->pianos;

// access collection                          
  $collection = $db->names;

// formulate AND query
  $criteria = array(
  ' ' => $a,
  
  );
  
// retrieve fields
  $fields = array('_ID', 'userid', 'admin', 'ldate', 'ndate', 'fname', 'lname', 'fee', 'phone', 'city');
  
// execute query
  $cursor = $collection->find($criteria,$fields);
  $cursor->sort(array('lname' => 1, 'fname' => 1));
 
// iterate through the result set
  // print each document

foreach ($cursor as $obj)
	{
if($obj['userid'] == $userid OR $admin == 1 ):
if($obj['ndate'] >= $date1 && $obj['ndate'] <= $date2 && $obj['ndate'] > 0): 

      $counter = $counter+1;
      $ldate = $obj['ldate'];
      $ndate = $obj['ndate'];
      $fname = $obj['fname'];
      $lname = $obj['lname'];
      $phone = $obj['phone'];
      $city  = $obj['city'];
      $fee = $obj['fee'];
      $name = $fname . ' ' . $lname . ' ' . $fee;
      

// set up from data format to american format
      $date1a = substr($ldate,4,2);
      $date2a = substr($ldate,6,2);
      $date3a = substr($ldate,0,4);
      $ldate = $date1a . '/' . $date2a . '/' . $date3a;

// set up from data format to american format
      $date1b = substr($ndate,4,2);
      $date2b = substr($ndate,6,2);
      $date3b = substr($ndate,0,4);
      $ndate = $date1b . '/' . $date2b . '/' . $date3b;


$phone = '(' . substr($phone,0,3) . ') ' . substr($phone,3,3) . '-' . substr($phone,6,4);
 
// ************************* START ************************************ 
    
$pdf->ezsetY($ypos); 
$pdf->ezSetMargins(0,0,0,570);                                                                      
$pdf->ezText($counter,10,array('justification'=>"right"));              
                  
$pdf->ezsetY($ypos);
$pdf->ezSetMargins(0,0,70,0);                                     
$pdf->ezText($ldate,10);
                                                                      // print the data
$pdf->ezsetY($ypos);
$pdf->ezSetMargins(0,0,142,0);                                     
$pdf->ezText($ndate,10);

$pdf->ezsetY($ypos);
$pdf->ezSetMargins(0,0,215,0);
$pdf->ezText($phone,10);

$pdf->ezsetY($ypos);
$pdf->ezSetMargins(0,0,315,0);                                     
$pdf->ezText($city,10);

$pdf->ezsetY($ypos);
$pdf->ezSetMargins(0,0,419,0);                                     
$pdf->ezText($name,10);


$ypos = $ypos-15;
// ************************** END ***********************************

endif;
endif;

//**************************** START ********************************
if($ypos < 49)                           // Allow for margin at bottom of page     
        {
  $pdf->ezsetY($ypos-1);
  $pdf->setColor(0,0,0);                                 
  $pdf->ezSetMargins(0,0,0,0);
  $pdf->ezText($extra);
  $pdf->setColor(0,0,0);                                           
$ypos = 755;
$pdf->ezNewPage();                      // Start new page
        }
//*************************** END ********************************

}  // end foreach

  $pdf->ezsetY($ypos-1);
  $pdf->setColor(0,0,0);                                 
  $pdf->ezSetMargins(0,0,0,0);
  $pdf->ezText($extra);
  
//****************************** START *****************************
$pdf->ezStream();                      // Create PDF 
//******************************** END ***************************

// disconnect from server
  $conn->close();
} catch (MongoConnectionException $e) {
  die('Error connecting to MongoDB server');          // close database
} catch (MongoException $e) {
  die('Error: ' . $e->getMessage());
}
?>


