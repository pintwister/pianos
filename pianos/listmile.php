<?php
session_start();
include("common.php");

$admin = $_SESSION['admin'];
$userid = $_SESSION['userid'];
$user = $_SESSION['name'];

$date1head = $_POST['date1'];
$_SESSION['date1head'] = $date1head;
$date1 = $_POST['date1'];
$_SESSION['date1'] = $date1;
// convert from american format to data format
       $date1a = substr($date1,6,4);
       $date2a = substr($date1,0,2);
       $date3a = substr($date1,3,2);
       $date1 = $date1a . $date2a . $date3a;

$date2head = $_POST['date2'];
$_SESSION['date2head'] = $date2head;
$date2 = $_POST['date2'];
$_SESSION['date2'] = $date2;
// convert from american format to data format
       $date1b = substr($date2,6,4);
       $date2b = substr($date2,0,2);
       $date3b = substr($date2,3,2);
       $date2 = $date1b . $date2b . $date3b;

?>

<html>
<head>
<title>List Mileage</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleListMile.css" rel="stylesheet" type="text/css" media="all" /> 

<script language="javascript" type="text/javascript"> 
<!-- 
function popitup(url) { 
	newwindow=window.open(url,'name','menubar,status,resizable,scrollbars,width=1000,height=600'); 
	if (window.focus) {newwindow.focus()} 
	return false; 
} 
// --> 
</script> 

 
</head>
<body>
<div id="logout">
                     <a href="index.php">Logout ... </a>
                     <span><?php echo $user?></span>
              </div>

<div id="headdate">
Date:
</div>

<div id="headstart">
Start:
</div>

<div id="headend">
End:
</div>

<div id="headtot">
Total:
</div>

<div id="headexpl">
Explaination:
</div>

<div id="headtext1">
Mileage Begining
</div>

<div id="headtext2">
<?php echo $date1head?>
</div>

<div id="headtext3">
Ending
</div>

<div id="headtext4">
<?php echo $date2head?>
</div>
<div id="main">


<?php

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
  ' ' => $a
  );

  
  // retrieve fields
  $fields = array('_ID', 'userid', 'ldate', 'start', 'end', 'tot', 'expl');
  
  // execute query
  $cursor = $collection->find($criteria,$fields);

  // iterate through the result set
  // print each document
   
foreach ($cursor as $obj)
	{
if($obj['userid'] == $userid OR $admin == 1):

if ($obj['ldate'] >= $date1 && $obj['ldate'] <= $date2)
{
      $ldate = $obj['ldate'];
      $smonth = substr($ldate,4,2);
      $sday = substr($ldate,6,2);
      $syear = substr($ldate,0,4);
      $ldate = $smonth . '/' . $sday . '/' . $syear;
      $tot = $obj['tot'];
      $totalmiles = $totalmiles + $tot;

?> 
<span class="date"> <a href="viewmile.php?id=<?php echo $obj['_id']?>"><?php echo $ldate?></a></span>
<span class="start"> <?php echo $obj['start']?> </span> 
<span class="end"> <?php echo $obj['end']?> </span> 
<span class="tot"> <?php echo $obj['tot']?> </span>
<span class="expl"> <?php echo $obj['expl'] ?> </span><br>
<?php
}
endif;
	}

  // disconnect from server
  $conn->close();
} catch (MongoConnectionException $e) {
  die('Error connecting to MongoDB server');
} catch (MongoException $e) {
  die('Error: ' . $e->getMessage());
}
?>
</div>

<br>
<input class="PrintButton" type="button" value="Print" onclick="return popitup('printmileage.php')">
<input class="MainButton" type="button" value="Main Menu" onClick="window.location='admin.php'">
<input class="BackButton" type="button" value="Back" onClick="window.location='mileinput.php'"></button>

<div id="total">
<?php echo 'Total Miles Driven ' . ' ' . $totalmiles; ?>
</div>

</body>
</html>

