<?php
session_start();
include("common.php");

session_cache_limiter('none'); 

$admin = $_SESSION['admin'];
$userid = $_SESSION['userid'];
$user = $_SESSION['name'];

$sdate = $_SESSION['date1'];
// convert from american format to data format
       $date1a = substr($sdate,6,4);
       $date2a = substr($sdate,0,2);
       $date3a = substr($sdate,3,2);
       $sdate1 = $date1a . $date2a . $date3a;

$edate = $_SESSION['date2'];
// convert from american format to data format
       $date1b = substr($edate,6,4);
       $date2b = substr($edate,0,2);
       $date3b = substr($edate,3,2);
       $edate1 = $date1b . $date2b . $date3b;

$totalmiles = 0;
$tot = 0;


// ********************* START ***************************
error_reporting(E_ALL);                           // include PDF class and set error reporting
include('class.ezpdf.php'); 
$pdf =& new Cezpdf('LETTER','portrait');          // create PDF doc and select font
$pdf->selectFont('./fonts/Helvetica'); 
$ypos = 740;
// ********************* END ***************************

$headDate = 'Date:';
$headStart = 'Start:';
$headEnd = 'End:';                               // variables for page header
$headTotal = 'Total:';
$headExpl = 'Explaination:';
$uline = '______________________________________________________________________________________';

$TextHead = 'Mileage Begining  ' . $sdate . '  Ending  ' . $edate;

//************************* START ***************************************
$pdf->ezsetY($ypos); 
$pdf->ezSetMargins(0,0,70,0);
$pdf->ezText($TextHead,10);

$ypos = $ypos-25;

$pdf->ezsetY($ypos);                                 
$pdf->ezSetMargins(0,0,70,0);                     // print page header
$pdf->ezText($headDate,10);

$pdf->ezsetY($ypos);                                 
$pdf->ezSetMargins(0,0,172,0);
$pdf->ezText($headStart,10);

$pdf->ezsetY($ypos);                                 
$pdf->ezSetMargins(0,0,260,0);
$pdf->ezText($headEnd,10);

$pdf->ezsetY($ypos);                                 
$pdf->ezSetMargins(0,0,338,0);
$pdf->ezText($headTotal,10);

$pdf->ezsetY($ypos);                                 
$pdf->ezSetMargins(0,0,419,0);
$pdf->ezText($headExpl,10);

$ypos = $ypos-1;

$pdf->ezsetY($ypos);
$pdf->ezSetMargins(0,0,70,0);
$pdf->ezText($uline,10);

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
  $collection = $db->mile;

// formulate AND query
  $criteria = array(
  ' ' => $a,
  
  );
  
// retrieve fields
  $fields = array('_ID', 'userid', 'ldate', 'start', 'end', 'tot', 'expl');
  
// execute query
  $cursor = $collection->find($criteria,$fields);
 
// iterate through the result set
// print each document
   
foreach ($cursor as $obj)
{
      $ldate = $obj['ldate'];
      $jdate = $obj['ldate'];
      $smonth = substr($ldate,4,2);
      $sday = substr($ldate,6,2);
      $syear = substr($ldate,0,4);
      $ldate = $smonth . '/' . $sday . '/' . $syear;
      $start = $obj['start'];
      $end = $obj['end'];
      $tot = $obj['tot'];
      $expl = $obj['expl'];
      


if($obj['userid'] == $userid OR $admin == 1):

if($jdate >= $sdate1  && $jdate <= $edate1):
    
$totalmiles = $totalmiles + $tot;

// ************************* START ************************************       
$pdf->ezsetY($ypos); 
$pdf->ezSetMargins(0,0,70,0);                                                                      
$pdf->ezText($ldate,10);
                  
$pdf->ezsetY($ypos);
$pdf->ezSetMargins(0,0,0,417);                                     
$pdf->ezText($start,10,array('justification'=>"right"));
                                                                      // print the data
$pdf->ezsetY($ypos);
$pdf->ezSetMargins(0,0,0,332);                                     
$pdf->ezText($end,10,array('justification'=>"right"));

$pdf->ezsetY($ypos);
$pdf->ezSetMargins(0,0,0,250);
$pdf->ezText($tot,10,array('justification'=>"right"));

$pdf->ezsetY($ypos);
$pdf->ezSetMargins(0,0,420,0);                                     
$pdf->ezText($expl,10);

$ypos = $ypos-15;
// ************************** END ***********************************

endif;
endif;

//**************************** START ********************************
if($ypos < 49)                           // Allow for margin at bottom of page     
        {
$ypos = 755;
$pdf->ezNewPage();                      // Start new page
        }
//*************************** END ********************************

}  // end foreach

//**************************** START *******************************
$pdf->ezsetY($ypos-10);                 // print total miles
$pdf->ezSetMargins(0,0,0,250);           
$pdf->ezText('Total Miles Driven  ' . $totalmiles,10,array('justification'=>"right"));
//****************************** END *****************************

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


