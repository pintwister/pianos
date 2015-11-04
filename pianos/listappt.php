<?php
session_start();
include("common.php");

$admin = $_SESSION['admin'];
$userid = $_SESSION['userid'];
$user = $_SESSION['name'];
$counter = 0;


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
<title>List Appointments</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleApptView.css" rel="stylesheet" type="text/css" media="all" /> 

<script language="javascript" type="text/javascript"> 
<!-- 
function popitup(url) { 
	newwindow=window.open(url,'name','menubar,toolbar,status,resizable,scrollbars,width=800,height=400'); 
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

<div id="headtext">
Appointments Through <?php echo  ' ' . $date2head; ?>
</div>

<div id="headldate">
Last Entry:
</div>
<div id="headndate">
Next Appt:
</div>
<div id="headphone">
Phone:
</div>
<div id="headname">
Name:
</div>
<div id="headcity">
City:
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
  $collection = $db->names;

  // formulate AND query
  $criteria = array(
  ' ' => $a
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
      $name = $fname . ' ' . $lname;
      $fee = $obj['fee'];
 
?> 
<span class="counter"><?php echo $counter; ?></span>
<span class="ldate"><?php echo substr($ldate,4,2) . '/' . substr($ldate,6,2) . '/' . substr($ldate,0,4); ?></span>
<span class="ndate"><?php echo substr($ndate,4,2) . '/' . substr($ndate,6,2) . '/' . substr($ndate,0,4); ?></span>  
<span class="name"><?php echo $name . ' ' . $fee; ?></span>
<span class="phone"><?php echo '(' . substr($phone,0,3) . ') ' . substr($phone,3,3) . '-' . substr($phone,6,4); ?></span>
<span class="city"><?php echo $city; ?></span>
<br>
<?php
endif;
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
<input class="PrintButton" type="button" value="Print" onclick="return popitup('printappt.php')">
<input class="MainButton" type="button" value="Main Menu" onClick="window.location='admin.php'">
<input class="BackButton" type="button" value="Back" onClick="window.location='appointments.php'"></button>

</body>
</html>

