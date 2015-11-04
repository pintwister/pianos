<?php
session_start();
include("common.php");

$mdate = date("m");
$ddate = date("d");
$ydate = date("Y");
$date = $mdate . '/' . $ddate . '/' . $ydate;

$user = $_SESSION['name'];
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


$sdate = "";
$serv = "";
$servamnt = "";
$chkno = "";
$comments = "";

?>

<html>
<head>
<title>Add Service</title>

<link href="./style/styleAll.css" rel="stylesheet" type="text/css" media="all" />
<link href="./style/styleAddService.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- link calendar files  -->
	<script language="JavaScript" src="calendar_us.js"></script>
	<link rel="stylesheet" href="calendar.css">


<script type="text/javascript"> function setfocus() { document.forms[0].date.focus() } 

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
</head>

<BODY onload=setfocus()>

              <div id="logout">
                     <a href="index.php">Logout ... </a>
                     <span><?php echo $user?></span>
              </div>

              <div id="AddNewText">
                     Add New Record
              </div>


              <div id="CarryOverText">
                     <?php echo $namesfname,' ',$nameslname,' ',$fee,'<br>',
                     $namesstno,' ',$namesstnm,'<br>',
                     $namescity,' ',$namesstate,' ',$nameszip,'<br>',
                     '(',$phone1,') ',$phone2,'-',$phone3 ?>
              </div>

 
<form name="form" action="addService.php" method="post">
<div id="ServiceDateLabel">
                   Date of Service:
              </div>
              <div id="ServiceDateInput">
                   <input onfocus=select() type="text" name="date" value="<?php echo $date ?>" tabindex=1 />

			<script language="JavaScript">
			new tcal ({
			'formname': 'form',
			'controlname': 'date'
			});
	  		</script>
              </div>
<div id="ServiceLabel">
                   Service:
              </div>
                   <input class="ServiceInput" tabindex=2 maxlength="20" size=21 name="serv" type="text" value="<?php echo $serv?>">
 
              <div id="ServRecLabel">
                   Received:
              </div>
                   <input class="ServRecInput" tabindex=3 maxlength="10" size=10 name="servamnt" type="text" value="<?php echo $servamnt?>">
               
              <div id="CheckLabel">
                   Check #
              </div>
                   <input class="CheckInput" tabindex=4 maxlength="10" size=10 name="chkno" type="text" value="<?php echo $chkno?>">
 
              <div id="CommentsLabel">
                   Comments:
              </div>
              <div id="CommentsInput">
                   <textarea tabindex=5 name="comment" rows="4" cols="96"><?php echo $comment?></textarea>
              </div>
<br>


 <br>
 <input class="SubmitButton" type="submit" value="Commit" />
 <input class="CancelButton" type="button" name="Return" value="Cancel" onClick="window.location='viewnames.php'">
 </form>

 
</body>
</html>

