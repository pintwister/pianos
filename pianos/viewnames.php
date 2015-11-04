<?php
session_start();
include("common.php");

// set up date1
      $date1 = '';

// set up todays date
      $date1b = date("m");
      $date2b = date("d");
      $date3b = date("Y");
      $date2 = $date1b . '/' . $date2b . '/' . $date3b;

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
  $collection = $db->names;

  // Store ID field to variable 
  $criteria = array('_id' => $forward,);
  

// Find single document by ID Variable 
$obj = $collection->findOne($criteria);

      $fname = $obj['fname'];
      $lname = $obj['lname'];
      $fee = $obj['fee'];
      if($fee == 0)
      {
      $fee = ' ';
      }
      $stno = $obj['stno'];
      $stnm = $obj['stnm'];
      $city = $obj['city'];
      $email = $obj['email']; 
      $state = $obj['state'];
      $zip = $obj['zip'];
      $total = $obj['total'];
      $phone = $obj['phone'];
      $ldate = $obj['ldate'];
      $ndate = $obj['ndate'];
      $comments = $obj['comments'];
      $landline = $obj['landline'];
      $cell1 = $obj['cell1'];
      $cell2 = $obj['cell2'];

$xndate = $ndate;
$xldate = $ldate;

// set up from data format to american format
      $ldate1 = substr($ldate,4,2);
      $ldate2 = substr($ldate,6,2);
      $ldate3 = substr($ldate,0,4);
      $ldate = $ldate1 . '/' . $ldate2 . '/' . $ldate3;

// set up from data format to american format
      $ndate1 = substr($ndate,4,2);
      $ndate2 = substr($ndate,6,2);
      $ndate3 = substr($ndate,0,4);
      $ndate = $ndate1 . '/' . $ndate2 . '/' . $ndate3;

$phone1 = substr($phone,0,3);
$phone2 = substr($phone,3,3);
$phone3 = substr($phone,6,4);

$landline1 = substr($landline,0,3);
$landline2 = substr($landline,3,3);
$landline3 = substr($landline,6,4);

$cell11 = substr($cell1,0,3);
$cell12 = substr($cell1,3,3);
$cell13 = substr($cell1,6,4);

$cell21 = substr($cell2,0,3);
$cell22 = substr($cell2,3,3);
$cell23 = substr($cell2,6,4);

				
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
<title>View Names</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleViewnames.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- link calendar files  -->
	<script language="JavaScript" src="calendar_us.js"></script>
	<link rel="stylesheet" href="calendar.css">

<script type="text/javascript"> function setfocus() { document.forms[0].date1.focus() } 

var isNN = (navigator.appName.indexOf("Netscape")!=-1);
function autoTab(input,len, e) {
var keyCode = (isNN) ? e.which : e.keyCode; 
var filter = (isNN) ? [0,8,9] : [0,8,9,16,17,18,37,38,39,40,46];
if(input.value.length >= len && !containsElement(filter,keyCode)) {
input.value = input.value.slice(0, len);
input.form[(getIndex(input)+1) % input.form.length].focus();
}
function containsElement(arr, ele) {
var found = false, index = 0;
while(!found && index < arr.length)
if(arr[index] == ele)
found = true;
else
index++;
return found;
}
function getIndex(input) {
var index = -1, i = 0, found = false;
while (i < input.form.length && index == -1)
if (input.form[i] == input)index = i;
else i++;
return index;
}
return true;
}
//  End -->
</script>

<script language="javascript" type="text/javascript"> 
<!-- 
function popitup(url) { 
	newwindow=window.open(url,'name','toolbar,status,resizable,scrollbars,height=600,width=1000'); 
	if (window.focus) {newwindow.focus()} 
	return false; 
} 
// --> 
</script> 

</head>

<body onload=setfocus()>
               
              <div id="logout">

                     <a href="index.php">Logout ... </a>
                     <span><?php echo $user?></span><br><br>
                     
              </div>
