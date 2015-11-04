<?php
session_start();
include("common.php");

$i = 0;
$user = $_SESSION['name'];

// get ID from previous page
$recserv = $_GET['id'];

$forward = $recserv;

// set session variable for pages called by this page
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
  $criteria = array('_id' => $forward,);
  

// Find single document by ID Variable 
$obj = $collection->findOne($criteria);
$name = $obj['fname'] . ' ' . $obj['lname'] . ' ' . $obj['fee'];
$address1 = $obj['stno'] . ' ' . $obj['stnm'];
$address2 = $obj['city'] . ' ' . $obj['state'] . ' ' . $obj['zip'];
$amntcharged = $obj['charge'];
$amntpaid = $obj['payment'];
$amnttotal = $obj['total'];

if($amntcharged == 0)
{
$amntcharged = ' ';
}

if($amntpaid == 0)
{
$amntpaid = ' ';
}

if($amnttotal == 0)
{
$amnttotal = ' ';
}

//*******************
?>
<div id="main">
<?php

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

if($obj['chgno'] [$i] == 1):

if($nyear > '0'):
// display the Array objects

if($servamnt == 0):
$servamnt = ' ';
endif;

if($partamnt == 0):
$partamnt = ' ';
endif;

?> 
<span class="link"><?php echo $sdate; ?> </span>
<span class="ServiceLink"><?php echo $serv;?></span>
<span><?php echo $chkno;?></span>
<span class="PartsAmntLink"><?php echo $partamnt;?></span>
<span class="ServAmntLink"><?php echo $servamnt;?></span>
<br>
<?php
endif;
endif;

// incriment counter by minus 1

$i=$i-1;

// if conditions are met loop to a:
if($nyear > 0 ):
goto a;
endif;

?>
</div>
<?php

//********************

// disconnect from server
  $conn->close();
} catch (MongoConnectionException $e) {
  die('Error connecting to MongoDB server');
} catch (MongoException $e) {
  die('Error: ' . $e->getMessage());
}

?>
<head>
<title>View Charge</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleViewcharge.css" rel="stylesheet" type="text/css" media="all" /> 
</head>
<body>
              <div id="logout">
                     <a href="index.php">Logout ... </a>
                     <span><?php echo $user?></span>
              </div>


</body></html>
<div id="name">
<?php echo $name; ?>
</div>
<div id="add1">
<?php echo $address1; ?>
</div>
<div id="add2">
<?php echo $address2; ?>
</div>

<div id="AmntCh">
Activity
</div>

<div id="AmntChTot">
Total Charged:
</div>
<div id="AmntPdTot">
Total Paid:
</div>
<div id="bal">
Balance Due:
</div>

<div id="totcharged">
<?php echo $amntcharged; ?>
</div>
<div id="totalpayment">
<?php echo $amntpaid; ?>
</div>
<div id="balance">
<?php echo $amnttotal; ?>
</div>

<input class="MainButton" type="button" value="Main Menu" onClick="window.location='admin.php'">

</body></html>
