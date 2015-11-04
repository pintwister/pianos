<?php
session_start();
include("common.php");

$date1 = $_POST['date1'];
// convert from american format to data format
       $date1a = substr($date1,6,4);
       $date2a = substr($date1,0,2);
       $date3a = substr($date1,3,2);
       $date1 = $date1a . $date2a . $date3a;
$_SESSION['date1'] = $date1;

$date2 = $_POST['date2'];
// convert from american format to data format
       $date1b = substr($date2,6,4);
       $date2b = substr($date2,0,2);
       $date3b = substr($date2,3,2);
       $date2 = $date1b . $date2b . $date3b;
$_SESSION['date2'] = $date2;

$i = 0;
$forward = $_SESSION['forward'];
$_SESSION['forward'] = $forward;
$forward = new MongoId($forward); 
$table = $tableservice;
$user = $_SESSION['name'];
$namesid = $_SESSION['mid']; 
$namesfname = $_SESSION['mfname']; 
$nameslname = $_SESSION['mlname'];
$star = '';
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
$nameslandline = $_SESSION['mlandline'];
$namescell1 = $_SESSION['mcell1'];
$namescell2 = $_SESSION['mcell2'];
$namesemail = $_SESSION['memail']; 
$namescomments = $_SESSION['mcomments'];
$samerican = $_SESSION['samerican'];
$tamerican = $_SESSION['tamerican'];

$phone1 = substr($namesphone,0,3);
$phone2 = substr($namesphone,3,3);
$phone3 = substr($namesphone,6,4);

$landline1 = substr($nameslandline,0,3);
$landline2 = substr($nameslandline,3,3);
$landline3 = substr($nameslandline,6,4);

$cell11 = substr($namescell1,0,3);
$cell12 = substr($namescell1,3,3);
$cell13 = substr($namescell1,6,4);

$cell21 = substr($namescell2,0,3);
$cell22 = substr($namescell2,3,3);
$cell23 = substr($namescell2,6,4);

$rtotal = 0;

?>
<html>

<head>
<title>List Service</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleListservice.css" rel="stylesheet" type="text/css" media="all" /> 

<script language="javascript" type="text/javascript"> 
<!-- 
function popitup(url) { 
	newwindow=window.open(url,'name','menubar,status,resizable,scrollbars,height=600,width=1000'); 
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

              <div id="CarryOverText">
                     <?php 
                     echo $namesfname,' ',$nameslname,' ',$fee,'<br>',
                     $namesstno,' ',$namesstnm,'<br>',
                     $namescity,' ',$namesstate,' ',$nameszip;
                     ?>
              </div>

          <div id="PhoneText"> 
                <?php    
                // check for blank phone
                if($phone3 > 1):
                echo '(',$phone1, ') ',$phone2, '-', $phone3;
                endif;
                ?>
          </div>

          <div id="landlineText"> 
                <?php    
                // check for blank phone
                if($landline3 > 1):         
                echo '(',$landline1, ') ',$landline2, '-', $landline3;
                endif;
                ?>
        </div>
        
        <div id="cell1Text">
                <?php    
                // check for blank phone
                if($cell13 > 1):
                echo '(',$cell11, ') ',$cell12, '-', $cell13;
                endif;
                ?>
        </div>
      
        <div id="cell2Text"> 
                <?php    
                // check for blank phone
                if($cell23 > 1):
                echo '(',$cell21, ') ',$cell22, '-', $cell23;
                endif;
                ?>
        </div>

              
                   
        <div id="CommentsText">
                
                <pre><?php echo $namescomments?></pre>
             
 
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

  // Store ID field to variable 
  $criteria = array('_id' => $forward,);
  

// Find single document by ID Variable 
$obj = $collection->findOne($criteria);

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

if($g > 1):
?>
                               
<div id="datelabel">
Date:
</div>

<div id="servicelabel">
Service:
</div>

<div id="receivedlabel">
Received:
</div>

<div id="chargedlabel">
Charged:
</div>

<div id="checklabel">
Check #:
</div>

              <div id="line">
              </div>  
<br><br>
                              
<?php
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
$_SESSION['sdate'] = $sdate;

if($nyear > '0'):
// display the Array objects

if($comment > ''):
$star = '*';
else:
$star = ' ';
endif;

if($servamnt == 0):
$servamnt = ' ';
endif;

if($partamnt == 0):
$partamnt = ' ';
endif;

if($obj['sdate'] [$i] >= $date1 && $obj['sdate'] [$i] <= $date2):
?> 
<span class="star"><?php echo $star; ?> </span>
<a class="link" href="viewservice.php?service=<?php echo $i?>"><?php echo $sdate;?></a>
<span class="ServiceLink"><?php echo $serv;?></span>
<span class="ServAmntLink"><?php echo $servamnt;?></span>
<span class="PartsAmntLink"><?php echo $partamnt;?></span>
<span class="CheckLink"><?php echo $chkno;?></span><br>
<?php
endif;

$servamnt = ereg_replace(',','', $servamnt);
$rtotal = ereg_replace(',','', $rtotal);
$rtotal = $servamnt+$rtotal;
endif;

// incriment counter by minus 1

$i=$i-1;

// if conditions are met loop to a:
if($nyear > 0 ):
goto a;
endif;

 $rtotal = number_format($rtotal,2);
			
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

</div> <!-- main -->
</div> <!-- comments -->

<br>	

              

                     <?php
                     if($g > 1):
                     ?>
              <div id="ClickText">
                     Click a DATE below to view Transaction details <br>
                     <span style="font-size: 20px"> * </span> indicates comments attached
              </div>

              

              <div id="RTotalLabel">
                    <?php echo '<br>' . 'Total: ' . ' ' . $rtotal?>
              </div>

              <div class="dot">
              <SPAN STYLE="font-size: 25px;">
              .</span>
              </div>
                    <?php
                    endif;
                    ?>

<div class="ButtonBar">
	
<input class="NewSearchButton" type="button" value="New Search" onClick="window.location='searchname.php'">
<input class="MainButton" type="button" value="Main" onClick="window.location='admin.php'">
<input class="BackButton" type="button" value="Back" onClick="window.location='viewnames.php'">
<input class="AddButton" type="button" value="Add Transaction" onClick="window.location='addServform.php'">
<input class="AddCharge" type="button" value="Add Charge" onClick="window.location='addchargeform.php'">
<input class="PrintButton" type="button" value="Print" onclick="return popitup('printservice.php')">

<!--
<input class="PrintShare" type="button" value="Print Share" onClick="window.location='servicePrint.php'">
-->

</div>

</body>
</html>
