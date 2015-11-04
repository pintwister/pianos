<?php
session_start();
include("common.php");

$i = $_GET['service'];
$getit = $_SESSION['single'];

if ($i == '') {
$i = $getit;
}

$_SESSION['single'] = $i;
$namesfname = $_SESSION['mfname']; 
$nameslname = $_SESSION['mlname']; 
$fee = $_SESSION['fee'];
if($fee == 0)
{
$fee = '';
} 
$namesstno = $_SESSION['mstno']; 
$namesstnm = $_SESSION['mstnm']; 
$namescity = $_SESSION['mcity'];
$namesstate = $_SESSION['mstate']; 
$nameszip = $_SESSION['mzip']; 
$namesphone = $_SESSION['mphone']; 

$phone1 = substr($namesphone,0,3);
$phone2 = substr($namesphone,3,3);
$phone3 = substr($namesphone,6,4);


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
  $criteria = array('_id' => $forward,);
  

// Find single document by ID Variable 
$obj = $collection->findOne($criteria);

// define variables for Array objects
$namesid = $obj['namesid'] [$i] . ' ';
$xdate = $obj['sdate'] [$i] . ' ';
$serv = $obj['serv'] [$i] . ' ';
$servamnt = $obj['servamnt'] [$i] . ' ';
$chkno = $obj['chkno'] [$i] . ' ';
$partamnt = $obj['partamnt'] [$i] . ' ';
$comment = $obj['comment'] [$i] . ' ';

$smonth = substr($xdate,4,2);
$sday = substr($xdate,6,2);
$syear = substr($xdate,0,4);
$sdate = $smonth . '/' . $sday . '/' . $syear;

$_SESSION['sdate'] = $sdate;
$_SESSION['serv'] = $serv;
$_SESSION['servamnt'] = $servamnt;
$_SESSION['partamnt'] = $partamnt;
$_SESSION['chkno'] = $chkno;
$_SESSION['comment'] = $comment;

if($servamnt == 0):
$servamnt = ' ';
endif;

if($partamnt == 0):
$partamnt = ' ';
endif;

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


<html>
<head>
<title>View Service</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleViewService.css" rel="stylesheet" type="text/css" media="all" /> 

</head>

<body>
              <div id="logout">
                     <a href="index.php">Logout ... </a>
                     <span><?php echo $user?></span>
              </div>

              <div id="CarryOverText">
                     <?php echo $namesfname,' ',$nameslname,' ',$fee,'<br>',
                     $namesstno,' ',$namesstnm,'<br>',
                     $namescity,' ',$namesstate,' ',$nameszip,'<br>',
                     '(',$phone1,') ',$phone2,'-',$phone3 ?>
              </div

<br>
<form name="form1" method="post" action="">

<div id="ServiceDateLabel">  
            Date of Service:
       </div>
       <div id="ServiceDateText">
            <?php echo $sdate?>
       </div>

       <div id="ServiceLabel">
            Service:
       </div>
       <div id="ServiceText">
            <?php echo $serv?>
       </div>
       
       <div id="ServRecLabel">
            Received:
       </div>
       <div id="ServRecText">
            <?php echo $servamnt?>
       </div>
                  
       <div id="PartsRecLabel"> 
            Charged:
       </div>
       <div id="PartsRecText">
            <?php echo $partamnt?>
       </div>
       
       <div id="CheckLabel">
            Check #
       </div>
       <div id="CheckText">
            <?php echo $chkno ?>
       </div>
       
       <div id="CommentsLabel">
            Comments:
       </div>
       <div id="CommentsText">
            <textarea name="comment" rows="4" cols="96" ><?php echo $comment?></textarea>
       </div> 

            <input class="DeleteButton" type="submit" name="Submit3" value="Delete">

            <input class="BackButton" type="button" value="Back"
            onClick="window.location='viewnames.php'">

            <input class="MainButton" type="button" value="Main" 
            onClick="window.location='admin.php'">

            <input class="EditButton" type="button" value="Edit"
            onClick="window.location='editserviceform.php'">

<?php
if((isset($_POST['Submit3']))) 
{
?>

           <div id="AreYouSureText">
               Are you SURE you want to DELETE this record ?<br><br>
           
               <input class="YesButton" type="button" name="yes" value="Yes"
               onClick="window.location='deleteservice.php'">

               <input class="NoButton" type="button" value="No"
               onClick="window.location='viewservice.php'">
             </div>
<?php
}
?>

</form>
</body>
</html>

