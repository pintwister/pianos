<html><head></head>
<body>

<?php
session_start();
include("common.php");

$user = $_SESSION['name'];

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
  $collection = $db->users;

  // Store ID field to variable 
  $criteria = array('_id' => $forward,);
  

// Find single document by ID Variable 
$obj = $collection->findOne($criteria);

?>
<html>
<head>
<title>View Users</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleViewusers.css" rel="stylesheet" type="text/css" media="all" /> 

</head>

<body>

<form name="form1" method="post" action="">

            <div id="logout">
                    <a href="index.php">Logout ... </a>
                    <span><?php echo $user?></span>
            </div>


            <div id="UserName">
                    <span class="UserNameText">User Name:</span>
                    <?php echo $obj['username'] ?>  
            </div>
             
            <div id="Password">       
                    <span class="PasswordText">Password:</span>
                    <?php echo $obj['password'] ?>
            </div>

            <div id="Admin">       
                    <span class="AdminText">Type: </span>
                    <?php echo $obj['admin'] ?> &nbsp;&nbsp;&nbsp; Standard User = 0 &nbsp;&nbsp; Administrator = 1 </span>
            </div>

            <div id="FirstName">       
                    <span class="FirstNameText">First Name:</span>
                    <?php echo $obj['firstname'] ?> 
            </div>

            <div id="LastName">       
                    <span class="LastNameText">Last Name:</span>
                    <?php echo $obj['lastname'] ?> 
            </div>

            <input class="DeleteButton" type="submit" name="Submit3" value="Delete">
            <input class="BackButton" type="button" value="Back" onClick="window.location='listusers.php'">
            <input class="MainButton" type="button" value="Main" onClick="window.location='admin.php'">
            <input class="EditButton" type="button" value="Edit" onClick="window.location='edituserform.php'">

</form>

<?php
$_SESSION['username'] = $obj['username'];
$_SESSION['password'] = $obj['password'];
$_SESSION['admin'] = $obj['admin'];
$_SESSION['firstname'] = $obj['firstname'];
$_SESSION['lastname'] = $obj['lastname'];

				
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
if((isset($_POST['Submit3']))) 
{
?>

           <div id="AreYouSureText">
               Are you SURE you want to DELETE this record ?<br><br>
           
               <input class="YesButton" type="button" name="yes" value="Yes"
               onClick="window.location='deleteuser.php'">

               <input class= "NoButton" type="button" value="No"
               onClick="window.location='viewuser.php'">
            </div>
<?php
}
?>


</body>
</html>
