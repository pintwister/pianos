
<?php
session_start();
include("common.php");

$date = $_POST['date'];

// convert from american format to data format
       $date1 = substr($date,6,4);
       $date2 = substr($date,0,2);
       $date3 = substr($date,3,2);
       $fsdate = $date1 . $date2 . $date3;

$fserv = 'Pay on Acct';
$fservamnt = $_POST['servamnt'];
$fservamnt = number_format($fservamnt,2);
$fchkno = $_POST['chkno'];
$fcomment = $_POST['comment'];
$fpartamnt = '0.00';
$fchgno = '1';
$overpay = '0.00';

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
 
$service = array('sdate' => $fsdate, 'serv' => $fserv, 'servamnt' => $fservamnt, 'chkno' => $fchkno, 'partamnt' => $fpartamnt, 'comment' => $fcomment, 'chgno' => $fchgno);

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

$fservamnt = ereg_replace(',','', $fservamnt);
$fpayment = $obj['payment'];
$fpayment = ereg_replace(',','', $fpayment);
$total = $obj['total'];
$total = ereg_replace(',','', $total);
$total = $total - $fservamnt;
$total = number_format($total,2);
$fpayment = $fpayment+$fservamnt;
$fpayment = number_format($fpayment,2);
$nyear = $obj['sdate'];

if($total <= '0.00'):
$charge = '0.00';
$fpayment = '0.00';

//******************* Begin
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

if($obj['chgno'] [$i] == 1):

if($nyear > '0'):
// Re-Set chgno to null

$obj['chgno'] [$i] = ' ';

endif;

// incriment counter by minus 1

$i=$i-1;

// if conditions are met loop to a:
if($nyear > 0 ):
goto a;
endif;
endif;
//******************** End

$obj['charge'] = $charge;
endif;

if($total < '0.00'):
//$total = ereg_replace(',','', $total);
//$total = $total-$total-$total;
$total = number_format($total,2);
$overpay = $total;
$total = '0.00';
endif;

$obj['ldate'] = $fsdate;
$obj['payment'] = $payment;
$obj['total'] = $total;

$collection->save($obj,$options);

// disconnect from server
  			   $conn->close();
if($overpay == 0):
header("location: viewnames.php");
endif;

if($overpay < '0.00'):
$_SESSION['overpay'] = $overpay;
$_SESSION['sdate'] = $fsdate;
$_SESSION['serv'] = 'Over Payment';
$_SESSION['chkno'] = $fchkno;
$_SESSION['payment'] = $fpayment;
header("location: overpay.php");
endif;

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
</form>
		
         	
		
</body></html>