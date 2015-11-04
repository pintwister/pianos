<?php
session_start();
include("common.php");

$_SESSION['id'] = 1;
$_SESSION['admin'] = 1;

$user = $_SESSION['name'];

try {
// open connection to LOCAL MongoDB server
// $conn = new Mongo('localhost');

// open connection to CLOUD MongoDB server
 $conn = new Mongo("mongodb://pintwister:pitboss1@dbh56.mongolab.com:27567/pianos");

  // access database
  $db = $conn->pianos;

  // access collection
  $collection = $db->users;
  
  // execute query
  $cursor = $collection->find();

  // iterate through the result set
  // print each document
?> 
<div id="main">
<?php 
  
foreach ($cursor as $obj)
{

?> 
<a class="link" href="viewuser.php?id=<?php echo $obj['_id']?>"><?php echo $obj['firstname'] . ' ' .$obj['lastname'] ?></a><br>
<?php
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

<html>
<head>
<title>List Users</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleListuser.css" rel="stylesheet" type="text/css" media="all" /> 
</head>

<body>
              <div id="logout">
                     <a href="index.php">Logout ... </a>
                     <span><?php echo $user?></span>
              </div>

              <div id="ClickText">
                     Click a username below to view User details
              </div>

               <input class="MainButton" type="button" value="Main" onClick="window.location='admin.php'">
               <input class="BackButton" type="button" value="Add Another User" onClick="window.location='addUserform.php'">
</body>
</html>