<form name="form" method="post" action="listservice.php">

           <div id="GreaterThanText">
                Greater Than or Equal to
           </div>

           <div id="GreaterThanInput">
               <input onfocus=select() type="text" name="date1" value="<?php echo $date1 ?>" tabindex=1 />

			<script language="JavaScript">
			new tcal ({
			'formname': 'form',
			'controlname': 'date1'
			});
	  		</script>

           </div>
     
            
          <div id="LessThanText">
               Less Than or Equal to
          </div>
         
          <div id="LessThanInput">
             <input onfocus=select() type="text" name="date2" value="<?php echo $date2 ?>" tabindex=1 />

			<script language="JavaScript">
			new tcal ({
			'formname': 'form',
			'controlname': 'date2'
			});
	  		</script>

          </div>


        <div id="NameText">
            <?php echo $fname,' ',$lname,' ',$fee?>
        </div>

        <div id="StNoNmText">
            <?php echo $stno, ' ', $stnm?>
        </div>

        <div id="CitStZipText">
            <?php echo $city, ', ',$state, ' ', $zip?>
        </div>
         
                <?php    
                // check for blank phone
                if($phone3 > 1):
                ?> 
        <div id="PhoneLabel">
            Primary Phone:
        </div>

        <div id="PhoneText"> 
                <?php    
                echo '(',$phone1, ') ',$phone2, '-', $phone3;
                ?>
        </div>
                <?php
                endif;
                
                // check for blank phone
                if($landline3 > 1):
                ?> 

        <div id="landlineLabel">
            Land Line:
        </div>

        <div id="landlineText"> 
                <?php    
                echo '(',$landline1, ') ',$landline2, '-', $landline3;
                ?>
        </div>
                <?php
                endif;
               
                // check for blank phone
                if($cell13 > 1):
                ?> 
        <div id="cell1Label">
            Cell #1:
        </div>

        <div id="cell1Text">
                <?php    
                echo '(',$cell11, ') ',$cell12, '-', $cell13;
                ?>
        </div>
                <?php
                endif;
                
                // check for blank phone
                if($cell23 > 1):
                ?> 
        <div id="cell2Label">
            Cell #2:
        </div>

        <div id="cell2Text"> 
                <?php    
                echo '(',$cell21, ') ',$cell22, '-', $cell23;
                ?>
        </div>
                <?php
                endif;
                

               // check for blank e-mail
               if($email > ''):
               ?>
        <div id="emailLabel">
            E-Mail:
        </div>

        <div id="emailText">
        <a href="mailto: <?php echo $email ?> "> <?php echo $email ?></a>
        </div>
               <?php
               endif;
               
               // check for blank date
               if($xldate > 1):
               ?>
        <div id="LServiceLabel">
            Last: Service:
        </div>

        <div id="LServiceText">
            <?php echo $ldate?>
        </div>
               <?php
               endif;
               
               // check for blank date
               if($xndate > 1):
               ?>
        <div id="NApptLabel">
            Next Appointment:
        </div>

        <div id="NApptText">
            <?php echo $ndate?> 
        </div>
               <?php
               endif;
        
               // check for blank comments
               if($comments > ''):
               ?>
        <div id="CommentsLabel">
             Comments:
        </div>

        <div id="CommentsText">
            <textarea readonly rows="4" cols="96"><?php echo $comments?></textarea>
        </div>
               <?php
               endif;
               ?>

<?php

$_SESSION['mfname'] = $fname;
$_SESSION['mlname'] = $lname;
$_SESSION['fee'] = $fee;
$_SESSION['mstno'] = $stno;
$_SESSION['mstnm'] = $stnm;
$_SESSION['mcity'] = $city;
$_SESSION['mstate'] = $state;
$_SESSION['mzip'] = $zip;
$_SESSION['mphone'] = $phone;
$_SESSION['mlandline'] = $landline;
$_SESSION['mcell1'] = $cell1;
$_SESSION['mcell2'] = $cell2;
$_SESSION['memail'] = $email;
$_SESSION['mcomments'] = $comments;
$_SESSION['samerican'] = $samerican;
$_SESSION['tamerican'] = $tamerican;
$_SESSION['mndate'] = $ndate;

if($total > 0)
{
?>
<div id="total">
This Customer Owes Me
<?php echo '$' . $total; ?><br>
<input class="PayCharge" type="button" value="Pay on Account" onClick="window.location='paychargeform.php'">
</div>
<?php
}

?>

<input class="ViewServiceButton" type="Submit" name="Submit" value="View/Add/Print Transactions" >

<div class="ButtonBar">

            <input class="NewSearchButton" type="button" value="New Search" onClick="window.location='searchname.php'">
            <input class="DeleteButton" type="button" name="Submit3" value="Delete" onClick="window.location='predelete.php'"> 

            <input class="BackButton" type="button" value="Back" onClick="window.location='listname.php'">
        
            <input class="MainButton" type="button" value="Main" onClick="window.location='admin.php'">
        
            <input class="EditButton" type="button" value="Edit" onClick="window.location='editnamesForm.php'">
        
</div>
     
<div id="maptext">
            Get Map <br><br>
        

            <input class="map" type="button" value="Google" onclick="return popitup('http://maps.google.com/maps?f=q&hl=en&q=<?php echo $stno ?>+<?php echo $stnm ?>+<?php echo $city ?>+<?php echo $state ?>')">
 
<br>
          
            <input class="map2" type="button" value="Mapquest" onclick="return popitup('http://www.mapquest.com/maps/map.adp?formtype=address=&address=<?php echo $stno ?>%20<?php echo $stnm ?> &city=<?php echo $city ?> &state=<?php echo $state ?> ')">
   
<br>
        
            <input class="map3" type="button" value="Yahoo" onclick="return popitup('http://maps.yahoo.com/maps_result?addr=<?php echo $stno ?>+<?php echo $stnm ?>&csz=<?php echo $city ?>%2C+<?php echo $state ?>&country=us&new=1&name=&qty= ')">

</div>

</form>
</body>
</html>
