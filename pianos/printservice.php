<?php
session_start();
include("common.php");

session_cache_limiter('none'); 

$extra = '.';
$spacer = "";
$user = $_SESSION['name'];
$namesid = $_SESSION['mid']; 
$namesfname = $_SESSION['mfname']; 
$nameslname = $_SESSION['mlname']; 
$fee = $_SESSION['fee'];
 
$i = 0;
$forward = $_SESSION['forward'];
$_SESSION['forward'] = $forward;
$forward = new MongoId($forward); 

$namesstno = $_SESSION['mstno']; 
$namesstnm = $_SESSION['mstnm'];                   // Activate all Session variables
$namescity = $_SESSION['mcity'];                   // carried over from calling program
$namesstate = $_SESSION['mstate']; 
$nameszip = $_SESSION['mzip']; 
$namesphone = $_SESSION['mphone'];
$nameslandline = $_SESSION['mlandline']; 
$namescell1 = $_SESSION['mcell1']; 
$namescell2 = $_SESSION['mcell2'];
$namesemail = $_SESSION['memail'];   
$namescomments = $_SESSION['mcomments'];

$date1 = $_SESSION['date1'];
$date2 = $_SESSION['date2'];

                                // System Date
$dayofweek = date('l');         // 'l' = Character Day of Week
$month = date('F');             // 'F' = Character Month
$dayofmonth = date('d');        // 'd' = numeric dayof month
$year = date('Y');              // 'Y' = 4 digit numeric Year
$completedate = $dayofweek . ' ' . $month . ' ' . $dayofmonth . ' ' . $year;


$phone1 = substr($namesphone,0,3);
$phone2 = substr($namesphone,3,3);                
$phone3 = substr($namesphone,6,4);                

$landline1 = substr($nameslandline,0,3);
$landline2 = substr($nameslandline,3,3);
$landline3 = substr($nameslandline,6,4);

$cell11 = substr($namescell1,0,3);
$cell12 = substr($namescell1,3,3);
$cell13 = substr($namescell1,6,4);                 

$cell21 = substr($namescell2,0,3);
$cell22 = substr($namescell2,3,3);
$cell23 = substr($namescell2,6,4);                                  

$headDate = 'Date:';
$headService = 'Service:';
$headSamnt = 'Received:';                          // variables for page header
$headPamnt = 'Charged:';
$headCheck = 'Check#:';
$uline = '____________________________________________________________________________';

// ******************* START *****************************
error_reporting(E_ALL);                           // include PDF class and set error reporting
include('class.ezpdf.php'); 
$pdf =& new Cezpdf('LETTER','portrait');          // create PDF doc and select font
$pdf->selectFont('./fonts/Helvetica'); 

$ypos = 780;   // Set top line of first page --- Lines are numbered from the bottom of the page

// ********************* END *********************************************

// ********************** START ********************************************
 $pdf->ezsetY($ypos);                            // print this section starting with this line number                               
 $pdf->eztext($completedate,12);                 // number after the comma is the font size                                       
 $pdf->ezText($spacer);
 $pdf->ezText($namesfname . ' ' . $nameslname . ' ' . $fee,20);                        
 $pdf->ezText($namesstno . ' ' . $namesstnm,20);                          
 $pdf->ezText($namescity . ' ' . $namesstate . ' ' . $nameszip,20);

$ypos = $pdf->ezGetY();                         
// ********************* END *********************************************


// ********************** START ********************************************
 if($phone3 > ' '):
 $phonePos = $ypos+46;
 $pdf->ezsetY($phonePos);
 $pdf->ezSetMargins(0,0,350,0);                                                  
 $pdf->ezText( '(' . $phone1 . ') ' . $phone2 . '-' . $phone3,12);
endif;

if($landline3 > ' '):
 $pdf->ezsetY($phonePos);
 $pdf->ezSetMargins(0,0,450,0);   
 $pdf->ezText( '(' . $landline1 . ') ' . $landline2 . '-' . $landline3,12); 
endif;

if($cell13 > ' '):
 $pdf->ezsetY($phonePos-14);
 $pdf->ezSetMargins(0,0,350,0);
 $pdf->ezText( '(' . $cell11 . ') ' . $cell12 . '-' . $cell13,12); 
endif;

if($cell23 > ' '):
 $pdf->ezsetY($phonePos-14);
 $pdf->ezSetMargins(0,0,450,0); 
 $pdf->ezText( '(' . $cell21 . ') ' . $cell22 . '-' . $cell23,12);
endif;
// ********************* END *********************************************

// ********************** START ********************************************
 $pdf->ezsetY($ypos-20);
 $pdf->ezSetMargins(0,0,32,0);                                                  
 $pdf->ezText($namesemail,12);

 $pdf->ezSetMargins(0,0,32,0);                                                  
 $pdf->ezText("\n".$namescomments,12);  // "\n" allows for Hard Return
 // *********************** END ********************************************
 

