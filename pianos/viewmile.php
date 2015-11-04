<?php
session_start();
include("common.php");

$user = $_SESSION['name'];

$_SESSION['back'] = 1;


// get ID from previous page
$recserv = $_GET['id'];

// Session Variable from pages returning here
$forward = $_SESSION['forward'];

if ($recserv > 1) {
$forward = $recserv;
}

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
  $collection = $db->mile;

  // Store ID field to variable 
  $criteria = array('_id' => $forward,);
  

// Find single document by ID Variable 
$obj = $collection->findOne($criteria);
      $ldate = $obj['ldate'];
// set up from data format to american format
      $date1 = substr($ldate,4,2);
      $date2 = substr($ldate,6,2);
      $date3 = substr($ldate,0,4);
      $date = $date1 . '/' . $date2 . '/' . $date3;

$_SESSION['date'] = $date;
$_SESSION['start'] = $obj['start'];
$_SESSION['end'] = $obj['end'];
//$_SESSION['tot'] = $obj['tot'];
$_SESSION['expl'] = $obj['expl'];


?>
<html> 
<head>
<title>View Mileage</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleViewmile.css" rel="stylesheet" type="text/css" media="all" /> 

</head>
<body>

              <div id="logout">
                     <a href="index.php">Logout ... </a>
                     <span><?php echo $user?></span>
              </div>


              <div class="EntryText">
                     Date of Entry:
              </div>
              <div class="EntryDate">
                    <?php echo $date ?>  
              </div>

              <div class="StartText">
                     Starting Mileage:
              </div>
              <div class="Start">
                    <?php echo $obj['start'] ?>  
              </div>

              <div class="EndText">
                     Ending Mileage:
              </div>
              <div class="end">
                    <?php echo $obj['end'] ?>  
              </div>

              <div class="TotalText">
                     Total Mileage:
              </div>
              <div class="Total">
                    <?php echo $obj['tot'] ?>  
              </div>

              <div class="DestText">
                     Destination:
              </div>
              <div class="Dest">
                    <?php echo $obj['expl'] ?>  
              </div>
              
<?php			
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

<form name="form" method="post" action="">

<br>		

            <input class="DeleteButton" type="submit" name="Submit" value="Delete"> 
            <input class="BackButton" type="button" value="Back" onClick="window.location='mileage.php'"></button>
            <input class="MainButton" type="button" value="Main" onClick="window.location='admin.php'"></button>
            <input class="EditButton" type="button" value="Edit" onClick="window.location='editmileform.php'"></button>

<?php
if((isset($_POST['Submit']))) 
{
?>

           <div id="AreYouSureText">
               Are you SURE you want to DELETE this record ?<br><br>
           
               <input class="YesButton" type="button" name="yes" value="Yes"
               onClick="window.location='deletemile.php'">

               <input class="NoButton" type="button" value="No"
               onClick="window.location='viewmile.php'">
            </div>
<?php
}
?>

</form>

</body>
</html>
