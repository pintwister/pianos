<head>
<title>List Charge</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleListcharge.css" rel="stylesheet" type="text/css" media="all" /> 
</head>

<?php
session_start();
include("common.php");

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
  $criteria = array('charge'=>array('$gt' => '0.00',));

   
  // execute query
  $cursor = $collection->find($criteria);

  // iterate through the result set
  // print each document

?> 
<div id="clicktext">
Click a name below to view complete details
</div>
<div id="main">
<?php 
foreach ($cursor as $obj)
	{
?>
<a class="link" href="viewcharge.php?id=<?php echo $obj['_id']?>"><?php echo $obj['fname'] . ' ' . $obj['lname']?></a><br>
<?php
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

<br>
<input class="MainButton" type="button" value="Main Menu" onClick="window.location='admin.php'">

</body>
</html>