// ********************** START ********************************************
$ypos = $pdf->ezGetY()-20;                      // Returns Current Line number  --- print this section starting with this line number
                                                                                                    
  $pdf->ezsetY($ypos);                                 
  $pdf->ezSetMargins(0,0,63,0);                 // ezSetMargins sets top - bottom - left - right
  $pdf->ezText($headDate,10);                   // eztext first param ... Data - font size -- (justification)             

  $pdf->ezsetY($ypos);                                 
  $pdf->ezSetMargins(0,0,200,0);              
  $pdf->ezText($headService,10);

  $pdf->ezsetY($ypos);                                 
  $pdf->ezSetMargins(0,0,260,0);
  $pdf->ezText($headSamnt,10);

  $pdf->ezsetY($ypos);                                 
  $pdf->ezSetMargins(0,0,330,0);
  $pdf->ezText($headPamnt,10);
 
  $pdf->ezsetY($ypos);                                 
  $pdf->ezSetMargins(0,0,420,0);
  $pdf->ezText($headCheck,10);

  $pdf->ezsetY($ypos-3);                                 
  $pdf->ezSetMargins(0,0,36,0);
  $pdf->ezText($uline,10);  

$ypos = $pdf->ezGetY()-8;                      // Returns Current Line Number -- this is the ammount of space before next section starts
// ********************* END ***************************

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

// for decending order
// we need to find the number of array elements.
// Store the last loop to $i, and that will be the 
// number for the last array element entry

// set ID count to 0
$g = 0;
b:
$xsdate = $obj['sdate'] [$g];
$nyear = substr($xsdate,0,4);
$sdate = $nyear;
if($nyear > '0'):
$i = $g;
endif;
$g=$g+1;
if($nyear > 0 ):
goto b;
endif;

// set a loop point for goto

a:
// define variables for Array objects

$xsdate = $obj['sdate'] [$i];
$nmonth = substr($xsdate,4,2);
$nday = substr($xsdate,6,2);
$nyear = substr($xsdate,0,4);

$sdate = $nmonth . '/' . $nday . '/' . $nyear;
$serv = $obj['serv'] [$i] . ' ';
$servamnt = $obj['servamnt'] [$i];
$partamnt = $obj['partamnt'] [$i];
$chkno = $obj['chkno'] [$i];
$jj = $obj['comment'] [$i];
$comment = trim($jj);
$_SESSION['sdate'] = $sdate;

// Print the Data

if($servamnt == 0):
$servamnt = ' ';
endif;

if($partamnt == 0):
$partamnt = ' ';
endif;

  //*********************** START *************************************                  
if($obj['sdate'] [$i] >= $date1 && $obj['sdate'] [$i] <= $date2 && $xsdate > '0' ):  

 $pdf->ezsetY($ypos);                                 
 $pdf->ezText($sdate,10,array('aleft'=>35));

 $pdf->ezsetY($ypos);                                 
 $pdf->ezSetMargins(0,0,0,380);
 $pdf->ezText($serv,10,array('justification'=>"right"));              // eztext first param ... Data - font size -- (justification)                  

 $pdf->ezsetY($ypos);                                 
 $pdf->ezSetMargins(0,0,0,310);
 $pdf->ezText($servamnt,10,array('justification'=>"right"));  

 $pdf->ezsetY($ypos);                                 
 $pdf->ezSetMargins(0,0,0,242);                               
 $pdf->ezText($partamnt,10,array('justification'=>"right"));  

 $pdf->ezsetY($ypos);                                 
 $pdf->ezSetMargins(0,0,0,157);
 $pdf->ezText($chkno,10,array('justification'=>"right"));

  

//************************ END ************************************

// incriment counter by minus 1

$i=$i-1;

// if conditions are met loop to a:

//************************* START ***********************************
$ypos = $ypos-13; 
                                                 // ammount of space between lines -- This number must be the negative of
  
                                                                 // previous Line Spacer
if($ypos < 49): 
  $pdf->ezsetY($ypos-2);
  $pdf->setColor(0,0,0);                                 
  $pdf->ezSetMargins(0,0,35,0);
  $pdf->ezText($extra);
  $pdf->setColor(0,0,0);                                           // Allow for margin at bottom of page     
$pdf->ezNewPage();                                                 // Start new page
$ypos = 755;                                                       // Set New top line for all but the first page
endif;
//*************************** END ********************************

goto a;
endif;


  $pdf->ezsetY($ypos-2); 
  $pdf->setColor(0,0,0);                                
  $pdf->ezSetMargins(0,0,35,0);
  $pdf->ezText($extra);  


//************************* START ***********************************
$pdf->ezStream();           // Create PDF
//*************************** END ********************************

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
