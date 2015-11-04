<?php
session_start();
include("common.php");


$admin = $_SESSION['admin'];
$userid = $_SESSION['userid'];
$user = $_SESSION['name'];
$user = $_SESSION['name'];


$firstfield = TRIM($_SESSION['firstfield']);
$first = TRIM($_SESSION['first']);
$firstcompare = trim($_SESSION['firstcompare']);

$secondfield = TRIM($_SESSION['secondfield']);
$second = TRIM($_SESSION['second']);
$secondcompare = trim($_SESSION['secondcompare']);

if($firstcompare == '1' AND $secondcompare == '1'): 
// Begins With
 $first = new MongoRegex('/^' . $first . '/i');
 $second = new MongoRegex('/^' . $second . '/i');

elseif($firstcompare == '2' AND $secondcompare == '2'): 
// Contains
 $first = new MongoRegex('/' . $first . '/i');
 $second = new MongoRegex('/' . $second . '/i');

elseif($firstcompare == '1' AND $secondcompare == '2'): 
// Begins With
 $first = new MongoRegex('/^' . $first . '/i');
// Contains
 $second = new MongoRegex('/' . $second . '/i');

elseif($firstcompare == '2' AND $secondcompare == '1'): 
// Contains
 $first = new MongoRegex('/' . $first . '/i');
// Begins With
 $second = new MongoRegex('/^' . $second . '/i');

endif;

 
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
  $firstfield => $first,
  $secondfield => $second,
  );
  
  // retrieve fields
  $fields = array('_ID', 'userid', 'lname', 'fname', 'fee', 'stno', 'stnm', 'city', 'state', 'zip', 'phone', 'ldate', 'ndate', 'comments', 'charge', 'payment', 'total', 'landline', 'cell1', 'cell2', 'email');
  
  // execute query
  $cursor = $collection->find($criteria,$fields);
  $cursor->sort(array('lname' => 1, 'fname' => 1));

  // iterate through the result set
  // echo each document
 

?>
<div id="main">
<?php
  
foreach ($cursor as $obj)
{

if($obj['userid'] == $userid OR $admin == 1):

?> 

<a href="viewnames.php?id=<?php echo $obj['_id']?>"><?php echo $obj['fname'],' ',$obj['lname']?></a>
                                                                                    <?php 
                                                                                    $vphone = $obj['phone'];
                                                                                    $vphone1 = substr($vphone,0,3);
                                                                                    $vphone2 = substr($vphone,3,3);
                                                                                    $vphone3 = substr($vphone,6,4);
                                                                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                                                                                    $obj['stno'],' ',$obj['stnm'],'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                                                                                    $obj['city'],',',$obj['state'],'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                                                                                    $obj['zip'],'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                                                                                    '(',$vphone1, ') ',$vphone2, '-', $vphone3
                                                                                    ?> <br>


<?php
endif;
}

?>
</div>
<?php

  // disconnect from server
  $conn->close();
} catch (MongoConnectionException $e) {
  die('Error connecting to MongoDB server');
} catch (MongoException $e) {
  die('Error: ' . $e->getMessage());
}
?>

<html>
<head>
<title>List Names</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleListname.css" rel="stylesheet" type="text/css" media="all" />  
</head>

<body>

              <div id="logout">
                     <a href="index.php">Logout ... </a>
                     <span><?php echo $user?></span>
              </div>

              <input class="NewSearchButton" type="button" value="New Search" onClick="window.location='searchname.php'">
 
              <input class="MainButton" type="button" value="Main" onClick="window.location='admin.php'">
         
         <div id="ClickText">
              Click a name below to view details
         </div>


</body>
</html>

